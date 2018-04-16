angular.module('menuApp').controller('userProfileCtrl',['$scope', '$location', '$routeParams', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, authService, growl, FileSaver, Blob, $uibModal) {
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
        console.log($scope.user);
      });
    });
  }

  init();
  //when click on the profile image preview, a file upload window pops up
  $('#profile-image-preview').click(function(){ $('#profile-image-upload').trigger('click'); });


  //show image preview
  //once user chooses photo, a preview is shown
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#profile-image-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
  }

  $("#profile-image-upload").change(function() {
    readURL(this);
  });


  //when click the "Save Changes" button, uploads currently chosen photo
  $scope.uploadFile = function () {
    if ($scope.files.restaurant_cert == null) {
      console.log($scope.files.restaurant_cert[0]);
      growl.warning('Select a file to upload.',{title: 'Error!'});
    } else {
      //create form_data for ajax post
      var form_data = new FormData();
      form_data.append($scope.files.restaurant_cert.file_type, $scope.files.restaurant_cert[0]);
      //append file type indicator
      form_data.append('file_type', $scope.files.restaurant_cert.file_type);
      //append database table name
      form_data.append('table_name', 'tb_restaurant');
      form_data.append('restaurant_id', restaurant_id);

      //does not erase original file, just add new file and new path to db
      restaurantService.uploadFile(form_data).then(function (response) {
        if (response == "SUCCESSFULLY UPLOADED") {
          $scope.files.restaurant_cert[0] = null;
          $('#collapseCert').collapse('hide');
          $('#coFile').val('');
          init();
          growl.success(response, {title: 'Success'});
        } else {
          growl.error(response,{title: 'Error!'});
        }

      });
    }
  }

}]);
