angular.module('menuApp').controller('adminRequestCtrl',['$scope', '$location', 'authService', 'adminService', 'restaurantService', 'growl', function ($scope, $location, authService, adminService, restaurantService, growl) {
  $scope.selectedRequest;
  $scope.selectedRestaurant;
  $scope.selectedUser;

  $scope.Requests = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var requestList = adminService.getRequestList();
    requestList.then (function (result) {
      $scope.Requests = result;
      $scope.totalItems = $scope.Requests.length;
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

  $scope.loadRequest = function (request) {
    $scope.selectedRequest = request;
    getRestaurant($scope.selectedRequest.restaurant_ref);
  }

  //request pagination
  $scope.viewby = 10;
  $scope.currentPage = 1;
  $scope.itemsPerPage = 10;
  $scope.maxSize = 5; //Number of pager buttons to show
  $scope.totalItems;

  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
  };

  $scope.pageChanged = function() {
    console.log('Page changed to: ' + $scope.currentPage);
    console.log($scope.viewby);
    console.log($scope.totalItems);
  };

  var getRestaurant = function (restaurant_id) {
    var queryObj = {
      "table": "tb_restaurant",
      "key": {"restaurant_id": restaurant_id }
    };
    //bring restaurant information based on restaurant id
    var getRestaurant = restaurantService.getInfo(queryObj);
    getRestaurant.then(function (result) {
      $scope.selectedRestaurant = result[0];
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
      "table": "tb_user_info",
      "key": {"user_ref":  $scope.selectedRestaurant.user_ref}
    };

    //bring restaurant information based on restaurant id
    var getUser = restaurantService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.selectedUser = result[0];
      console.log($scope.selectedUser);
      //change certification related buttons and messages to green (file found)
      if ($scope.selectedUser['user_cert'] != null){
        userCertGreen();
      }
    });

    var queryObj = {
      "table": "tb_user",
      "key": {"user_id":  $scope.selectedRestaurant.user_ref}
    };

    var getUser = restaurantService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.selectedUser2 = result[0];
    });
  }

  $scope.restaurantCertButton = "btn-danger";
  $scope.userCertButton = "btn-danger";
  $scope.restaurantCertMessage = "No file";
  $scope.userCertMessage = "No file";

  //change restaurant certificate buttons to indicate file exists
  var restaurantCertGreen = function () {
    $scope.restaurantCertButton = "btn-success";
    $scope.restaurantCertMessage = "View Restaurant Certificate";
  }

  //change restaurant certificate buttons to indicate file exists
  var userCertGreen = function () {
    $scope.userCertButton = "btn-success";
    $scope.userCertMessage = "View User Certificate";
  }

  //download file
  $scope.downloadFile = function (file_type) {
    if (file_type == "restaurant_cert") {
      var path = $scope.selectedRestaurant.restaurant_cert;
    } else if (file_type == "user_cert") {
      var path;
    } else {
      console.log(file_type + " does not exist.");
      return;
    }

    var post_data = {
      'user_id': $scope.restaurant.user_ref,
      'path': path,
    }

    var downloadResult = authService.downloadFile (post_data);
  }

  $scope.changeRestaurantStatus = function (status) {
    var post_info = {};
    post_info['table_name'] = 'tb_restaurant';
    post_info['update_info'] = {'restaurant_status': status};
    post_info['condition'] = {'restaurant_id': $scope.selectedRestaurant.restaurant_id };

    var statusUpdateResult = restaurantService.updateInfo(post_info);
    statusUpdateResult.then(function(result) {
      if (result == "Successfully updated information") {
        //update restaurantList
        getRestaurant();

        var post_info = {};
        post_info['table_name'] = 'tb_request';
        post_info['update_info'] = {'request_status': 'HANDLED'};
        post_info['condition'] = {'request': $scope.selectedRequest.request_id };

        var statusUpdateResult = restaurantService.updateInfo(post_info);
        statusUpdateResult.then(function(result) {
          var requestList = adminService.getRequestList();
          requestList.then (function (result) {
            $scope.Requests = result;
            $scope.totalItems = $scope.Requests.length;
          });
        });

        growl.success('Status has been successfully updated.',{title: 'Success!'});
      } else if (result == "Failed to update information") {
        growl.error('Status has failed to update.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    })
  }

}]);
