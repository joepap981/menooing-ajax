angular.module('menuApp',['ngRoute', 'ngAnimate', 'angular-growl', 'ui.bootstrap'])
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
    .when('/nosession', {
      templateUrl: 'view/user/dashboard/nosession.html'
    })


    //User dashboard pages
    .when('/home', {
      templateUrl: 'view/user/dashboard/index.php'
    })
    //restaurant
    .when('/restaurant-list', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-list.php'
    })
    .when('/restaurant-new', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new.php'
    })
    .when('/restaurant-new-sharer', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-sharer.php'
    })
    .when('/restaurant-new-sharer2', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-sharer2.php'
    })
    .when('/restaurant-new-sharer3', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-sharer3.php'
    })
    .when('/restaurant-new-sharer4', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-sharer4.php'
    })
    .when('/restaurant-new-success', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-success.php'
    })
    .when('/restaurant-new-sharee', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-sharee.php'
    })
    .when('/restaurant-new-sharee2', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-sharee2.php'
    })
    .when('/restaurant-success', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-success.php'
    })
    .when('/restaurant-profile', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-profile.php'
    })
    .when('/restaurant-sharer', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-sharer.php'
    })
    .when('/restaurant-menu', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-menu.php'
    })


    //sharee
    .when('/documents', {
      templateUrl: 'view/user/dashboard/documents/'
    })
    //requests
    .when('/requests', {
      templateUrl: 'view/user/dashboard/requests/'
    })
    //profile
    .when('/profile', {
      templateUrl: 'view/user/dashboard/profile/'
    })

    .when('/test-in', {
      templateUrl: 'test.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
