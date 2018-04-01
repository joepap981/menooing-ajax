angular.module('menuApp').controller('restaurantCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {

  $scope.userRestaurants = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurantList = restaurantService.getRestaurantList();
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
