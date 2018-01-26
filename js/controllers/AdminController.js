angular.module('menuApp').controller('AdminController',['$scope', '$http','$route', function ($scope, $http, $route) {
  $scope.pageNum = 1;

  $scope.changePage = function (num) {
      $scope.pageNum = num;
  }
}]);
