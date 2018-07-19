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
    var post_data = {
      "table_name": "tb_request",
      "condition": {
        "user_ref": $scope.sessionResponse.user_id,
        "request_status": "'ADMIN_VERIFIED'",
      }
    };

    var requestList = authService.getInfo(post_data);
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

  //change restaurant certificate buttons to indicate file exists
  var restaurantCertGreen = function () {
    $scope.restaurantCertButton = "btn-success";
    $scope.restaurantCertMessage = "View Restaurant Certificate";
  }

  var userSSNGreen = function () {
    $scope.userSSNButton = "btn-success";
    $scope.userSSNMessage = "View User Identification";
  }

  //change restaurant certificate buttons to indicate file exists
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


  //change restaurant rent request
  $scope.changeRequestStatus = function(request_update) {
    var post_info = {};
    post_info['table_name'] = 'tb_request';
    post_info['update_info'] = {'request_status': request_update};
    post_info['condition'] = {'request_id': $scope.selectedRequest.request_id };

    var statusUpdateResult = authService.updateInfo(post_info);
    statusUpdateResult.then(function(result) {
      //update request list
      updateRequestList();
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

  $scope.redirectToRestaurantProfile = function () {
    $('body').removeClass('modal-open')
    $('.modal-backdrop').remove();
    $location.path('/admin/restaurant-profile/'+ $scope.selectedRequest.request_host_restaurant_ref);
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

}]);
