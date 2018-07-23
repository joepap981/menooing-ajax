angular.module('menuApp').controller('restaurantCtrl',['$scope', '$location', 'restaurantService', 'authService', 'growl', '$window', function ($scope, $location, restaurantService, authService, growl, $window) {

  $scope.userRestaurants = [];
  $scope.sessionUser;

  var init = function () {
    //extract url info if exists
    var url = $location.path().split('/');
    id = url.pop();

    var sessionCheck = authService.checkSession();
    sessionCheck.then(function(result){
      if (result != null) {
        $scope.sessionUser = result;
        getUserRestaurants();
      } else if (result == null) {
        $location.path("/nosession");
      }else {
        console.log(result);
      }

    });
  }

  var getUserRestaurants = function () {
    var post_data = {
      "table_name": "tb_restaurant",
      "condition": {
        "user_ref": $scope.sessionUser.user_id,
      }
    }

    var getRestaurantList = authService.getInfo(post_data);
    getRestaurantList.then(function(result) {
      if(result != null) {
        $scope.userRestaurants = result;
      } else {
        console.log(result);
      }
    })
  }

  $scope.redirectToProfile = function (restaurant_id) {
    $location.path('/restaurant-profile/'+restaurant_id);
  };

  $scope.redirect = function (url) {
    $location.path(url);
  };

  $scope.redirectToGuestProfile = function (url) {
    $location.path(url +'/' + id);
  };

  //run initialization method
  init();

}]);
