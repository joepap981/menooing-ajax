angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'accessDB', 'growl', '$window', function ($scope, $location, restaurantService, accessDB, growl, $window) {
  $scope.excessCapacity = {};
  $scope.operationHours = {};
  $scope.restaurant = {};
  $scope.user = {};
  $scope.files = {};

  //add data to sessionStorage restaurant
  $scope.registerRestaurant = function (redirectLocation) {
    restaurantService.saveToSession('restaurant', $scope.restaurant);
    restaurantService.saveToSession('user', $scope.user);
    console.log($window.sessionStorage.restaurant);
    console.log($window.sessionStorage.user);
    $location.path(redirectLocation);
  }

  //create restaurant and insert to DB
  $scope.createRestaurant = function () {
    var session = accessDB.checkSession();
    //check for session
    session.then(function (result) {

      //if a user is in session
      if (result["user_id"] != null) {
        restaurantService.insertRestaurantInfo().then(function(response) {
          //receive inserted restaurant id number
          if (!isNaN(response)) {
            //insert related user_info to database
            restaurantService.insertUserInfo().then(function(response2) {
              //if sucessfully insert user information
              if (response2 == 1) {
                growl.success('Your restaurant has been created!',{title: 'Success!'});
                delete $window.sessionStorage.user;
                delete $window.sessionStorage.restaurant;
                $location.path('/restaurant-new-success');
              } else if (response2 == 0) {
                growl.error('Your restaurant has failed to be registered. Try again from the beginning.',{title: 'DB Error!'});
              } else {
                growl.error('Something has gone terribly wrong. Notify the admin about this.',{title: 'Error!'});
              }
            });

            //upload files to file system and save location reference to DB
            $scope.uploadFile(response).then(function() {
              restaurantService.clearFileList();
            });

          } else if (response == 0) {
            growl.error('Your restaurant has failed to be registered. Try again from the beginning.',{title: 'DB Error!'});
          } else {
            growl.error('Something has gone terribly wrong. Notify the admin about this.',{title: 'Error!'});
          }
        });
      }

      //if there is no user in session, redirect to nosession info page
      else {
          $location.path('/nosession');
      }
    });
  }

  //set value to $scope.restaurant
  $scope.setRestaurantData = function (key, value) {
    $scope.restaurant[key] = value;
  }

  //extract required address information
  $scope.extractAddress = function () {
    //attributes from autocomplete that needs to be saved
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    //get the address saved to RestaurantService from googlePlaceCtrl
    var fullAddress = restaurantService.googlePlace;

    //iterate through the received address and save only the ones needed to RestaurantService restaurant
    if (fullAddress != null) {
      for (var i = 0; i < fullAddress.length; i++) {
        var addressType = fullAddress[i].types[0];

        //if the given address attribute matches one of the componentForms
        if (componentForm[addressType]) {
          var val = fullAddress[i][componentForm[addressType]];
          $scope.restaurant[addressType] = val;
        }
      }
    } else {

    }
  }

  //cancatenate time string
  $scope.buildTime = function () {
    $scope.restaurant['open_hour'] = $scope.operationHours['openHour'] + ":" + $scope.operationHours['openMin'] + $scope.operationHours['open'];
    $scope.restaurant['close_hour'] = $scope.operationHours['closeHour'] + ":" + $scope.operationHours['closeMin'] + $scope.operationHours['close'];
  }

  //create a form_data for uploaded file
  $scope.uploadFile = function(restaurant_id) {
    angular.forEach(restaurantService.getFileList(), function (form_data) {
      form_data.append('restaurant_id', restaurant_id);
      restaurantService.uploadFile(form_data);
    });
  }

  //save upload file to restaurantService
  $scope.saveFile = function() {
    angular.forEach($scope.files, function (file) {
      var form_data = new FormData();
      //append file itself
      form_data.append(file.file_type, file[0]);
      //append file type indicator
      form_data.append('file_type', file.file_type);

      var table_name = (file.file_type).split("_")[0];

      if(table_name == 'restaurant') {
        form_data.append('table_name', 'tb_restaurant');
      } else if (table_name == 'user') {
        form_data.append('table_name', 'tb_user_info');
      } else {}

      restaurantService.pushToFileList(form_data);
    });
  }

  $scope.testing = function() {
    $scope.saveFile();
    $scope.uploadFile();
  }
}]);
