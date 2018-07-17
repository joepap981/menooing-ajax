angular.module('menuApp').controller('AdminController',['$scope', '$http','$route', '$location', 'growl', 'authService', function ($scope, $http, $route, $location, growl, authService) {
  $scope.pageNum = 1;

  $scope.redirect = function (url) {
      $location.path(url);
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
    var myData = authService.signin($scope.signin);
    myData.then(function (result) {
      if(result== "Login Verified") {
        $scope.user_no_match = false;
        $scope.signin = {};

        //check for session
        myData = authService.checkSession();
        myData.then(function (result) {
          if (result["user_id"] != null) {
            $scope.session = result;
            if ($scope.session['user_id'] != 1) {
              $scope.sessionLive = false;
              growl.error('Wrong user',{title: 'Failed'});
            } else {
              $scope.sessionLive = true;
              growl.success('Signed in!',{title: 'Success'});
            }

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
      //remove modal backdrop
      $('#logoutModal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();

      //set session to null
      $scope.session = response;

      //set session indicator to false
      $scope.sessionLive = false;
    })
  }




}]);
