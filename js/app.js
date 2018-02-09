angular.module('menuApp',['ngRoute', 'ngAnimate', 'angular-growl'])
    .config(['$routeProvider', '$locationProvider','growlProvider', function ($routeProvider, $locationProvider, growlProvider) {
    growlProvider.globalTimeToLive(4000);
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
  		templateUrl: 'view/user/navigation/landing-page.php'
  	})
    .when('/sharekitchen', {
      templateUrl: 'view/user/navigation/share-kitchen.php'
    })
    .when('/signup', {
  		templateUrl: 'view/user/authentication/user-signup.php',
  	})
    .when('/signin', {
  		templateUrl: 'view/user/authentication/user-signin.php',
  	})
    .when('/forgot-password', {
      templateUrl: 'view/user/authentication/forgot-password.php'
    })


    //User dashboard pages
    .when('/home', {
      templateUrl: 'view/user/dashboard/'
    })

    //restaurant
    .when('/restaurant', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-list.php'
    })
    .when('/restaurant-new', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new.php'
    })
    .when('/restaurant-success', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-success.php'
    })
    .when('/restaurant-profile', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-profile.php'
    })

    //sharee
    .when('/sharee', {
      templateUrl: 'view/user/dashboard/sharee/'
    })

    //requests
    .when('/requests', {
      templateUrl: 'view/user/dashboard/requests/'
    })

    //profile
    .when('/profile', {
      templateUrl: 'view/user/dashboard/profile/'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
