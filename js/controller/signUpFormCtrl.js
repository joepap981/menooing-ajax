angular.module('eatersAndChefs').controller('signUpFormCtrl',['$scope','$http','$route', '$location', 'formService', function ($scope, $http, $route, $location, formService) {
  $scope.form = {};
  $scope.files = {};

  $scope.saveFile = function(form_id) {
    angular.forEach($scope.files, function (file) {
      var form_data = new FormData();
      //append file itself
      form_data.append(file.file_type, file[0]);
      //append file type indicator
      form_data.append('file_type', file.file_type);
      form_data.append('form_id', form_id);

      var table_name = "tb_form";
      form_data.append('table_name', table_name);

      formService.uploadFile(form_data);
      return true;
    });
  }

  $scope.uploadForm = function () {
    var packet = {};
    packet.type = "form";
    packet.content = $scope.form;
    formService.post(packet).then(function(response) {
      if (!isNaN(response)) {
        //upload to filestorage and save path to database
        $scope.saveFile(response);

        $scope.files = {};
        $('#formSuccessModal').modal('show');


      } else {

      }
      $scope.form = {};
    });
  }
}]);
