angular.module('menuApp').directive('fileInput', function() {
  return {
    link: function($scope, element, attrs) {
      element.on("change", function(event) {
        var files = event.target.files;
        console.log(files[0].name);
      })
    }
  };
});
