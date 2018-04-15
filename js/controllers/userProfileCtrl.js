angular.module('menuApp').controller('userProfileCtrl',['$scope', '$location', '$routeParams', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, authService, growl, FileSaver, Blob, $uibModal) {
  $('#profile-image-preview').click(function(){ $('#profile-image-upload').trigger('click'); });


  //show image preview
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

}]);
