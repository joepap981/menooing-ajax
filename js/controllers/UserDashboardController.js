angular.module('menuApp').controller('UserDashboardController',['$scope', 'accessDB', 'growl', function ($scope, accessDB, growl) {

  $scope.userRestaurants = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurantList = accessDB.getRestaurantInfo();
    restaurantList.then (function (result) {
      $scope.userRestaurants = result;
    });
  }

  //run initialization method
  init();

  //navigate tabs
  $scope.page = 'dashboard';
  $scope.selectPage = function (pageNum) {
    $scope.page = pageNum;
  }

  //Restaurant registration
  $scope.restaurant = {};
  //submit input form information to DB
  $scope.registerRestaurant = function () {
    if ($scope.restaurantRegistration.$valid) {
      accessDB.insertRestaurantInfo(this.restaurant).then(function(response) {
        if (response == true) {
          growl.success("Your restaurant has been registered!", {title: 'Success!'});
          $scope.page = 'restaurant-new2';

          //reset forms
          $scope.restaurant = {};
          $scope.restaurantRegistration.submitted = false;

          return true;
        } else {
          growl.error("Something went wrong!", {title: 'Failed to Register!'});
          return false;
        }
      });
    } else {
      $scope.restaurantRegistration.submitted = true;
    }
  }
}]);
