angular.module('eatersAndChefs',['ngRoute', 'ngAnimate', 'ui.bootstrap', 'ngFileSaver'])
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true);

    $routeProvider
    .when('/', {
      templateUrl: 'views/user/landingPage.html'
    })
    //Admin Page
    .when('/admin', {
      templateUrl: 'admin_index.php'
    })
    .when('/request-station', {
      templateUrl: 'views/user/signUpForm.html'
    })
  	.otherwise({
  		redirectTo: '/'
  	});
}]);
