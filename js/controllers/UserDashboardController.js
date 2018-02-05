angular.module('menuApp').controller('UserDashboardController',['$scope', function ($scope) {
  $scope.page = 1;
  $scope.selectPage = function (pageNum) {
    this.page = pageNum;
  }
}]);
