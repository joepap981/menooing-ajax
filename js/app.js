angular.module('menuApp',['ngRoute'])
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    $locationProvider.html5Mode(true);

    $routeProvider
    //Admin Page
    .when('/admin', {
      templateUrl: 'admin_index.php'
    })
    .when('/sample', {
      templateUrl: 'view/admin/sample.php'
    })
    //Userside
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
    .when('/home', {
      templateUrl: 'view/user/home.php'
    })
    .when('/sharekitchen', {
      templateUrl: 'view/user/share-kitchen.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
