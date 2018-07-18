angular.module('menuApp').controller('adminRequestCtrl',['$scope', '$location', 'authService', 'adminService', 'growl', function ($scope, $location, authService, adminService, growl) {
  $scope.selectedRequest;
  $scope.selectedRestaurant;
  var restaurant_id;
  $scope.selectedUser;

  $scope.Requests = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    updateRequestList();
  }

  var updateRequestList = function () {
    //get all restaurants from user in current session (check in server)
    var requestList = adminService.getRequestList();
    requestList.then (function (result) {
      $scope.Requests = result;
      $scope.requestTotalItems = $scope.Requests.length;
    });
  }

  init();

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

  //when a request is selected, load the appropriate information depending on type of request
  $scope.loadRequest = function (request) {
    $scope.selectedRequest = request;
    if($scope.selectedRequest.request_type == "restaurant_confirmation") {
      getRestaurant($scope.selectedRequest.restaurant_ref);
    } else if ($scope.selectedRequest.request_type == "rent_request") {
      getGuestUser();
    } else if ($scope.selectedRequest.request_type == "user_verification") {
      getGuestUser();
    } else {

    }
  }

  //request pagination
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

  var getRestaurant = function (restaurant_id) {
    var queryObj = {
      "table_name": "tb_restaurant",
      "condition": {"restaurant_id": restaurant_id }
    };
    //bring restaurant information based on restaurant id
    var getRestaurant = authService.getInfo(queryObj);
    getRestaurant.then(function (result) {
      $scope.selectedRestaurant = result[0];
      adminService.selectedRestaurant = $scope.selectedRestaurant
      getUser();
      //change certification related buttons and messages to green (file found)
      if ($scope.selectedRestaurant['restaurant_cert'] != null){
        restaurantCertGreen();
      }
      $scope.selectedRestaurant.address = $scope.selectedRestaurant.restaurant_street_number + " " + $scope.selectedRestaurant.restaurant_route + " " + $scope.selectedRestaurant.restaurant_locality + ", " + $scope.selectedRestaurant.restaurant_administrative_area_level_1;
    })
  }

  var getUser = function () {
    var queryObj = {
      "table_name": "tb_user_info",
      "condition": {"user_ref":  $scope.selectedRestaurant.user_ref}
    };

    //bring restaurant information based on restaurant id
    var getUser = authService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.selectedUser = result[0];

      //change certification related buttons and messages to green (file found)
      if ($scope.selectedUser['user_ssn'] != null){
        userSSNGreen();
      }

    });

    var queryObj = {
      "table_name": "tb_user",
      "condition": {"user_id":  $scope.selectedRestaurant.user_ref}
    };

    var getUser = authService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.selectedUser2 = result[0];
    });
  }

  var getGuestUser = function () {
    var queryObj = {
      "table_name": "tb_user_info",
      "condition": {"user_ref":  $scope.selectedRequest.user_ref}
    };

    //bring restaurant information based on restaurant id
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

  $scope.restaurantCertButton = "btn-danger";
  $scope.userCertButton = "btn-danger";
  $scope.restaurantCertMessage = "No file";
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
    } else if (file_type == "restaurant_cert") {
      var path = $scope.selectedRestaurant.restaurant_cert;
    }
    else {
      console.log(file_type + " does not exist.");
      return;
    }

    var post_data = {
      'user_id': $scope.restaurant.user_ref,
      'path': path,
    }

    var downloadResult = authService.downloadFile (post_data);
  }

  //update restaurant status in db
  $scope.changeRestaurantStatus = function (status) {
    var post_info = {};
    post_info['table_name'] = 'tb_restaurant';
    post_info['update_info'] = {'restaurant_status': status};
    post_info['condition'] = {'restaurant_id': $scope.selectedRestaurant.restaurant_id };

    var statusUpdateResult = authService.updateInfo(post_info);
    statusUpdateResult.then(function(result) {
      if (result == "Successfully updated information") {
        //update restaurantList
        getRestaurant();

        var request_status;
        if (status == 'CONFIRMED') {
          request_status = 'AUTHORIZED';
        } else if (status = 'UNCONFIRMED') {
          request_status = 'DENIED';
        }
        $scope.changeRequestStatus(request_status);

        growl.success('Status has been successfully updated.',{title: 'Success!'});
      } else if (result == "Failed to update information") {
        growl.error('Status has failed to update.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    })
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

  //change restaurant rent request
  $scope.changeUserStatus = function(user_status) {
    var post_info = {};
    post_info['table_name'] = 'tb_user_info';
    post_info['update_info'] = {'user_status': user_status};
    post_info['condition'] = {'user_ref': $scope.selectedRequest.user_ref };

    var statusUpdateResult = authService.updateInfo(post_info);
    statusUpdateResult.then(function(result) {
      console.log(result);
      //update request list
      updateRequestList();
      //update user info
      getGuestUser();
    });
  }

  $scope.redirectToRestaurantProfile = function () {
    $('body').removeClass('modal-open')
    $('.modal-backdrop').remove();
    $location.path('/admin/restaurant-profile/'+ $scope.selectedRequest.request_host_restaurant_ref);
  }


  //*******************************************************//
  //request frontend code

  $scope.request_type_filter = "all";
  var request_status_filter = "All";

  $scope.changeRequestStatusFilter = function (status) {
    request_status_filter = status;
    console.log($scope.request_type_filter);
    console.log(request_status_filter);
  }

}]);
