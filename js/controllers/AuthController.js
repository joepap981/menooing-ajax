/**
 *  Mene Controller will be
 */


angular.module('menuApp').controller('AuthController',['$rootScope', '$scope', '$http', '$location', 'Session', function ($rootScope, $scope, $http, $location, Session) {
  $scope.signin = {};
  $scope.signup = {};

  $scope.email_exists = false;
  $scope.passwordNoMatch = false;
  $scope.user_no_match = false;

  $rootScope.session = {};

  $scope.signIn = function () {
    $http({method : "POST", url: 'action/signin/', data: $scope.signin})
    .then(function mySuccess(response) {
        if(response.data["result"] == "Success") {
          $scope.user_no_match = false;
          $scope.signin = {};

          $rootScope.session = response.data;
          $location.path('/home');

        } else {
          $scope.user_no_match = true;
        }
      }, function myError(response) {
    });
  };

  //sign up and record user info to db
  $scope.signUp = function () {

    if($scope.checkPassword()) {
    $http({ method : "POST", url: 'action/signup/', data: $scope.signup})
    .then(function mySuccess(response) {
        //check if email already exists and if it does,
        if (response.data == "Unavailable") {
          $scope.email_exists = true;
        } else {
          $scope.email_exists = false;
          $scope.signup = {};
          $location.path('signup_success');
        }}, function myError(response) {
      });
    }
  };

  //check if the confPassword matches the input user password
  $scope.checkPassword = function () {
    if ($scope.signup["user_password"] != $scope.signup["confPassword"]) {
      $scope.passwordNoMatch = true;
      $scope.myCon("password:false");
      return false;
    } else {
      $scope.passwordNoMatch = false;
      $scope.myCon("password:true");
      return true;
    }
  };

  

  $scope.logout = function () {
    Session.endSession().then(function(response) {
      $rootScope.session = null;
    })
  }


  //debugging console printer
  $scope.myCon = function (msgStr) {
    //console.log(msgStr);
  }

}]);
