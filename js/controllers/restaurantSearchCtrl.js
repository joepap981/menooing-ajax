angular.module('menuApp').controller('restaurantSearchCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {

  $scope.userRestaurants = [];
  $scope.request_type = "ALL";
  $scope.filter = "restaurant_status";
  $scope.condition = "confirmed";

  var init = function () {
    //get all restaurants
    //var request = {"type": "USER"};

    /*test condition
    $scope.request_type = "restaurant_administrative_area_level_1";
    $scope.condition =  "TX";
    */

    var request = {"type": $scope.request_type, "condition": $scope.condition};

    var restaurantList = restaurantService.getRestaurantList(request);
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
