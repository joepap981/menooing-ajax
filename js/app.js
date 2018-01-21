var myApp = angular.module('myApp', ['ngRoute']);

myApp.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
	
	$locationProvider.html5Mode(true);

	$routeProvider
	.when('/main', {
		templateUrl: 'views/main.php'
	})
	.when('/signup', {
		templateUrl: 'views/signup.php'
	})
	.when('/signin', {
		templateUrl: 'views/signin.php'
	})
	.otherwise({
		redirectTo: '/main'
	});
}]);
