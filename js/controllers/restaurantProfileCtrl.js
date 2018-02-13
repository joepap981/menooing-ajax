angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', 'accessDB', 'growl', function ($scope, $location, accessDB, growl, $uibModal) {

  $scope.restaurant = {
    "restaurant_name": "Sushiyaa"
  }
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurant= accessDB.getRestaurantInfo("1");
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
