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

  //query db to check if user_email and user_password match
  //if match, begin session saving user_first_name, user_last_name, user_id
  //redirect to home
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
          $location.path('/home');
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


  //logout of the current session
  $scope.logout = function () {
    Session.endSession().then(function(response) {
      $rootScope.session = null;
      $location.path('/');
    })
  }

  //redirect page to input url
  $scope.redirect = function (url) {
    $location.path(url);
  }

  //check if url matches with current url passwordNoMatch
  //return true if match
  $scope.isURL = function (url) {
    if ($location.path() == url ){
      console.log($location.path());
      return true;
    } else {
      return false;
    }
  }

  $scope.homeIfNoSession = function() {
    $http({method : "POST", url: 'action/session/'})
    .then(function mySuccess(response) {
      console.log(response.data);
        if($scope.session["user_id"] == null) {
          $location.path('/');
        }
      }, function myError(response) {
    });
  }

  //debugging console printer
  $scope.myCon = function (msgStr) {
    //console.log(msgStr);
  }

}]);
