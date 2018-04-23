angular.module('eatersAndChefs').controller('mainCtrl',['$scope','$http','$route','$location','$element', 'formService', function ($scope, $http, $route, $location, $element, formService) {
  $scope.redirect = function(url) {
    $location.path(url);
  }


  var url = $location.path().split('/');
  console.log(url);



}]);
