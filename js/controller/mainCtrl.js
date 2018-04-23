angular.module('eatersAndChefs').controller('contactFormCtrl',['$scope','$http','$route', 'formService', function ($scope, $http, $route, formService) {
  $scope.redirect = function(url) {
    $location.path(url);
  }

}]);
