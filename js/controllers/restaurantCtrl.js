angular.module('menuApp').controller('restaurantCtrl',['$scope', '$location', 'restaurantService', 'authService', 'growl', '$window', function ($scope, $location, restaurantService, authService, growl, $window) {

  $scope.userRestaurants = [];
  var init = function () {
    authService.checkSession().then(function(response) {
      //get all restaurants from user in current session (check in server)
      var session_user_id = response.user_idz;
      var restaurantList = restaurantService.getRestaurantList(session_user_id);
      restaurantList.then(function (result) {
        $scope.userRestaurants = result;
      });
    });


  }
  //run initialization method
  init();

  $scope.redirectToProfile = function (restaurant_id) {
    $location.path('/restaurant-profile/'+restaurant_id);
  };


}]);
