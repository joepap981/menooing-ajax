/**
 *  Mene Controller will be
 */

angular.module('menuApp').controller('AuthController',['$scope', '$location', 'accessDB', function ($scope, $location, accessDB) {
  $scope.signin = {};
  $scope.signup = {};

  $scope.email_exists = false;
  $scope.passwordNoMatch = false;
  $scope.user_no_match = false;

  $scope.response = {};
  $scope.session = {};

  //check every time a page is loaded to see if session is live
  var init = function () {
    var myData = accessDB.checkSession();
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


  //query db to check if user_email and user_password match
  //if match, begin session saving user_first_name, user_last_name, user_id
  //redirect to home
  $scope.signIn = function (signin) {
    var myData = accessDB.get(signin);
    myData.then(function (result) {
      $scope.response = result;

      if($scope.response["result"] == "Success") {
        console.log("signin");
        $scope.user_no_match = false;
        $scope.signin = {};

        //check for session
        myData = accessDB.checkSession();
        myData.then(function (result) {
          if (result["user_id"] != null) {
            $scope.session = result;
            $location.path('/home');
          } else {
            $scope.session = {};
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
      accessDB.set($scope.signup).then(function(response) {
        console.log("signup");
        //successfully wrote into DB
        if (response == true) {
          console.log("signup success");
          $scope.email_exists = false;

          //auto logs in with current info and redirect to home
          var signinData = {};
          signinData['user_email'] = $scope.signup['user_email'];
          signinData['user_password'] = $scope.signup['user_password'];

          $scope.signIn(signinData);


        }
        //failed to write into DB
        else {
          $scope.email_exists = true;
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
    accessDB.endSession().then(function(response) {
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
      console.log($location.path());
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
