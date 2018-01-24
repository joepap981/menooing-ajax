angular.module('menuApp').controller('AuthController', function ($scope, $http) {
  $scope.signUp = function(signup) {
    $http.post("insert.php",
    {
      'user_first_name': $scope.user_first_name,
      'user_last_name':$scope.user_last_name,
      'user_email':$scope.user_email,
      'user_password':$scope.user_password
    }).success(function(results) {
      if (results.status =="success") {
        $location.path('/')
      }
    });
  }
});
