angular.module('eatersAndChefs').controller('adminFormCtrl',['$scope','$http','$route', 'adminService', function ($scope, $http, $route, adminService) {
  $scope.Forms = [];

  var init = function () {
    //get all restaurants from user in current session (check in server)
    var table_name = "tb_form";
    var formList = adminService.getList(table_name);
    formList.then (function (result) {
      $scope.Forms = result;
    });
  }

  init();

  $('#formModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    $scope.selectedForm = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


    //get restaurant information from database
    //

    //console.log($scope.selectedRequest);
    var modal = $(this);
    modal.find('.modal-title').text("Message from " + $scope.selectedForm.form_email);
    modal.find('p#category').text($scope.selectedForm.form_category);
    modal.find('p#cuisine').text($scope.selectedForm.form_cuisine);
    $("#id").attr("href",$scope.selectedForm.id_image);
    $("#certificate").attr("href",$scope.selectedForm.food_handler_cert);
  })
}]);
