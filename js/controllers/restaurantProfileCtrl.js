angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {

  var restaurant_id;
  $scope.restaurant = {};

  var init = function () {
    var url = $location.path().split('/');
    restaurant_id = url.pop();

    var getRestaurant = restaurantService.getRestaurantInfo(restaurant_id);
    getRestaurant.then(function (result) {
      $scope.restaurant = result[0];
      $scope.restaurant.cert_name = $scope.restaurant.restaurant_cert.split('/').pop();
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

  //extract required address information
  $scope.updateAddress = function () {
    var restaurant_address ={};
    //attributes from autocomplete that needs to be saved
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    //get the address saved to RestaurantService from googlePlaceCtrl
    var fullAddress = restaurantService.googlePlace;

    //iterate through the received address and save only the ones needed to RestaurantService restaurant
    if (fullAddress != null) {
      for (var i = 0; i < fullAddress.length; i++) {
        var addressType = fullAddress[i].types[0];

        //if the given address attribute matches one of the componentForms
        if (componentForm[addressType]) {
          var val = fullAddress[i][componentForm[addressType]];
          restaurant_address[addressType] = val;
        }
      }
    } else {

    }

    var ajaxObj = {};
    ajaxObj['update_info'] = restaurant_address;
    ajaxObj['condition'] = {'restaurant_id': restaurant_id};

    restaurantService.updateRestaurant(ajaxObj).then(function(response)  {
      console.log(response);
    });

  }

  //menu add
  $scope.menu = {};
  $scope.clearForm = function () {
    $scope.menu = {};
  }
}]);
