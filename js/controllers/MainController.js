/**
 *  Mene Controller will be
 */


angular.module('menuApp').controller('MainController', function ($scope, $http) {
  $scope.signin = {};
  $scope.signup = {};
  $scope.user_exists = 0;

  $scope.sa_login = function () {
    console.log($scope.signin);
    $http({
      method : "POST", url: 'action/signin/', data: $scope.signin
      }).then(function mySuccess(response) {
        console.log(response);
      }, function myError(response) {
    });
  };
  $scope.signUp = function () {
    $http({
      method : "POST", url: 'action/signup/', data: $scope.signup
      }).then(function mySuccess(response) {
          $scope.user_exists = response;
      }, function myError(response) {
    });
  };

  $scope.checkUserExist = function () {
    if ($scope.user_exists == -1)
      return true;
   else
      return false;
  }
});
