angular.module('menuApp').controller('restaurantCtrl',['$scope', '$location', 'accessDB', 'growl', function ($scope, $location, accessDB, growl, $uibModal) {

  $scope.userRestaurants = [];
  var init = function () {
    //get all restaurants from user in current session (check in server)
    var restaurantList = accessDB.getRestaurantList();
    restaurantList.then (function (result) {
      $scope.userRestaurants = result;
    });
  }
  //run initialization method
  init();

  //Restaurant registration
  $scope.restaurant = {};
  /*
  //submit input form information to DB
  $scope.registerRestaurant = function () {
    if ($scope.restaurantRegistration.$valid) {
      accessDB.insertRestaurantInfo(this.restaurant).then(function(response) {
        if (response == 1) {
          growl.success("Your restaurant has been registered!", {title: 'Success!'});

          $location.path('/restaurant-success')

          //reset forms
          $scope.restaurant = {};
          $scope.restaurantRegistration.submitted = false;

          return true;
        } else if(response == 0) {
          growl.error("Something went wrong!", {title: 'Failed to Register!'});
          return false;
        } else {
          growl.error("Error! Please report this to the Admin", {title: 'Error!'});
          return false;
        }
      });
    } else {
      $scope.restaurantRegistration.submitted = true;
    }
  }
  */

  $scope.registerRestaurant = function (entity) {
    if (entity == 'sharer') {
      $location.path('/restaurant-new-sharer');
    } else {
      $location.path('/restaurant-new-sharee');
    }
  }

  $scope.saveAndContinue = function (location) {
    //$sessionStorage.restaurant = $scope.restaurant;
    $location.path(location);
  }
}]);
