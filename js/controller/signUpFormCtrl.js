angular.module('eatersAndChefs').controller('signUpFormCtrl',['$scope','$http','$route','formService', function ($scope, $http, $route, formService) {
  $scope.form = {};
  $scope.files = {};

  $scope.saveFile = function() {
    angular.forEach($scope.files, function (file) {
      var form_data = new FormData();
      //append file itself
      form_data.append(file.file_type, file[0]);
      //append file type indicator
      form_data.append('file_type', file.file_type);

      var table_name = "tb_form";
      form_data.append('table_name', table_name);
      form_data.append('form_content', $scope.form);

      formService.uploadFile(form_data);
      return true;
    });
  }

  $scope.uploadForm = function () {
    var packet = {};
    packet.type = "form";
    packet.content = $scope.form;
    formService.post(packet).then(function(response) {
      if (response == "POST SUCCESS") {
        //upload to filestorage and save path to database
        $scope.saveFile();

        $scope.files = {};
        $('#formSuccessModal').modal('show');
        $location.path('/');

      } else {

      }
      $scope.form = {};
    });
  }
}]);
