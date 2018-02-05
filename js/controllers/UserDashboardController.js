angular.module('menuApp').controller('UserDashboardController',['$scope', '$http','$route', function ($scope, $http, $route) {
  this.page = 1;
  $scope.selectPage = function (pageNum) {
    this.page = pageNum;
  }

  $scope.isSelected = function (pageNum) {
    return this.page === pageNum;
  }
}]);
