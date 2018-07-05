angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {
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

    //check if the restaurant belongs to current session user
    var priviledgeCheck = restaurantService.checkPrivilege(restaurant_id);
    priviledgeCheck.then(function (result) {
      if(result == "ACCEPTED") {
        //bring restaurant information based on restaurant id
        updateRestaurantList();
        updateAvailableList();
        updateEquipmentList();
        updateFacilityList();


      } else if (result=="DENIED") {
        growl.error('You do not have privilege.',{title: 'Error!'});
        $location.path('/');
      } else if (result == "NO SESSION") {
        growl.error('Please log in to continue.',{title: 'Error!'});
        $location.path('/signin');
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
        $location.path('/');
      }
    })
  }

  //initialize function at loading of controller
  init();

  var updateUser = function () {
    var queryObj = {
      "table": "tb_user_info",
      "key": {"user_ref":  $scope.restaurant.user_ref}
    };

    //bring restaurant information based on restaurant id
    var getUser = restaurantService.getInfo(queryObj);
    getUser.then(function (result) {
      $scope.user = result[0];
      //change certification related buttons and messages to green (file found)
      if ($scope.user['user_cert'] != null){
        console.log($scope.user['user_cert']);
        userCertGreen();
      }
    })
  }

  var updateFacilityList = function () {
    var queryObj = {
      "table": "tb_restaurant_facility",
      "key": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getFacility = restaurantService.getInfo(queryObj);
    getFacility.then(function (result) {
      $scope.facilityList = result;
    })
  }

  var updateEquipmentList = function () {
    var queryObj = {
      "table": "tb_restaurant_equipment",
      "key": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getEquipment = restaurantService.getInfo(queryObj);
    getEquipment.then(function (result) {
      $scope.equipmentList = result;
    })
  }

  var updateAvailableList = function () {
    var queryObj = {
      "table": "tb_restaurant_available",
      "key": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getAvailable = restaurantService.getInfo(queryObj);
    getAvailable.then(function (result) {
      $scope.availableTime = result;
    })
  }

  var updateRestaurantList = function () {
    var queryObj = {
      "table": "tb_restaurant",
      "key": {"restaurant_id": restaurant_id }
    };
    //bring restaurant information based on restaurant id
    var getRestaurant = restaurantService.getInfo(queryObj);
    getRestaurant.then(function (result) {
      $scope.restaurant = result[0];
      updateUser();
      //change certification related buttons and messages to green (file found)
      if ($scope.restaurant['restaurant_cert'] != null){
        restaurantCertGreen();
      }
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

      var addressUpdateResult = restaurantService.updateInfo(post_data);
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

  //Restaurant Description

  //toggle the description input box from view mode <-> edit mode
  $scope.descriptionBoxSwitch = -1;
  $scope.toggleDescriptionBox = function () {
    $scope.descriptionBoxSwitch = $scope.descriptionBoxSwitch * -1;
  }

  $scope.updateDescription = function () {
    var post_info = {};
    post_info['table_name'] = 'tb_restaurant';
    post_info['update_info'] = {'restaurant_name': $scope.restaurant.restaurant_name, 'restaurant_description': $scope.restaurant.restaurant_description };
    post_info['condition'] = {'restaurant_id': restaurant_id };

    var descriptionUpdateResult = restaurantService.updateInfo(post_info);
    descriptionUpdateResult.then(function(result) {
      if (result == "Successfully updated information") {
        $scope.descriptionBoxSwitch = -1;

        //update restaurantList
        updateRestaurantList();

        growl.success('Description has been successfully updated.',{title: 'Success!'});
      } else if (result == "Failed to update information") {
        growl.error('Description has failed to update. Refresh and try again.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    })
  }

  //Restaurant Price

  //toggle the description input box from view mode <-> edit mode
  $scope.priceBoxSwitch = -1;
  $scope.togglePriceBox = function () {
    $scope.priceBoxSwitch = $scope.priceBoxSwitch * -1;
  }

  $scope.updatePrice = function () {
    var post_info = {};
    post_info['table_name'] = 'tb_restaurant';
    post_info['update_info'] = {'restaurant_fee': $scope.restaurant.restaurant_fee, 'restaurant_fee_standard':$scope.restaurant.restaurant_fee_standard };
    post_info['condition'] = {'restaurant_id': restaurant_id };

    var priceUpdateResult = restaurantService.updateInfo(post_info);
    priceUpdateResult.then(function(result) {
      if (result == "Successfully updated information") {
        $scope.priceBoxSwitch = -1;

        updateRestaurantList();

        growl.success('Pricing has been successfully updated.',{title: 'Success!'});
      } else if (result == "Failed to update information") {
        growl.error('Pricing has failed to update. Refresh and try again.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    })
  }

  //Restaurant Available Time

  $scope.beginTime = new Date();
  $scope.beginTime.setHours( 0 );
  $scope.beginTime.setMinutes( 0 );

  $scope.endTime = new Date();
  $scope.endTime.setHours( 0 );
  $scope.endTime.setMinutes( 0 );

  $scope.hstep = 1;
  $scope.mstep = 15;

  //frontend time spinner controlling functions
  $scope.addMinBegin = function () {
    var d = new Date();
    d.setHours( $scope.beginTime.getHours() );
    d.setMinutes( $scope.beginTime.getMinutes() + $scope.mstep );
    $scope.beginTime = d;

  }

  $scope.lessMinBegin = function () {
    var d = new Date();
    d.setHours( $scope.beginTime.getHours() );
    d.setMinutes( $scope.beginTime.getMinutes() - $scope.mstep );
    $scope.beginTime = d;

  }

  $scope.addMinEnd = function () {
    var d = new Date();
    d.setHours( $scope.endTime.getHours()  );
    d.setMinutes( $scope.endTime.getMinutes() + $scope.mstep );
    $scope.endTime = d;
  }

  $scope.lessMinEnd = function () {
    var d = new Date();
    d.setHours( $scope.endTime.getHours()  );
    d.setMinutes( $scope.endTime.getMinutes() - $scope.mstep );
    $scope.endTime = d;
  }

  //send added avaiable time to DB
  $scope.addAvailableTime = function () {
    //build time string from Date() for beginTime
    var beginTimeText = $scope.beginTime.toTimeString();
    beginTimeText = beginTimeText.split(' ')[0];
    beginTimeText = beginTimeText.split(':');
    beginTimeText = beginTimeText[0] + ":" + beginTimeText[1];

    //build time string from Date() for endTime
    var endTimeText = $scope.endTime.toTimeString();
    endTimeText = endTimeText.split(' ')[0];
    endTimeText = endTimeText.split(':');
    endTimeText = endTimeText[0] + ":" + endTimeText[1];

    //post_data to send to server
    var post_data = {};
    post_data = {"table_name":"tb_restaurant_available", "condition": {"restaurant_ref": restaurant_id, "available_day": $scope.input.day, "available_begin": beginTimeText, "available_end": endTimeText}};

    //if the beginning time is greater than the ending one try again.
    if($scope.beginTime.getHours() > $scope.endTime.getHours()) {
        growl.warning('Check the time and try again.',{title: 'Wrong time format!'});
    } else {
      var createResult = restaurantService.insertInfo(post_data);
      createResult.then(function (result) {
        if (result == "Successfully inserted information") {
          updateAvailableList();
          $('#timeModal').modal('hide');
          growl.success('Available time has been added!',{title: 'Success!'});
        }else if(result == "Failed to insert information") {
          growl.error('Failed to insert to DB.',{title: 'Error!'});
        } else {
          growl.error('Something has gone wrong.',{title: 'Error!'});
        }
      });
    }
  }

  //delete an available time information from database
  $scope.deleteAvailabletime = function (available_id) {
    var queryObj = {};
    queryObj = {"table_name": "tb_restaurant_available", "condition": {"available_id": available_id }};
    var deleteResult = restaurantService.deleteInfo(queryObj);
    deleteResult.then(function (result) {
      if (result == "SUCCESS") {
        updateAvailableList();
      }
    });
  }


  //Restaurant Equipment
  $scope.addRestaurantEquipment = function () {
    if ($scope.input.equipment_name == "" || $scope.input.equipment_description == "" || $scope.input.equipment_name == null || $scope.input.equipment_description == null) {
        growl.warning('Input required information',{title: 'Form not filled out!'});
    } else {
      var queryObj = {};
      queryObj = {"table_name": "tb_restaurant_equipment", "condition": {"restaurant_ref": restaurant_id, "equipment_name": $scope.input.equipment_name, "equipment_description": $scope.input.equipment_description }};
      var insertResult = restaurantService.insertInfo(queryObj);
      insertResult.then(function (result) {
        if (result == "Successfully inserted information") {
          $scope.input.equipment_name = "";
          $scope.input.equipment_description = "";
          updateEquipmentList();
          $('#equipmentAddModal').modal('hide');
          growl.success('Equipment has been added!',{title: 'Success!'});
        } else if(result == "Failed to insert information") {
          growl.error('Failed to insert to DB.',{title: 'Error!'});
        } else {
          growl.error('Something has gone wrong.',{title: 'Error!'});
        }
      });
    }
  }

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

  $scope.saveEquipmentChanges = function () {
    var post_data = {};
    post_data = { "table_name": "tb_restaurant_equipment", "update_info": { "equipment_name": $scope.editEquipment.equipment_name, "equipment_description":  $scope.editEquipment.equipment_description}, "condition": {"equipment_id": $scope.editEquipmentID }};

    var updateResult = restaurantService.updateInfo(post_data);
    updateResult.then(function (result) {
      if (result == "Successfully updated information") {
        $scope.editEquipment.equipment_name = "";
        $scope.editEquipment.equipment_description = "";
        updateEquipmentList();
        $('#equipmentEditModal').modal('hide');
        growl.success('Equipment has been updated!',{title: 'Success!'});
      } else if(result == "Failed to update information") {
        growl.error('Failed to insert to DB.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    });
  }

  $scope.deleteEquipment = function() {
    var queryObj = {};
    queryObj = {"table_name": "tb_restaurant_equipment", "condition": {"equipment_id": $scope.editEquipmentID }};
    var deleteResult = restaurantService.deleteInfo(queryObj);
    deleteResult.then(function (result) {
      if (result == "SUCCESS") {
        growl.success('Equipment has been deleted!',{title: 'Success!'});
        updateEquipmentList();
      } else if (result == "FAILED") {
        growl.error('Failed to delete equipment.',{title: 'Error!'});
      } else {
        growl.error('Something has gone terribly wrong.',{title: 'Error!'});
      }
    });
  }

  //Restaurant Facility
  $scope.addRestaurantFacility = function () {
    if ($scope.input.facility_name == "" || $scope.input.facility_description == "" || $scope.input.facility_name == null || $scope.input.facility_description == null) {
        growl.warning('Input required information',{title: 'Form not filled out!'});
    } else {
      var queryObj = {};
      queryObj = {"table_name": "tb_restaurant_facility", "condition": {"restaurant_ref": restaurant_id, "facility_name": $scope.input.facility_name, "facility_description": $scope.input.facility_description }};
      var insertResult = restaurantService.insertInfo(queryObj);
      insertResult.then(function (result) {
        if (result == "Successfully inserted information") {
          $scope.input.facility_name = "";
          $scope.input.facility_description = "";
          updateFacilityList();
          $('#facilityAddModal').modal('hide');
          growl.success('Facility has been added!',{title: 'Success!'});
        } else if(result == "Failed to insert information") {
          growl.error('Failed to insert to DB.',{title: 'Error!'});
        } else {
          growl.error('Something has gone wrong.',{title: 'Error!'});
        }
      });
    }
  }

  //ID of the equipment that is currently being edited
  $scope.editFacilityID;
  $scope.editFacility;

  $scope.setFacilityEdit = function (facility_id) {
    $scope.editFacilityID = facility_id;
    var filterFacility = $scope.facilityList.filter(function( obj ) {
      return obj.facility_id == facility_id;
    })

    $scope.editFacility = filterFacility[0];
  }

  $scope.saveFacilityChanges = function () {
    var post_data = {};
    post_data = { "table_name": "tb_restaurant_facility", "update_info": { "facility_name": $scope.editFacility.facility_name, "facility_description":  $scope.editFacility.facility_description}, "condition": {"facility_id": $scope.editFacilityID }};

    var updateResult = restaurantService.updateInfo(post_data);
    updateResult.then(function (result) {
      if (result == "Successfully updated information") {
        $scope.editFacility.facility_name = "";
        $scope.editFacility.facility_description = "";
        updateEquipmentList();
        $('#equipmentEditModal').modal('hide');
        growl.success('Equipment has been updated!',{title: 'Success!'});
      } else if(result == "Failed to update information") {
        growl.error('Failed to insert to DB.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    });
  }

  $scope.deleteFacility = function() {
    var queryObj = {};
    queryObj = {"table_name": "tb_restaurant_facility", "condition": {"facility_id": $scope.editFacilityID }};
    var deleteResult = restaurantService.deleteInfo(queryObj);
    deleteResult.then(function (result) {
      if (result == "SUCCESS") {
        growl.success('Facility has been deleted!',{title: 'Success!'});
        updateEquipmentList();
      } else if (result == "FAILED") {
        growl.error('Failed to delete facility.',{title: 'Error!'});
      } else {
        growl.error('Something has gone terribly wrong.',{title: 'Error!'});
      }
    });
  }

  //Certificates Card

  $scope.restaurantCertButton = "btn-light";
  $scope.restaurantCertMessage = "Upload Restaurant Certificate";
  $scope.restaurantDownloadMessage = "No File";
  $scope.restaurantCertUploadMessage = "Upload";

  $scope.ownerCertButton = "btn-light";
  $scope.ownerCertMessage = "Upload Owner Certificate";
  $scope.ownerDownloadMessage = "No File";
  $scope.ownerCertUploadMessage = "Upload";

  //change restaurant certificate buttons to indicate file exists
  var restaurantCertGreen = function () {
    $scope.restaurantCertButton = "btn-success";
    $scope.restaurantCertMessage = "View Restaurant Certificate";
    $scope.restaurantDownloadMessage = "Download File";
    $scope.restaurantCertUploadMessage = "Change File";
  }

  //change restaurant certificate buttons to indicate file exists
  var userCertGreen = function () {
    $scope.ownerCertButton = "btn-success";
    $scope.ownerCertMessage = "View User Certificate";
    $scope.ownerDownloadMessage = "Download File";
    $scope.ownerCertUploadMessage = "Change File";
  }

  $scope.uploadFile = function (file_type) {
    if ($scope.files[file_type] == null ) {
      growl.warning('Please load a file before uploading.',{title: 'No file'});
    } else {
      //create FormData - to ajax files
      var form_data = new FormData();

      console.log($scope.files[file_type][0]);
      //append file itself
      form_data.append(file_type, $scope.files[file_type][0]);

      //append file type indicator
      form_data.append('file_type', file_type);
      form_data.append('restaurant_id', restaurant_id);

      //extract table name
      var table_name = "tb_" + (file_type).split("_")[0];
      form_data.append('table_name', table_name);

      //save file to file system and save location to database
      var uploadResult = restaurantService.uploadFile(form_data);
      uploadResult.then(function (result) {
        if (result == "Successfully uploaded file") {
          //clear file input
          $("#coFile").val("");
          restaurantCertGreen();
          growl.success('Equipment has been updated!',{title: 'Success!'});
        } else if (result == "Failed to insert file location to DB. Refresh page") {
          growl.error('Database error!',{title: 'Error!'});
        } else if (result == "Failed to upload file(s) to file system.") {
          growl.error('File system error!.',{title: 'Error!'});
        } else {
          growl.error('Something has gone terribly wrong.',{title: 'Error!'});
        }
      });
    }
  }

  //download file
  $scope.downloadFile = function (file_type) {
    if (file_type == "restaurant_cert") {
      var path = $scope.restaurant.restaurant_cert;
    } else if (file_type == "user_cert") {
      var path = $scope.user.user_cert;
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

  $scope.sendConfirmationRequest = function () {
    //flag to see if all information has been given.
    var informationCheck = true;
    if ($scope.restaurant.restaurant_cert == null || $scope.user.user_cert == null ) {
      growl.error('Required documents have not been uploaded. Please upload both restaurant certificate and user authenticaton.',{title: 'Warning!'});
      return;
    }

    for (var key in $scope.restaurant ) {
      console.log($scope.restaurant[key]);
      if ($scope.restaurant[key] == null || $scope.restaurant[key] == "" ) {
        informationCheck = false;
        break;
      }
    }

    if (informationCheck == false) {
      $('#requestContinueModal').modal('show');
    }
  }






}]);
