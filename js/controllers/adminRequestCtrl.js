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


  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    console.log(recipient);
    var modal = $(this);
    modal.find('.modal-title').text('New message to ' + recipient);
    modal.find('.modal-body input').val(recipient);
  })

}]);
