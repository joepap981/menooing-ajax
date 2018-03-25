angular.module('menuApp').controller('adminRequestCtrl',['$scope', 'adminService', 'growl', function ($scope, adminService, growl) {
  $scope.selectedRequest;

  $scope.Requests = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var requestList = adminService.getRequestList();
    requestList.then (function (result) {
      $scope.Requests = result;
    });
  }

  init();


  $('#requestModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    $scope.selectedRequest = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


    //get restaurant information from database
    //

    console.log($scope.selectedRequest);
    var modal = $(this);
    modal.find('.modal-title').text($scope.selectedRequest.request_type + ' request from ' + $scope.selectedRequest.restaurant_ref);
    modal.find('.modal-body input').val($scope.selectedRequest.request_type);
  })

  //confirm request
  $scope.confirmRequest = function () {
    var data = {};
    data['request_type'] = $scope.selectedRequest['request_type'];
    data['restaurant_ref'] = $scope.selectedRequest['restaurant_ref'];
    data['request_id'] = $scope.selectedRequest['request_id']
    adminService.confirmRestaurantRegister(data)
    .then(function mySuccess(response) {
      if(response == "Successfully updated restaurant status") {
        growl.success(response,{title: 'Success!'});
        $('#requestModal').modal('hide');
      } else {
        growl.error(response,{title: 'Error!'});
      }
    });
  }



}]);
