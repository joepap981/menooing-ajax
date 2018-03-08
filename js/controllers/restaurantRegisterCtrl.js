angular.module('menuApp').controller('restaurantRegisterCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {

  $scope.restaurant = {};

  //registering restaurant: choose whether sharer or sharee
  $scope.registerRestaurant = function (entity) {
    if (entity == 'sharer') {
      restaurantService.buildRestaurant('restaurant_entity', 'sharer');
      $location.path('/restaurant-new-sharer');
    } else {
      restaurantService.buildRestaurant('restaurant_entity', 'sharee');
      $location.path('/restaurant-new-sharee');
    }
  }

  //new-sharer2: add address
  $scope.registerSharer = function () {
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
    var fullAddress = restaurantService.getRestaurant().address;

    //iterate through the received address and save only the ones needed to RestaurantService restaurant
    for (var i = 0; i < fullAddress.length; i++) {
      var addressType = fullAddress[i].types[0];
      if (componentForm[addressType]) {
        var val = fullAddress[i][componentForm[addressType]];

        //save attribute to RestaurantService: var restaurant
        restaurantService.buildRestaurant(addressType, val);
      }
    }

    //delete the address saved by googlePlaceCtrl in RestaurantService
    restaurantService.deleteRestaurantAttribute('address');
  }

}]);
