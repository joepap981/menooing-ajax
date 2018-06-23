angular.module('menuApp',['ngRoute', 'ngAnimate', 'angular-growl', 'ui.bootstrap', 'ngFileSaver'])
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
    .when('/restaurant-new-host', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-host.php'
    })
    .when('/restaurant-new-host2', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-host2.php'
    })
    .when('/restaurant-new-host3', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-host3.php'
    })
    .when('/restaurant-new-host4', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-host4.php'
    })
    .when('/restaurant-new-success', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-success.php'
    })
    .when('/restaurant-new-guest', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-guest.php'
    })
    .when('/restaurant-new-guest2', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-guest2.php'
    })
    .when('/restaurant-new-guest3', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-new-guest3.php'
    })
    .when('/restaurant-success', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-success.php'
    })
    .when('/restaurant-profile/:restaurant_id', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-profile.php',
      controller: 'restaurantProfileCtrl'
    })
    .when('/restaurant-profile-guest', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-profile-guest.php',
    })
    .when('/restaurant-host', {
      templateUrl: 'view/user/dashboard/restaurant/restaurant-host.php'
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

    //restaurant search page
    .when('/restaurant-search', {
      templateUrl: 'view/user/restaurant-search/restaurant-search-main.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});

  }]);
