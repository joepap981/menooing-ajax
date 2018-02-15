angular.module('menuApp').controller('UserDashboardController',['$scope', '$location', 'accessDB', 'growl', function ($scope, $location, accessDB, growl, $uibModal) {


  //menu add
  $scope.menu = {};
  $scope.clearForm = function () {
    $scope.menu = {};
  }
}]);
