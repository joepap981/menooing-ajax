/**
 *  Mene Controller will be
 */

angular.module('menuApp').controller('AuthController',['$scope', '$location', 'authService', 'growl', function ($scope, $location, authService, growl) {
  $scope.signin = {};
  $scope.signup = {};

  $scope.email_exists = false;
  $scope.passwordNoMatch = false;
  $scope.user_no_match = false;

  $scope.response = {};
  $scope.session = {};


  //check every time a page is loaded to see if session is live
  var init = function () {
    var myData = authService.checkSession();
    myData.then(function (response) {
      if(response != null){
        $scope.session = response;

        return true;
      } else {
        console.log("FAILED!!");
        return false;
      }
    });

  }
  init();

  //growl methods
  $scope.showWarning = function(){
        growl.warning('This is warning message.',{title: 'Warning!'});
    }
    $scope.showError = function(){
        growl.error('This is error message.',{title: 'Error!'});
    }
    $scope.showSuccess = function(){
        growl.success('This is success message.',{title: 'Success!'});
    }
    $scope.showInfo = function(){
        growl.info('This is an info message.',{title: 'Info!'});
    }
    $scope.showAll = function(){
        growl.warning('This is warning message.',{title: 'Warning!'});
        growl.error('This is error message.',{title: 'Error!'});
        growl.success('This is success message.',{title: 'Success!'});
        growl.info('This is an info message.',{title: 'Info!'});
    }


  //query db to check if user_email and user_password match
  //if match, begin session saving user_first_name, user_last_name, user_id
  //redirect to home
  $scope.signIn = function (signin) {
    var myData = authService.signin(signin);
    myData.then(function (result) {

      if(result == "Login Verified") {
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

  //sign up and record user info to db
  $scope.signUp = function () {
    if($scope.checkPassword()) {
      authService.signup($scope.signup).then(function(response) {
        //successfully wrote into DB
        if (response == 'Available') {
          $scope.email_exists = false;

          //auto logs in with current info and redirect to home
          var signinData = {};
          signinData['user_email'] = $scope.signup['user_email'];
          signinData['user_password'] = $scope.signup['user_password'];

          $scope.signIn(signinData);

        }
        //failed to write into DB
        else if (response == 'Unavailable'){
          $scope.email_exists = true;
        }
        else if (response == "DBError") {
          growl.error('Something went wrong inserting data to DB.', {title: "DB Error!"});
        }
        else {
          growl.error('Something went terribly wrong. Contact the admin.', {title: "DB Error!"});
        }
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


  //logout of user account and end session
  $scope.logout = function () {
    authService.endSession().then(function(response) {
      $scope.session = response;
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
      return true;
    } else {
      return false;
    }
  }

  //debugging console printer
  $scope.myCon = function (msgStr) {
    //console.log(msgStr);
  }

}]);
