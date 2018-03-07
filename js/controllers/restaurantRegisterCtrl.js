angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {

  $scope.restaurant = {};

  $scope.registerRestaurant = function (entity) {
    if (entity == 'sharer') {
      restaurantService.buildRestaurant('restaurant_entity', 'sharer');
      var sample = restaurantService.getRestaurant();
      console.log(sample);
      $location.path('/restaurant-new-sharer');
    } else {
      restaurantService.buildRestaurant('restaurant_entity', 'sharee');
      var sample = restaurantService.getRestaurant();
      console.log(sample);
      $location.path('/restaurant-new-sharee');
    }
  }

  $scope.registerRestaurant_2 = function () {
      console.log($window.sessionStorage.restaurant['restaurant_entity']);
  }

  $scope.saveAndContinue = function (location) {
    //$sessionStorage.restaurant = $scope.restaurant;
    $location.path(location);
  }
}]);
