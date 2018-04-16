angular.module('menuApp').controller('userProfileCtrl',['$scope', '$location', '$routeParams', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, authService, growl, FileSaver, Blob, $uibModal) {
  //when click on the profile image preview, a file upload window pops up
  $('#profileImagePreview').click(function(){ $('#profileImageUpload').trigger('click'); });
  $scope.user = {};
  $scope.input = {};
  $scope.files = {};

  var init = function () {
    authService.checkSession().then(function (response) {
      var queryObject = {};
      queryObject.table = 'tb_user_info';
      queryObject.key = {'user_ref': response.user_id};

      authService.getInformation(queryObject).then(function (queryResponse) {
        $scope.user = queryResponse[0];
        $scope.user.first_name = response.user_first_name;
        $scope.user.last_name = response.user_last_name;
        $scope.user.user_id = response.user_id;

        //check for profileImage
        if ($scope.user.user_img != null) {
          $scope.user.img_ref = $scope.user.user_img;
        } else {
          $scope.user.img_ref = '/noexec/square.jpg';
        }

        //get file names
        //if usercert exists, slice out path information
        if($scope.user.user_cert != null) {
          $scope.user.cert_name = $scope.user.user_cert.split('/').pop();
        }

        if($scope.user.user_ssn != null) {
          $scope.user.ssn_name = $scope.user.user_ssn.split('/').pop();
        }
      });
    });
  }

  init();


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
        if (response == "SUCCESSFULLY UPLOADED") {
          $scope.files[file_type] = null;

          //clear file input forms
          if (file_type == 'user_ssn') {
            $('#collapseSSN').collapse('hide');
            $('#ssnFileInput').val('');
          } else if (file_type == 'user_cert'){
            $('#collapseFoodManCert').collapse('hide');
            $('#foodCertFileInput').val('');
          } else if (file_type == 'user_id_img') {

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

}]);
