angular.module('menuApp').controller('UserDashboardController',['$scope', function ($scope) {
  $scope.page = 'dashboard';
  $scope.selectPage = function (pageNum) {
    this.page = pageNum;
  }
}]);
