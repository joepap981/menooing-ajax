angular.module('menuApp').directive('fileInput', function($parse) {
  return {
    link: function($scope, element, attrs) {
      element.on("change", function(event) {
        var files = event.target.files;

        $parse(attrs.fileInput).assign($scope, element[0].files);
        $scope.$apply();

        $scope[attrs.fileInput].file_type = attrs.fileInput;

        $scope.files[attrs.fileInput] = $scope[attrs.fileInput];

        console.log($scope.files[attrs.fileInput]);

      })
    }
  };
});
