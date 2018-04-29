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

  $('#messageModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    $scope.selectedMessage = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


    //get restaurant information from database
    //

    //console.log($scope.selectedRequest);
    var modal = $(this);
    modal.find('.modal-title').text("Message from " + $scope.selectedMessage.message_email);
    modal.find('.modal-body p').text($scope.selectedMessage.message_content);
  })
}]);
