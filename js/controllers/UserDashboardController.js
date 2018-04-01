angular.module('menuApp').controller('UserDashboardController',['$scope', '$location', 'authService', 'growl', function ($scope, $location, authService, growl, $uibModal) {

  


  //menu add
  $scope.menu = {};
  $scope.clearForm = function () {
    $scope.menu = {};
  }
}]);
