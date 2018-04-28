angular.module('eatersAndChefs').controller('adminMessageCtrl',['$scope','$http','$route', 'adminService', function ($scope, $http, $route, adminService) {
  $scope.Messages = [];

  var init = function () {
    //get all restaurants from user in current session (check in server)
    var table_name = "tb_message";
    var messageList = adminService.getList(table_name);
    messageList.then (function (result) {
      $scope.Messages = result;
    });
  }

  init();


}]);
