angular.module('menuApp').controller('AuthController', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
  $scope.signin = {};
  $scope.signup = {};
  $scope.sa_login = function(customer) {
    Data.post('signIn', {
      customer: customer
    }).then(function(results) {
      Data.toast(results) {
        if(results.status = "success") {
          $location.path('home');
        }
      }
    });
  };

  $scope.signup = {
    user_email: '',
    user_password: '';
    user_name: '';
  };

  $scope.signUp = function(customer) {
    Data.post('signUp', {
      customer: customer
    }).then(function(results) {
      Data.toast(results);
      if (results.status =="success") {
        $location.path('home')
      }
    });
  };

  $scope.logout = function() {
    Data.get('logout').then(function(results) {
      Data.toast(results);
      $location.path('signin');
    });
  }
});
