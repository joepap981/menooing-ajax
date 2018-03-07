angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'accessDB', 'growl', '$window', function ($scope, $location, accessDB, growl, $window) {

  $scope.registerRestaurant = function (entity) {
    if (entity == 'sharer') {
      $window.sessionStorage.restaurant = 'sharer';
      $location.path('/restaurant-new-sharer');
    } else {
      $window.sessionStorage.restaurant = 'sharee';
      $location.path('/restaurant-new-sharee');
    }
  }

  $scope.saveAndContinue = function (location) {
    //$sessionStorage.restaurant = $scope.restaurant;
    $location.path(location);
  }
}]);
