//directive reads selected file and makes it available for use in controller
angular.module('menuApp').directive('fileInput', function($parse) {
  return {
    link: function($scope, element, attrs) {
      element.on("change", function(event) {
        var files = event.target.files;

        $parse(attrs.fileInput).assign($scope, element[0].files);
        $scope.$apply();

        $scope[attrs.fileInput].file_type = attrs.fileInput;

        //ex. $scope.files.restaurant_cert
        $scope.files[attrs.fileInput] = $scope[attrs.fileInput];


      })
    }
  };
});
