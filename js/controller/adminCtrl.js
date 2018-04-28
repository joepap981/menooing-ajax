angular.module('eatersAndChefs').controller('adminCtrl',['$scope','$http','$route', 'formService', function ($scope, $http, $route, formService) {
  $scope.page = "dashboard";

  $scope.changePage = function (page) {
    $scope.page = page;
  }

  $scope.checkPage = function (page) {
    if ($scope.page == page){
      return true;
    }else {
      return false;
    }
  }


}]);
