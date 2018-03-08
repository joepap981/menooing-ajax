angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {


  $scope.restaurant = {};

  //set value to $scope.restaurant
  $scope.setRestaurantData = function (key, value) {
    $scope.restaurant[key] = value;
  }

  //add data to sessionStorage restaurant
  $scope.registerRestaurant = function (redirectLocation) {
    restaurantService.saveRestaurantToSession($scope.restaurant);
    console.log($window.sessionStorage.restaurant);
    $location.path(redirectLocation);
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
      if (componentForm[addressType]) {
        var val = fullAddress[i][componentForm[addressType]];

        $scope.restaurant[addressType] = val;
      }
    }
  }

  //new-sharer2: adding name and mobile; certificates
  $scope.registerSharer2 = function () {
    for(key in $scope.restaurant) {
      restaurantService.buildRestaurant(key, $scope.restaurant[key]);
    }
    restaurantService.saveRestaurantToSession();
    $location.path('restaurant-new-sharer3');
    console.log($window.sessionStorage.restaurant);
  }




}]);
