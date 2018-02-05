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
    .when('/sharekitchen', {
      templateUrl: 'view/user/share-kitchen.php'
    })

    //User dashboard pages
    .when('/home', {
      templateUrl: 'view/user/dashboard/index.php'
    })
    .when('/dashboard', {
      templateUrl: 'view/user/dashboard/dashboard.php'
    })
    .when('/restaurant', {
      templateUrl: 'view/user/dashboard/restaurant.php'
    })
    .when('/sharee', {
      templateUrl: 'view/user/dashboard/sharee.php'
    })
    .when('/requests', {
      templateUrl: 'view/user/dashboard/requests.php'
    })
    .when('/profile', {
      templateUrl: 'view/user/dashboard/profile.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
