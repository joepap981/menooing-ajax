angular.module('menuApp',['ngRoute'])
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    $locationProvider.html5Mode(true);
    $routeProvider
  	.when('/', {
  		templateUrl: 'view/user/landing-page.php'
  	})
    .when('/signup', {
<<<<<<< HEAD
  		templateUrl: 'view/user/user-signup.php',
  	})
    .when('/signin', {
  		templateUrl: 'view/user/user-signin.php',
=======
      title: 'Sign Up',
  		templateUrl: 'view/user/user-sign-up.php',
      controller: 'AuthController'
  	})
    .when('/signin', {
      title: 'Sign In',
  		templateUrl: 'view/user/user-sign-in.php',
      controller: 'AuthController'
>>>>>>> 40fc0245b2dea7a69d112970ce2875a180b91871
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
    .when('/home', {
      templateUrl: 'view/user/home.php'
    })
    .when('/signup_success', {
      templateUrl: 'view/user/signup-success.php'
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
