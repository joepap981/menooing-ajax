//URL mapping and routes
angular.module('myApp', ['ngRoute']).config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

	$locationProvider.html5Mode(true);

	$routeProvider
	.when('/', {
		templateUrl: 'views/user/landing_page.php'
	})
	.when('/admin', {
		templateUrl: 'admin_main.php'
	})
	.otherwise({
		redirectTo: '/'
	});
}]);
