var myApp = angular.module('myApp', ['ngRoute']);

//URL mapping and routes
myApp.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

	$locationProvider.html5Mode(true);

	$routeProvider
	.when('/main', {
		templateUrl: 'views/user/landing_page.php'
	})
	.when('/signup', {
		templateUrl: 'views/user/user_signup.php'
	})
	.when('/signin', {
		templateUrl: 'views/user/user_signin.php'
	})
	.when('/admin', {
		templateUrl: 'admin.php'
	})
	.otherwise({
		redirectTo: '/main'
	});
}]);
