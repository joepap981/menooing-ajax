angular.module('menuApp').controller('restaurantCtrl',['$scope', '$location', 'restaurantService', 'authService', 'growl', '$window', function ($scope, $location, restaurantService, authService, growl, $window) {

  $scope.userRestaurants = [];

  var init = function () {
    //get all restaurants from user in current session (check in server)
    var request_type = {"type": "USER"};
    var restaurantList = restaurantService.getRestaurantList(request_type);
    restaurantList.then(function (result) {
      $scope.userRestaurants = result;
    });

  }
  //run initialization method
  init();

  $scope.redirectToProfile = function (restaurant_id) {
    $location.path('/restaurant-profile/'+restaurant_id);
  };


}]);
