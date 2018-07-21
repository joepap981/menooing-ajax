angular.module('menuApp').controller('restaurantSearchCtrl',['$scope', '$location', 'restaurantService', 'authService', 'growl', '$window', function ($scope, $location, restaurantService, authService, growl, $window) {
  $scope.restaurant = {};
  $scope.userRestaurants = [];

  //search filter option and input box variable
  $scope.search_filter = undefined;
  $scope.search_input;

  //variables to apply to filter two avoid two way binding
  //to apply filter only when search button is clicked

  $scope.search_filter_apply = undefined;
  $scope.search_input_apply = null;

  var init = function () {
    updateRestaurantList();

  }

  var updateRestaurantList = function () {
    //get all restaurants that are verified
    var post_data = {
      "table_name": "tb_restaurant",
      "condition": {
        "restaurant_status": "'VERIFIED'",
      },
      "field": [
        "restaurant_id", "restaurant_status", "restaurant_name", "restaurant_locality", "restaurant_administrative_area_level_1", "restaurant_image"
      ]
    }

    var restaurantsGet = authService.getInfo(post_data);
    restaurantsGet.then(function(result) {
      if (result != null) {
        $scope.userRestaurants = result;
        $scope.totalItems = $scope.userRestaurants.length;
      } else if(result == null) {
        console.log("No restaurants found.");
      } else {
        console.log("Failed to load restaurants from DB.");
      }
    });
  }

  $scope.redirectToProfile = function (restaurant_id) {
    $location.path('/restaurant-profile-guest/'+restaurant_id);
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

  //custome filter for search search_option - restaurant name, city, cuisine
  $scope.searchFilter = function (item) {
    if ($scope.search_input_apply == "" || $scope.search_input_apply == null || $scope.search_filter_apply == undefined) {
      return item;
    } else {
      return item[$scope.search_filter_apply].toLowerCase().includes($scope.search_input_apply);
    }
  }

  $scope.filterRestaurantList = function () {
    $scope.search_filter_apply = $scope.search_filter;
    $scope.search_input_apply = $scope.search_input.toLowerCase();
  }

  //restaurant pagination
  $scope.viewby = 12;
  $scope.currentPage = 1;
  $scope.itemsPerPage = $scope.viewby;
  $scope.maxSize = 5; //Number of pager buttons to show

  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
  };

  $scope.pageChanged = function() {
    console.log('Page changed to: ' + $scope.currentPage);
    console.log($scope.viewby);
    console.log($scope.totalItems);
  };

  $scope.setItemsPerPage = function(num) {
    $scope.itemsPerPage = num;
    $scope.currentPage = 1; //reset to first page
  }

  //run initialization method
  init();


}]);
