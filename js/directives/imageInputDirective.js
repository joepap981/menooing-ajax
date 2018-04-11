//directive reads selected image and makes it available for use in controller
//allows user to preview the photo before upload
angular.module('menuApp').directive('imageInput', function($parse) {
  return {
    link: function($scope, element, attrs) {
      element.on("change", function(event) {
        var files = event.target.files;

        $parse(attrs.imageInput).assign($scope, element[0].files);
        $scope.$apply();


        //read file to load into image-holder div
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#image-holder').attr('src', e.target.result);
        }

        reader.readAsDataURL($scope.restaurant_image[0]);

        $scope[attrs.imageInput].file_type = attrs.imageInput;

      })
    }
  };
});
