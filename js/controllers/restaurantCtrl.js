angular.module('menuApp').controller('restaurantCtrl',['$scope', '$location', 'accessDB', 'growl', '$window', function ($scope, $location, accessDB, growl, $window) {

  $scope.userRestaurants = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurantList = accessDB.getRestaurantList();
    restaurantList.then (function (result) {
      $scope.userRestaurants = result;
    });
  }
  //run initialization method
  init();

}]);
