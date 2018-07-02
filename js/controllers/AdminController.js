angular.module('menuApp').controller('AdminController',['$scope', '$http','$route', 'authService', function ($scope, $http, $route, authService) {
  $scope.pageNum = 1;

  $scope.changePage = function (num) {
      $scope.pageNum = num;
  }

  $scope.signin = {};

  $scope.email_exists = false;
  $scope.passwordNoMatch = false;
  $scope.user_no_match = false;

  $scope.response = {};
  $scope.session = {};

  $scope.sessionLive = false;


  //check every time a page is loaded to see if session is live
  var init = function () {
    var myData = authService.checkSession();
    myData.then(function (response) {
      if(response != null){
        $scope.session = response;
        if ($scope.session['user_id'] != 1) {
          $scope.sessionLive = false;
        } else {
          $scope.sessionLive = true;
        }
      } else {
        $scope.sessionLive = false;
      }
    });
  }
  init();

  //query db to check if user_email and user_password match
  //if match, begin session saving user_first_name, user_last_name, user_id
  //redirect to home
  $scope.signIn = function () {
    var myData = authService.get($scope.signin);
    myData.then(function (result) {
      if(result== "Login Verified") {
        $scope.user_no_match = false;
        $scope.signin = {};

        //check for session
        myData = authService.checkSession();
        myData.then(function (result) {
          if (result["user_id"] != null) {
            $scope.session = result;
            growl.success('Signed in!',{title: 'Success'});
            $location.path('/home');
          } else {
            $scope.session = {};
            growl.error('There is no session...', {title: "Error!"});
            $location.path('/');
          }
        });
      } else {
        $scope.user_no_match = true;
      }
    });
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


  //logout of user account and end session
  $scope.logout = function () {
    authService.endSession().then(function(response) {
      $scope.session = response;
      $location.path('/');
    })
  }


}]);
