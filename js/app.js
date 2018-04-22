angular.module('eatersAndChefs',['ngRoute', 'ngAnimate', 'angular-growl', 'ui.bootstrap', 'ngFileSaver'])
    .config(['$routeProvider', '$locationProvider','growlProvider', function ($routeProvider, $locationProvider, growlProvider) {
    growlProvider.globalTimeToLive(4000);
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
