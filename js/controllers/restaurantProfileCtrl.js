angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', 'authService', 'growl', function ($scope, $location, authService, growl, $uibModal) {

  $scope.restaurant = {
    "restaurant_name": "Sushiyaa"
  }
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurant= authService.getRestaurantInfo("1");
    restaurant.then (function (result) {
      $scope.restaurant = result;
    });
  };

  //run initialization method
  init();

  //menu add
  $scope.menu = {};
  $scope.clearForm = function () {
    $scope.menu = {};
  }
}]);
