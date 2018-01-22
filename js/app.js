angular.module('menuApp',['ngRoute'])
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    $locationProvider.html5Mode(true);
    $routeProvider
  	.when('/', {
  		templateUrl: 'view/user/landing-page.php'
  	})
  	.when('/admin', {
  		templateUrl: 'admin_main.php'
  	})
    .when('/signup', {
  		templateUrl: 'view/user/user-sign-up.php'
  	})
    .when('/signin', {
  		templateUrl: 'view/user/user-sign-in.php'
  	})
    .when('/forgot-password', {
      templateUrl: 'view/user/forgot-password.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
