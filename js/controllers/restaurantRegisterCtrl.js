angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'authService', 'growl', '$window', function ($scope, $location, restaurantService, authService, growl, $window) {

  $scope.restaurant = {};
  $scope.user = {};
  $scope.files = {};

  $scope.registerRestaurant = function (redirectLocation) {
    restaurantService.saveToSession('restaurant', $scope.restaurant);
    restaurantService.saveToSession('user', $scope.user);
    $location.path(redirectLocation);
  }

  //create restaurant and insert to DB
  $scope.createRestaurant = function () {
    var session = authService.checkSession();
    //check for session
    session.then(function (result) {

      //if a user is in session
      if (result["user_id"] != null) {
        $scope.restaurant.entity = $window.sessionStorage.restaurant.entity;


        restaurantService.insertRestaurantInfo($scope.restaurant).then(function(response) {
          if (!isNaN(response)) {
            $window.sessionStorage.created_restaurant_id = response;
            $location.path('restaurant-new-success');
            growl.success('Your restaurant has successfully been created.',{title: 'Success!'});
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
    //if user has selected all of the operation hour selections
    //build the operation hours and update
    for (var element in $scope.operationHours) {
      if ($scope.operationHours[element] == null) {
        growl.warning('Fill in all of the operation hour selections', {title: 'Warning'});
        return false;
      }
    }
    $scope.restaurant['open_hour'] = $scope.operationHours['openHour'] + ":" + $scope.operationHours['openMin'] + $scope.operationHours['open'];
    $scope.restaurant['close_hour'] = $scope.operationHours['closeHour'] + ":" + $scope.operationHours['closeMin'] + $scope.operationHours['close'];

    $scope.registerRestaurant('restaurant-new-host4');
  }

  //create a form_data for uploaded file
  $scope.getAndUploadFile= function(restaurant_id) {
    //incomplete way of checking if both files were successfully uploaded.
    var flag = true;
    angular.forEach(restaurantService.getFileList(), function (form_data) {
      form_data.append('restaurant_id', restaurant_id);
      flag = flag && restaurantService.uploadFile(form_data);
    });

    return flag;
  }

  //save upload file to restaurantService
  //create form_data package
  //file name : File
  //file_type: file_name
  //table_name : table_name
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
