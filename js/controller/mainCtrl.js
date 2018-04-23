angular.module('eatersAndChefs').controller('mainCtrl',['$scope','$http','$route','$location', 'formService', function ($scope, $http, $route, $location, formService) {
  $scope.redirect = function(url) {
    $location.path(url);
  }

  $scope.checkURL = function () {
    var check = $location.path().split('/').pop();
    if (check == "") {
      return true;
    } else {
      return false;
    };
  }

}]);
