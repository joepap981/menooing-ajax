angular.module('menuApp').controller('searchCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {

  $scope.restaurants = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurantList = restaurantService.getRestaurantList();
    restaurantList.then(function (result) {
      $scope.restaurants = result;
    });
  }
  //run initialization method
  init();

  $scope.redirectToProfile = function (restaurant_id) {
    $location.path('/restaurant-profile/'+restaurant_id);
  };


}]);
