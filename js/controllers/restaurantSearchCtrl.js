angular.module('menuApp').controller('restaurantSearchCtrl',['$scope', '$location', 'restaurantService', 'growl', '$window', function ($scope, $location, restaurantService, growl, $window) {
  $scope.restaurant = {};
  $scope.userRestaurants = [];
  $scope.request_type = "ALL";
  $scope.search_option = "All";
  //two way bound to input for condition, to sever two way binding for actual condition.
  $scope.condition_input;
  $scope.filter = "restaurant_status";
  $scope.condition = "confirmed";

  var init = function () {
    //get all restaurants
    //var request = {"type": "USER"};

    /*test condition
    $scope.request_type = "restaurant_administrative_area_level_1";
    $scope.condition =  "TX";
    */

    var request = {"type":"ALL", "condition": $scope.condition};

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

  //extract required address information
  $scope.extractAddress = function () {
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
          $scope.restaurant[addressType] = val;
        }
      }
    } else {

    }
  }
  $scope.filterRestaurantList = function () {
    console.log("filterrestaruatnlist");
    $scope.condition = $scope.condition_input;
    if($scope.condition == "") {
      var request = {"type": "ALL", "condition": $scope.condition};
    } else {
      var request = {"type": $scope.search_option, "condition": $scope.condition};
    }

    var restaurantList = restaurantService.getRestaurantList(request);
    restaurantList.then(function (result) {
      $scope.userRestaurants = result;

    });
  }


}]);
