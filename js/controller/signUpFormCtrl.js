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

      formService.uploadFile(form_data);
    });
  }


}]);
