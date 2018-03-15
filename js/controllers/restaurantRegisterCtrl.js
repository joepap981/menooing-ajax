angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'accessDB', 'growl', '$window', function ($scope, $location, restaurantService, accessDB, growl, $window) {

  $scope.excessCapacity = {};
  $scope.operationHours = {};
  $scope.restaurant = {};
  $scope.user = {};

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
    session.then(function (result) {
      if (result["user_id"] != null) {
        restaurantService.insertRestaurantInfo().then(function(response) {
          if (response == 1) {
            restaurantService.insertUserInfo().then(function(response2) {
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
          } else if (response == 0) {
            growl.error('Your restaurant has failed to be registered. Try again from the beginning.',{title: 'DB Error!'});
          } else {
            growl.error('Something has gone terribly wrong. Notify the admin about this.',{title: 'Error!'});
          }
        });
      }
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
}]);
