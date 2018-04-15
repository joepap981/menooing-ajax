angular.module('menuApp').controller('userProfileCtrl',['$scope', '$location', '$routeParams', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, authService, growl, FileSaver, Blob, $uibModal) {
  $('#profile-image-preview').click(function(){ $('#profile-image-upload').trigger('click'); });

}]);
