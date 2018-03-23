angular.module('menuApp').controller('adminRequestCtrl',['$scope', 'adminService', function ($scope, adminService) {
  $scope.Requests = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var requestList = adminService.getRequestList();
    requestList.then (function (result) {
      $scope.Requests = result;
    });
  }

  init();
}]);
