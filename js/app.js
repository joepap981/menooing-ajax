angular.module('eatersAndChefs',['ngRoute', 'ngAnimate', 'ui.bootstrap', 'ngFileSaver'])
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true);

    $routeProvider
    //Admin Page
    .when('/admin', {
      templateUrl: 'admin_index.php'
    })
  	.otherwise({
  		redirectTo: '/'
  	});
}]);
