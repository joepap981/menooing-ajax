angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {

  var restaurant_id;
  $scope.restaurant = {};

  var init = function () {
    var url = $location.path().split('/');
    restaurant_id = url.pop();

    var getRestaurant = restaurantService.getRestaurantInfo(restaurant_id);
    getRestaurant.then(function (result) {
      $scope.restaurant = result[0];
      $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;
    });
  };

  //run initialization method
  init();

  //file download
  $scope.downloadRestaurantCert = function () {
    var downloadInfo = {
      'user_id': $scope.restaurant.user_ref,
      'path': $scope.restaurant.restaurant_cert,
    }

    authService.downloadFile(downloadInfo);

    /*
    result.then(function(response) {
      if (response != "Success") {
        growl.error(response,{title: 'Error!'});
      } else {}
    });
    */
  }

  //menu add
  $scope.menu = {};
  $scope.clearForm = function () {
    $scope.menu = {};
  }
}]);
