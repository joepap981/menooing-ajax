angular.module('menuApp').controller('UserDashboardController',['$scope', 'accessDB', function ($scope, accessDB) {
  $scope.page = 'dashboard';
  $scope.selectPage = function (pageNum) {
    this.page = pageNum;
  }

  //Restaurant registration
  $scope.restaurant = {};
  //submit input form information to DB
  $scope.registerRestaurant = function () {
    if ($scope.restaurantRegistration.$valid) {
      accessDB.insertRestaurantInfo(this.restaurant).then(function(response) {
        if (response == true) {
          console.log("Successfully insert to DB");

          this.page = "restaurant";
        } else {
          console.log("Failed to insert to DB");
        }
      });
    } else {
      $scope.restaurantRegistration.submitted = true;

    }
  }
}]);
