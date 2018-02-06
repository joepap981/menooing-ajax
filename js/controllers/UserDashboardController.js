angular.module('menuApp').controller('UserDashboardController',['$scope', function ($scope) {
  $scope.page = 'dashboard';
  $scope.selectPage = function (pageNum) {
    this.page = pageNum;
  }

  //Restaurant registration
  $scope.restaurant = {};
  //submit input form information to DB
  $scope.registerRestaurant = function () {
    if ($scope.restaurantRegistration.$valid) {
      console.log("valid");
    } else {
      $scope.restaurantRegistration.submitted = true;
      console.log($scope.restaurantRegistration.$valid);

    }
  }
}]);
