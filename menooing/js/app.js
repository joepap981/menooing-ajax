var myApp = angular.module('myApp', ['ngRoute']);

myApp.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    .when('/main', {
      templateUrl: 'views/main.php'
    })
    .when('/signup', {
      templateUrl: 'views/signup.php'
    }).otherwise({
      redirectTo: '/main'
    });
}]);
