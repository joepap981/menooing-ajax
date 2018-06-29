angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {
  $scope.restaurant = {};
  $scope.availableTime = {};
  $scope.input = {};
  var restaurant_id;


  $scope.input.day = "Monday";


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
        updateRestaurantList();
        updateAvailableList();


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

  var updateAvailableList = function () {
    var queryObj = {
      "table": "tb_restaurant_available",
      "key": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getAvailable = restaurantService.getInfo(queryObj);
    getAvailable.then(function (result) {
      $scope.availableTime = result;
    })
  }

  var updateRestaurantList = function () {
    var queryObj = {
      "table": "tb_restaurant",
      "key": {"restaurant_id": restaurant_id }
    };
    //bring restaurant information based on restaurant id
    var getRestaurant = restaurantService.getInfo(queryObj);
    getRestaurant.then(function (result) {
      $scope.restaurant = result[0];
      $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;
    })
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

      //update restaurant with given information

      var post_info = {};
      post_info['update_info'] = restaurant_address;
      post_info['condition'] = {'restaurant_id': restaurant_id };

      var addressUpdateResult = restaurantService.updateRestaurant(post_info);
      addressUpdateResult.then(function(result) {
        if (result == "SUCCESS") {

          //bring restaurant information based on restaurant id
          updateRestaurantList();

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

        //update restaurantList
        updateRestaurantList();

        growl.success('Description has been successfully updated.',{title: 'Success!'});
      } else if (result == "FAILED") {
        growl.error('Description has failed to update. Refresh and try again.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    })
  }

  //toggle the description input box from view mode <-> edit mode
  $scope.priceBoxSwitch = -1;
  $scope.togglePriceBox = function () {
    $scope.priceBoxSwitch = $scope.priceBoxSwitch * -1;
  }

  $scope.updatePrice = function () {
    var post_info = {};
    post_info['update_info'] = {'fee': $scope.restaurant.restaurant_fee, 'fee_standard':$scope.restaurant.restaurant_fee_standard };
    post_info['condition'] = {'restaurant_id': restaurant_id };

    var priceUpdateResult = restaurantService.updateRestaurant(post_info);
    priceUpdateResult.then(function(result) {
      if (result == "SUCCESS") {
        $scope.priceBoxSwitch = -1;

        updateRestaurantList();

        growl.success('Pricing has been successfully updated.',{title: 'Success!'});
      } else if (result == "FAILED") {
        growl.error('Pricing has failed to update. Refresh and try again.',{title: 'Error!'});
      } else {
        growl.error('Something has gone wrong.',{title: 'Error!'});
      }
    })
  }

  $scope.beginTime = new Date();
  $scope.beginTime.setHours( 0 );
  $scope.beginTime.setMinutes( 0 );

  $scope.endTime = new Date();
  $scope.endTime.setHours( 0 );
  $scope.endTime.setMinutes( 0 );

  $scope.hstep = 1;
  $scope.mstep = 15;

  //frontend time spinner controlling functions
  $scope.addMinBegin = function () {
    var d = new Date();
    d.setHours( $scope.beginTime.getHours() );
    d.setMinutes( $scope.beginTime.getMinutes() + $scope.mstep );
    $scope.beginTime = d;

  }

  $scope.lessMinBegin = function () {
    var d = new Date();
    d.setHours( $scope.beginTime.getHours() );
    d.setMinutes( $scope.beginTime.getMinutes() - $scope.mstep );
    $scope.beginTime = d;

  }

  $scope.addMinEnd = function () {
    var d = new Date();
    d.setHours( $scope.endTime.getHours()  );
    d.setMinutes( $scope.endTime.getMinutes() + $scope.mstep );
    $scope.endTime = d;
  }

  $scope.lessMinEnd = function () {
    var d = new Date();
    d.setHours( $scope.endTime.getHours()  );
    d.setMinutes( $scope.endTime.getMinutes() - $scope.mstep );
    $scope.endTime = d;
  }

  //send added avaiable time to DB
  $scope.addAvailableTime = function () {
    var beginTimeText = $scope.beginTime.toTimeString();
    beginTimeText = beginTimeText.split(' ')[0];
    beginTimeText = beginTimeText.split(':');
    beginTimeText = beginTimeText[0] + ":" + beginTimeText[1];

    var endTimeText = $scope.endTime.toTimeString();
    endTimeText = endTimeText.split(' ')[0];
    endTimeText = endTimeText.split(':');
    endTimeText = endTimeText[0] + ":" + endTimeText[1];

    var post_data = {};

    post_data = {"restaurant_ref": restaurant_id, "available_day": $scope.input.day, "available_begin": beginTimeText, "available_end": endTimeText};

    //if the beginning time is greater than the ending one try again.
    if($scope.beginTime.getHours() > $scope.endTime.getHours()) {
        growl.warning('Check the time and try again.',{title: 'Wrong time format!'});
    } else {
      var createResult = restaurantService.createAvailableHour(post_data);
      createResult.then(function (result) {
        if (result == "Successfully inserted information") {
          updateAvailableList();
          $('#timeModal').modal('hide');
          growl.success('Available time has been added!',{title: 'Success!'});
        }else if(result == "Failed to insert information") {
          growl.error('Failed to insert to DB.',{title: 'Error!'});
        } else {
          growl.error('Something has gone wrong.',{title: 'Error!'});
        }
      });
    }
  }


}]);
