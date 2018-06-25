angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {
  $scope.restaurant = {};
  var restaurant_id;


  //initializing function
  var init = function () {
    //get the restaurant id from the url
    var url = $location.path().split('/');
    restaurant_id = url.pop();

    //check if the restaurant belongs to current session user
    var priviledgeCheck = restaurantService.checkPrivilege(restaurant_id);
    priviledgeCheck.then(function (result) {
      if(result == "ACCEPTED") {
        //bring restaurant information based on restaurant id
        var getRestaurant = restaurantService.getRestaurantInfo(restaurant_id);
        getRestaurant.then(function (result) {
          $scope.restaurant = result[0];
          $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;
        })
      } else if (result=="DENIED") {
        growl.error('You do not have privilege.',{title: 'Error!'});
        $location.path('/');
      } else if (result == "NO SESSION") {
        growl.error('Please log in to continue.',{title: 'Error!'});
        $location.path('/signin');
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
        $location.path('/');
      }
    })
  }

  //initialize function at loading of controller
  init();


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

      //update restaurant with given information

      var post_info = {};
      post_info['update_info'] = restaurant_address;
      post_info['condition'] = {'restaurant_id': restaurant_id };

      var addressUpdateResult = restaurantService.updateRestaurant(post_info);
      addressUpdateResult.then(function(result) {
        if (result == "SUCCESS") {
          //bring restaurant information based on restaurant id
          var getRestaurant = restaurantService.getRestaurantInfo(restaurant_id);
          getRestaurant.then(function (result) {
            $scope.restaurant = result[0];
            $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;
          })
          //collapse cuisine editing card
          $('#collapseAddress').collapse('hide');

          //clear input box
          $('#autocomplete').val('');
          //show succcess message
          growl.success('Address has been successfully updated.',{title: 'Success!'});
        } else if (result == "FAILED") {
          //show failed message
          growl.error('Address has failed to update. Refresh and try again.',{title: 'Error!'});
        }else {
          //show error message
          growl.error('Something has gone wrong.',{title: 'Error!'});
        }
      })

    } else {
      growl.error('There was no readable address.',{title: 'Error!'});
    }
  }


  //toggle the description input box from view mode <-> edit mode
  $scope.descriptionBoxSwitch = -1;
  $scope.toggleDescriptionBox = function () {
    $scope.descriptionBoxSwitch = $scope.descriptionBoxSwitch * -1;
  }

  $scope.updateDescription = function () {
    var post_info = {};
    post_info['update_info'] = {'description': $scope.restaurant.restaurant_description };
    post_info['condition'] = {'restaurant_id': restaurant_id };

    var descriptionUpdateResult = restaurantService.updateRestaurant(post_info);
    descriptionUpdateResult.then(function(result) {
      if (result == "SUCCESS") {
        $scope.descriptionBoxSwitch = -1;

        var getRestaurant = restaurantService.getRestaurantInfo(restaurant_id);
        getRestaurant.then(function (result) {
          $scope.restaurant = result[0];
          $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;
        })

        growl.success('Description has been successfully updated.',{title: 'Success!'});
      } else if (result == "FAILED") {
        growl.error('Description has failed to update. Refresh and try again.',{title: 'Error!'});
      } else {
        growl.error('There was no readable address.',{title: 'Error!'});
      }
    })
  }

}]);
