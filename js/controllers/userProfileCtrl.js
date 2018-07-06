angular.module('menuApp').controller('userProfileCtrl',['$scope', '$location', '$routeParams', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, authService, growl, FileSaver, Blob, $uibModal) {
  //when click on the profile image preview, a file upload window pops up
  $('#profileImagePreview').click(function(){ $('#profileImageUpload').trigger('click'); });
  $scope.user = {};
  $scope.input = {};
  $scope.files = {};

  $scope.sessionResponse;

  var init = function () {
    authService.checkSession().then(function (response) {
      $scope.sessionResponse = response;
      updateUser();
    });
  }

  init();

  var updateUser = function () {
    var post_data = {};
    post_data.table_name = 'tb_user_info';
    post_data.condition = {'user_ref': $scope.sessionResponse.user_id};

    authService.getInfo(post_data).then(function (result) {
      $scope.user = result[0];
      $scope.user.first_name = $scope.sessionResponse.user_first_name;
      $scope.user.last_name = $scope.sessionResponse.user_last_name;
      $scope.user.user_id = $scope.sessionResponse.user_id;

      //check for profileImage
      if ($scope.user.user_img != null) {
        $scope.user.img_ref = $scope.user.user_img;
      } else {
        $scope.user.img_ref = '/noexec/square.jpg';
      }
    });
  }


  //show image preview
  //once user chooses photo, a preview is shown
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#profileImagePreview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
  }

  $("#profileImageUpload").change(function() {
    readURL(this);
  });


  //when click the "Save Changes" button, uploads currently chosen photo
  $scope.uploadFile = function (file_type) {
    if ($scope.files[file_type]== null) {
      growl.warning('Select a file to upload.',{title: 'Error!'});
    } else {
      //create form_data for ajax post
      var form_data = new FormData();
      var upload_file = $scope.files[file_type];
      form_data.append(upload_file.file_type, upload_file[0]);
      //append file type indicator
      form_data.append('file_type', file_type);
      //append database table name
      form_data.append('table_name', 'tb_user_info');
      //set restaurant_id as null
      form_data.append('restaurant_id', null);

      //does not erase original file, just add new file and new path to db
      authService.uploadFile(form_data).then(function (response) {
        if (response == "Successfully uploaded file") {
          $scope.files[file_type] = null;

          //clear file input forms
          if (file_type == 'user_ssn') {
            $('#collapseSSN').collapse('hide');
            $('#ssnFileInput').val('');
          } else if (file_type == 'user_cert'){
            $('#collapseFoodManCert').collapse('hide');
            $('#foodCertFileInput').val('');
          } else if (file_type == 'user_img') {
            $('#previewImageUpload').val('');
          }
          else {
            growl.error('Successfully uploaded but clearing process went wrong.', {title: 'Error'})
          }

          init();
          growl.success(response, {title: 'Success'});
        } else {
          growl.error(response,{title: 'Error!'});
        }

      });
    }
  }

  //file download
  $scope.downloadFile = function (file_type) {
    var downloadInfo = {
      'user_id': $scope.user.user_id,
      'path': $scope.user[file_type],
    }

    authService.downloadFile(downloadInfo);
  }

  $scope.saveChanges = function () {

    var ajaxObj= {};
    ajaxObj['update_info'] = {
      'phone': $scope.user.user_phone,
    };
    ajaxObj['condition'] = {'user_ref': $scope.user.user_id};
    ajaxObj['table'] = 'tb_user_info';

    authService.updateInformation(ajaxObj).then(function(response) {
      if (response == "SUCCESS") {

        ajaxObj['update_info'] = {
          'first_name': $scope.user.first_name,
          'last_name': $scope.user.last_name,
        };
        ajaxObj['condition'] = {'user_id': $scope.user.user_id};
        ajaxObj['table'] = 'tb_user';

        authService.updateInformation(ajaxObj).then(function(response) {
          if (response == "SUCCESS") {
              growl.success('Successfully updated user information.',{title: 'Success!'});

              //update page change
              init();
          }else {
              growl.error('Failed to update user first_name and last_name.',{title: 'Error!'});
          }
        });
      }else {
          growl.error('Failed to update user phone number.',{title: 'Error!'});
      }
    });
  }

  $scope.verifyVerificationRequest = function () {
    //flag to see if all information has been given.
    var informationCheck = true;
    if (($scope.user.user_cert == null || $scope.user.user_cert == "") || ( $scope.user.user_ssn == null | $scope.user.user_ssn =="")) {
      growl.error('Required documents have not been uploaded. Please upload certificate of occupancy.',{title: 'Warning!'});
      return;
    }

    for (var key in $scope.user ) {
      if ($scope.user[key] == null || $scope.user[key] == "" ) {
        informationCheck = false;
        break;
      }
    }

    if (informationCheck == false) {
      $('#requestContinueModal').modal('show');
    } else {
      $scope.confirmVerifcationRequest();
    }
  }

  //finalize confirm request
  $scope.confirmVerifcationRequest = function () {
    var post_data = {};
    post_data = {
      "table_name": "tb_request",
      "condition": {
        'request_type': 'user_verification'
      }
    };

    //save file to file system and save location to database
    var requestResult = authService.insertInfo(post_data);
    requestResult.then(function (result) {
      if (result == "Successfully inserted information") {

        var post_data = {};
        post_data['table_name'] = 'tb_user_info';
        post_data['update_info'] = {'user_status': 'PENDING'};
        post_data['condition'] = {'user_ref':   $scope.user.user_id };

        //update restaurant from confirmed to pending
        var statusUpdateResult = authService.updateInfo(post_data);
        statusUpdateResult.then(function(result) {
          if (result == 'Successfully updated information') {
            updateUser();
            growl.success('Request Sent!',{title: 'Success!'});
          } else if ( result == 'Failed to update information') {
            growl.error('Failed to update restaurant status.',{title: 'Error!'});
          } else {
            growl.error('Something has gone terribly wrong while updating restaurant status.',{title: 'Error!'});
          }
        });

      } else if (result == "Failed to insert information") {
        growl.error('Failed to send request!',{title: 'Error!'});
      } else {
        growl.error('Something has gone terribly wrong while sending the request.',{title: 'Error!'});
      }
    });
  }

}]);
