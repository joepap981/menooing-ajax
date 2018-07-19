angular.module('menuApp').controller('userRequestCtrl',['$scope', '$location', 'authService', 'adminService', 'growl', function ($scope, $location, authService, adminService, growl) {
  //the selected request from table
  $scope.selectedRequest;

  //sender of the request that is currently selected
  $scope.selectedUser;

  //session user information
  $scope.sessionResponse;

  //list of requests that satisfies user conditions
  $scope.Requests = [];
  var init = function () {
    authService.checkSession().then(function (response) {
      $scope.sessionResponse = response;
      //get list ore requests
      updateRequestList();
    });
  }

  //get the list of rent_request for the current session user that have been verified by admin - request_status: ADMIN_VERIFIED
  var updateRequestList = function () {
    var query = "SELECT * FROM tb_request WHERE request_host_user_ref = '" + $scope.sessionResponse.user_id +
    "' and (request_status = 'ADMIN_VERIFIED' or request_status = 'ALLOWED' or request_status = 'DENIED');";

    var requestList = authService.directQuery(query);
    requestList.then (function (result) {
      $scope.Requests = result;
      $scope.requestTotalItems = $scope.Requests.length;
    });
  }

  //initialize
  init();

  //when a request is selected, load the appropriate information depending on type of request
  $scope.loadRequest = function (request) {
    $scope.selectedRequest = request;
    updateRentTimes();
     if ($scope.selectedRequest.request_type == "rent_request") {
      getGuestUser();
    } else {

    }
  }

  //******request pagination
  $scope.requestViewby = 10;
  $scope.requestCurrentPage = 1;
  $scope.requestItemsPerPage = 10;
  $scope.requestMaxSize = 5; //Number of pager buttons to show
  $scope.requestTotalItems;

  $scope.setPage = function (pageNo) {
    $scope.requestCurrentPage = pageNo;
  };

  $scope.pageChanged = function() {
    console.log('Page changed to: ' + $scope.requestCurrentPage);
    console.log($scope.requestViewby);
    console.log($scope.requestTotalItems);
  };


  //button color and message UI
  $scope.userCertButton = "btn-danger";
  $scope.userCertMessage = "No file";
  $scope.userSSNButton = "btn-danger";
  $scope.userSSNMessage = "No file";


  var userSSNGreen = function () {
    $scope.userSSNButton = "btn-success";
    $scope.userSSNMessage = "View User Identification";
  }

  //change user certificate buttons to indicate file exists
  var userCertGreen = function () {
    $scope.userCertButton = "btn-success";
    $scope.userCertMessage = "View User Certificate";
  }

  //download file
  $scope.downloadFile = function (file_type) {
    if (file_type == "user_ssn") {
      var path = $scope.selectedUser.user_ssn;
    } else if (file_type == "user_cert") {
      var path = $scope.selectedUser.user_cert;
    } else {
      console.log(file_type + " does not exist.");
      return;
    }

    var post_data = {
      'user_id': $scope.selectedUser2.user_id,
      'path': path,
    }

    var downloadResult = authService.downloadFile (post_data);
  }


  //change rent request status
  $scope.changeRequestStatus = function(request_update) {
    var post_info = {};
    post_info['table_name'] = 'tb_request';
    post_info['update_info'] = {'request_status': request_update};
    post_info['condition'] = {'request_id': $scope.selectedRequest.request_id };

    var statusUpdateResult = authService.updateInfo(post_info);
    statusUpdateResult.then(function(result) {
      if (result == "Successfully updated information") {
        var message = "You have " + request_update + " the request";
        growl.success(message ,{title: 'Success!'});
        $('#requestModal').modal('hide');
        //update request list
        updateRequestList();
      }else if (result == "Failed to update information") {
        growl.error("Failed to update information!" ,{title: 'Error!'});
      }else {
        growl.error("Something has gone terribly wrong. Refresh and try again!" ,{title: 'Error!'});
      }
    });
  }

  //get the user information of the request sender (the guest rentee)
  var getGuestUser = function () {
    var queryObj = {
      "table_name": "tb_user_info",
      "condition": {"user_ref":  $scope.selectedRequest.user_ref}
    };

    var getUser = authService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.selectedUser = result[0];

      //change certification related buttons and messages to green (file found)
      if ($scope.selectedUser['user_cert'] != null){
        userCertGreen();
      }
      if ($scope.selectedUser['user_ssn'] != null){
        userSSNGreen();
      }
    });

    var queryObj = {
      "table_name": "tb_user",
      "condition": {"user_id":  $scope.selectedRequest.user_ref}
    };

    var getUser = authService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.selectedUser2 = result[0];
    });
  }

  //update avaiable list for individual request modal
  var updateRentTimes = function () {
    var queryObj = {
      "table_name": "tb_rent_time",
      "condition": {"request_ref": $scope.selectedRequest.request_id}
    };

    //bring restaurant information based on restaurant id
    var getAvailable = authService.getInfo(queryObj);
    getAvailable.then(function (result) {
      $scope.rentTime = result;
    })
  }



  //*******************************************************//
  //request frontend code
  //filter for request status - handled, unhandled
  $scope.request_status_filter = undefined;

  //custome filter for request status
  $scope.requestStatusFilter = function (item) {
    //return item that have been handled - HANDLED, ALLOWED, DENIED
    if ($scope.request_status_filter == true) {
      return item.request_status != 'UNHANDLED' && item.request_status != 'ADMIN_VERIFIED';
      //return items that have not been handled - UNHANDLED
    } else if ($scope.request_status_filter == false){
      return item.request_status == 'UNHANDLED' || item.request_status == 'ADMIN_VERIFIED';
      //return all items without filter
    } else {
      return item;
    }
  }

  $scope.changeRequestStatusFilter = function (status) {
    $scope.request_status_filter = status;
  }

  //sent or received request
  $scope.request_owner = 'received';

  $scope.changeRequestOwnerFilter = function (status) {
    $scope.request_owner = status;
    console.log($scope.sessionResponse.user_id);
  }

  //custome filter for request ownership
  $scope.requestStatusFilter = function (item) {
    //return item that have been handled - HANDLED, ALLOWED, DENIED
    if ($scope.request_owner == "sent") {
      return item.request_user_ref == $scope.sessionResponse.user_id;
      //return items that have not been handled - UNHANDLED
    } else if ($scope.request_owner == "received"){
      return item.request_status == 'UNHANDLED' || item.request_status == 'ADMIN_VERIFIED';
      //return all items without filter
    } else {
      return item;
    }
  }

}]);
