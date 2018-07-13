angular.module('menuApp').controller('restaurantGuestProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {
  $scope.restaurant = {};
  $scope.user = {};

  //variables holding card lists
  $scope.availableTime = {};
  $scope.equipmentList = {};
  $scope.facilityList = {};
  $scope.fileList = {};

  //form input variables
  $scope.input = {};

  //variables for file uploads
  $scope.files = {};

  var restaurant_id;


  $scope.input.day = "Monday";


  //initializing function
  var init = function () {
    //get the restaurant id from the url
    var url = $location.path().split('/');
    restaurant_id = url.pop();

    //bring restaurant information based on restaurant id
    updateRestaurantList();
    updateAvailableList();
    updateEquipmentList();
    updateFacilityList();
  }

  //initialize function at loading of controller

  $scope.redirectToRequest = function () {
    $location.path('/restaurant-guest-request/'+$scope.restaurant.restaurant_id);
  };

  var updateUser = function () {
    var queryObj = {
      "table_name": "tb_user_info",
      "condition": {"user_ref":  $scope.restaurant.user_ref}
    };

    //bring restaurant information based on restaurant id
    var getUser = authService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.user = result;
    })
  }

  var updateFacilityList = function () {
    var queryObj = {
      "table_name": "tb_restaurant_facility",
      "condition": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getFacility = authService.getInfo(queryObj);
    getFacility.then(function (result) {
      $scope.facilityList = result;
    })
  }

  var updateEquipmentList = function () {
    var queryObj = {
      "table_name": "tb_restaurant_equipment",
      "condition": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getEquipment = authService.getInfo(queryObj);
    getEquipment.then(function (result) {
      $scope.equipmentList = result;
    })
  }

  var updateAvailableList = function () {
    var queryObj = {
      "table_name": "tb_restaurant_available",
      "condition": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getAvailable = authService.getInfo(queryObj);
    getAvailable.then(function (result) {
      $scope.availableTime = result;
    })
  }

  var updateRestaurantList = function () {
    var queryObj = {
      "table_name": "tb_restaurant",
      "condition": {"restaurant_id": restaurant_id }
    };
    //bring restaurant information based on restaurant id
    var getRestaurant = authService.getInfo(queryObj);
    getRestaurant.then(function (result) {
      $scope.restaurant = result[0];
      $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;
    })
  }


  //extract required address information
  $scope.updateAddress = function () {
    var restaurant_address ={};
    //attributes from autocomplete that needs to be saved
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    //get the address saved to RestaurantService from googlePlaceCtrl
    var fullAddress = restaurantService.googlePlace;

    //iterate through the received address and save only the ones needed to RestaurantService restaurant
    if (fullAddress != null) {
      for (var i = 0; i < fullAddress.length; i++) {
        var addressType = fullAddress[i].types[0];

        //if the given address attribute matches one of the componentForms
        if (componentForm[addressType]) {
          var val = fullAddress[i][componentForm[addressType]];
          restaurant_address["restaurant_" + addressType] = val;
        }
      }

      //update restaurant with given information

      var post_data = {};
      post_data['table_name'] = 'tb_restaurant';
      post_data['update_info'] = restaurant_address;
      post_data['condition'] = {'restaurant_id': restaurant_id };

      var addressUpdateResult = authService.updateInfo(post_data);
      addressUpdateResult.then(function(result) {
        if (result == "Successfully updated information") {

          //bring restaurant information based on restaurant id
          updateRestaurantList();

          //collapse cuisine editing card
          $('#collapseAddress').collapse('hide');

          //clear input box
          $('#autocomplete').val('');
          //show succcess message
          growl.success('Address has been successfully updated.',{title: 'Success!'});
        } else if (result == "Failed to update information") {
          //show failed message
          growl.error('Address has failed to update. Refresh and try again.',{title: 'Error!'});
        }else {
          //show error message
          growl.error('Something has gone wrong.',{title: 'Error!'});
        }
      })

    } else {
      growl.error('There was no readable address.',{title: 'Error!'});
    }
  }


  //Restaurant Price

  //toggle the description input box from view mode <-> edit mode

  //Restaurant Available Time


  //ID of the equipment that is currently being edited
  $scope.editEquipmentID;
  $scope.editEquipment;

  $scope.setEquipmentEdit = function (equipment_id) {
    $scope.editEquipmentID = equipment_id;
    var filterEquipment = $scope.equipmentList.filter(function( obj ) {
      return obj.equipment_id == equipment_id;
    })

    $scope.editEquipment = filterEquipment[0];
  }

  //ID of the equipment that is currently being edited
  $scope.editFacilityID;
  $scope.editFacility;

  init();
}]);
