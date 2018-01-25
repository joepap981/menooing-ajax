angular.module('menuApp',['ngRoute'])
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    $locationProvider.html5Mode(true);
    $routeProvider
  	.when('/', {
  		templateUrl: 'view/user/landing-page.php'
  	})
    .when('/signup', {
  		templateUrl: 'view/user/user-signup.php',
  	})
    .when('/signin', {
  		templateUrl: 'view/user/user-signin.php',
  	})
    .when('/forgot-password', {
      templateUrl: 'view/user/forgot-password.php'
    })
    .when('/admin', {
      templateUrl: 'admin_index.php'
    })
    .when('/home', {
      templateUrl: 'view/user/home.php'
    })
    .when('/signup_success', {
      templateUrl: 'view/user/signup-success.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
