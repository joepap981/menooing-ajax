/**
 *  Mene Controller will be
 */


angular.module('menuApp').controller('MainController',['$scope', '$http', '$location', function ($scope, $http, $location) {
  $scope.signin = {};
  $scope.signup = {};
  $scope.email_exists = false;

  $scope.sa_login = function () {
    console.log($scope.signin);
    $http({
      method : "POST", url: 'action/signin/', data: $scope.signin
      }).then(function mySuccess(response) {
        console.log(response);
      }, function myError(response) {
    });
  };

  //sign up and record user info to db
  $scope.signUp = function () {
    $http({
      method : "POST", url: 'action/signup/', data: $scope.signup
      }).then(function mySuccess(response) {
        //check if email already exists and if it does,
        if (response.data == "Unavailable") {
          $scope.email_exists = true;
          console.log($scope.email_exists);
        } else {
          $scope.email_exists = false;
          $location.path('signup_success');
        }
      }, function myError(response) {
    });
  };


}]);
