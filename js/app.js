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
      title: 'Sign Up',
  		templateUrl: 'view/user/user-sign-up.php',
      controller: 'AuthController'
  	})
    .when('/signin', {
      title: 'Sign In',
  		templateUrl: 'view/user/user-sign-in.php',
      controller: 'AuthController'
  	})
    .when('/forgot-password', {
      templateUrl: 'view/user/forgot-password.php',
      controller: 'AuthController'
    })
    .when('/home', {
      title: 'User Home',
      templateUrl: 'view/user/user-home.php'
    })
    .when('/admin', {
      templateUrl: 'admin_index.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});
  }])
  .run(function($rootScope, $location, Data) {
    $rootScope.$on("$routeChangeStart", function(event, next, current) {
      $rootScope.authenticated = false;
      Data.get('session').then(function(results) {
        if (results.user_id) {
          $rootScope.authenticated = true;
          $rootScope.user_id = results.user_id;
          $rootScope.user_first_name = results.user_first_name;
          $rootScope.user_last_name = results.user_last_name;
          $rootScope.user_email = result.user_email;
        } else {
          var nextUrl = next.$$route.originalPath;
          if (nextUrl == '/signup' || nextUrl == '/signin') {

          } else {
            $location.path('/signin');
          }
        }
      });
    });
  });
