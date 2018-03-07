angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {

  $scope.restaurant = {};

  $scope.registerRestaurant = function (entity) {
    if (entity == 'sharer') {
      restaurantService.buildRestaurant('restaurant_entity', 'sharer');
      $location.path('/restaurant-new-sharer');
    } else {
      restaurantService.buildRestaurant('restaurant_entity', 'sharee');
      $location.path('/restaurant-new-sharee');
    }
  }

  $scope.registerSharer = function () {
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    var fullAddress = restaurantService.getRestaurant().address;

    for (var i = 0; i < fullAddress.length; i++) {
      var addressType = fullAddress[i].types[0];
      if (componentForm[addressType]) {
        var val = fullAddress[i][componentForm[addressType]];
        restaurantService.buildRestaurant(addressType, val);
      }
    }

    console.log(restaurantService.getRestaurant());
  }

  $scope.saveAndContinue = function (location) {
    //$sessionStorage.restaurant = $scope.restaurant;
    $location.path(location);
  }
}]);
