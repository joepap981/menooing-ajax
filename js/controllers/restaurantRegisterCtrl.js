angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'accessDB', 'growl', '$window', function ($scope, $location, restaurantService, accessDB, growl, $window) {

  $scope.excessCapacity = {};
  $scope.operationHours = {};
  $scope.restaurant = {};

  //add data to sessionStorage restaurant
  $scope.registerRestaurant = function (redirectLocation) {
    restaurantService.saveRestaurantToSession($scope.restaurant);
    console.log($window.sessionStorage.restaurant);
    $location.path(redirectLocation);
  }

  //create restaurant and insert to DB
  $scope.createRestaurant = function () {
    var session = accessDB.checkSession();
    session.then(function (result) {
      if (result["user_id"] != null) {
        $window.sessionStorage.restaurant['user_ref'] = result["user_id"];
        restaurantService.insertRestaurantInfo().then(function(response) {
        });
        $location.path('/restaurant-new-success');
      } else {
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
    for (var i = 0; i < fullAddress.length; i++) {
      var addressType = fullAddress[i].types[0];

      //if the given address attribute matches one of the componentForms
      if (componentForm[addressType]) {
        var val = fullAddress[i][componentForm[addressType]];
        $scope.restaurant[addressType] = val;
      }
    }
  }

  $scope.buildTime = function () {
    $scope.restaurant['restaurant_open_hour'] = $scope.operationHours['openHour'] + ":" + $scope.operationHours['openMin'] + $scope.operationHours['open'];
    $scope.restaurant['restaurant_close_hour'] = $scope.operationHours['closeHour'] + ":" + $scope.operationHours['closeMin'] + $scope.operationHours['close'];
  }
}]);
