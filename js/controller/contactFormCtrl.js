angular.module('eatersAndChefs').controller('contactFormCtrl',['$scope','$http','$route', 'formService', function ($scope, $http, $route, formService) {
  $scope.form = {};

  //send form message to database
  $scope.sendMessage = function () {
    var packet = {};
    packet.type = "message";
    packet.content = $scope.form;
    formService.post(packet);
  }

}]);
