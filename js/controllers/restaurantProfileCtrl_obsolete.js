angular.module('menuApp').controller('restaurantProfileCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', 'FileSaver', 'Blob', function ($scope, $location, $routeParams, restaurantService, authService, growl, FileSaver, Blob, $uibModal) {

  var restaurant_id;
  $scope.restaurant = {};
  $scope.input = {};
  $scope.files = {};
  $scope.operationHours = {
    'openHour': null, 'openMin': null, 'open': null,
    'closeHour': null, 'closeMin': null, 'close': null
  };

  var init = function () {
    var url = $location.path().split('/');
    restaurant_id = url.pop();

    var getRestaurant = restaurantService.getRestaurantInfo(restaurant_id);
    getRestaurant.then(function (result) {
      $scope.restaurant = result[0];

      //if restaurant cert exists, slice out path information
      if($scope.restaurant.restaurant_cert != null) {
        $scope.restaurant.cert_name = $scope.restaurant.restaurant_cert.split('/').pop();
      }

      //build restaurant address
      $scope.restaurant.address = $scope.restaurant.restaurant_street_number + " " + $scope.restaurant.restaurant_route + " " + $scope.restaurant.restaurant_locality + ", " + $scope.restaurant.restaurant_administrative_area_level_1;

      //if open date and hours information exists, build into readable string
      if ($scope.checkDateHours() == true) {
        $scope.restaurant.open_time = $scope.restaurant.restaurant_open_day + "~" + $scope.restaurant.restaurant_close_day + ", " + $scope.restaurant.restaurant_open_hour + "-" + $scope.restaurant.restaurant_close_hour;
      }
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

    //create an object to update restaurant database info
    //update_info : key and value of items that need to be changed
    //condition: key and value of conditions that need to be satisfied in order to be updated
    var ajaxObj = {};
    ajaxObj['update_info'] = restaurant_address;
    ajaxObj['condition'] = {'restaurant_id': restaurant_id};

    restaurantService.updateRestaurant(ajaxObj).then(function(response) {
      if (response == "SUCCESS") {
          growl.success('Successfully updated restaurant address info.',{title: 'Success!'});

          //clear address input + collapse address editing card
          document.getElementById('autocomplete').value = '';
          $('#collapseAddress').collapse('hide');

          //update page change
          init();
      }else {
          growl.error('Failed to update restaurant address info.',{title: 'Error!'});
      }
    });
  };

  $scope.updatePhone = function () {
    //if use has not selected choice
    if ($scope.input.phone == null  || $scope.input.phone == {}) {
      growl.warning('Please input a phone number.',{title: 'Warning!'});
    }

    var ajaxObj = {};
    ajaxObj['update_info'] = {'phone': $scope.input.phone};
    ajaxObj['condition'] = {'restaurant_id': restaurant_id};

    restaurantService.updateRestaurant(ajaxObj).then(function(response) {
      if (response == "SUCCESS") {
          growl.success('Successfully updated restaurant phone number.',{title: 'Success!'});

          //clear address input + collapse address editing card
          $scope.input.phone = null;
          $('#collapsePhone').collapse('hide');

          //update page change
          init();
      }else {
          growl.error('Failed to update restaurant phone number.',{title: 'Error!'});
      }
    })
  };

  $scope.checkDateHours = function () {
    if (($scope.restaurant.restaurant_open_day && $scope.restaurant.restaurant_close_day &&
      $scope.restaurant.restaurant_open_hour && $scope.restaurant.restaurant_close_hour) != null) {
        return true;
    }
    return false;
  }

  $scope.uploadFile = function () {
    if ($scope.files.restaurant_cert == null) {
      console.log($scope.files.restaurant_cert[0]);
      growl.warning('Select a file to upload.',{title: 'Error!'});
    } else {
      //create form_data for ajax post
      var form_data = new FormData();
      form_data.append($scope.files.restaurant_cert.file_type, $scope.files.restaurant_cert[0]);
      //append file type indicator
      form_data.append('file_type', $scope.files.restaurant_cert.file_type);
      //append database table name
      form_data.append('table_name', 'tb_restaurant');
      form_data.append('restaurant_id', restaurant_id);

      //does not erase original file, just add new file and new path to db
      restaurantService.uploadFile(form_data).then(function (response) {
        if (response == "SUCCESSFULLY UPLOADED") {
          $scope.files.restaurant_cert[0] = null;
          $('#collapseCert').collapse('hide');
          $('#coFile').val('');
          init();
          growl.success(response, {title: 'Success'});
        } else {
          growl.error(response,{title: 'Error!'});
        }

      });
    }
  }

  //cancatenate time string
  $scope.updateOperationHours = function () {
    //if user has selected all of the operation hour selections
    //build the operation hours and update
    for (var element in $scope.operationHours) {
      if ($scope.operationHours[element] == null) {
        growl.warning('Fill in all of the operation hour selections', {title: 'Warning'});
        return false;
      }
    }

    $scope.restaurant['open_hour'] = $scope.operationHours['openHour'] + ":" + $scope.operationHours['openMin'] + $scope.operationHours['open'];
    $scope.restaurant['close_hour'] = $scope.operationHours['closeHour'] + ":" + $scope.operationHours['closeMin'] + $scope.operationHours['close'];

    var ajaxObj = {};
    ajaxObj['update_info'] = {
      'open_day': $scope.restaurant.open_day, 'open_hour': $scope.restaurant.open_hour,
    'close_day': $scope.restaurant.close_day, 'close_hour': $scope.restaurant.close_hour };
    ajaxObj['condition'] = {'restaurant_id': restaurant_id};

    restaurantService.updateRestaurant(ajaxObj).then(function(response) {
      if (response == "SUCCESS") {
          growl.success('Successfully updated restaurant operation hours.',{title: 'Success!'});

          //clear operation hour selection + collapse operation hours editing card
          $scope.operationHours = {
            'openHour': null, 'openMin': null, 'open': null,
            'closeHour': null, 'closeMin': null, 'close': null
          };

          $scope.restaurant.open_day = null;
          $scope.restaurant.close_day = null;

          $('#collapseOpen').collapse('hide');

          //update page change
          init();
      }else {
          growl.error('Failed to update restaurant operation hours.',{title: 'Error!'});
      }
    });
  }

  $scope.updateCategory = function () {
    //if use has not selected choice
    if ($scope.input.category == null  || $scope.input.category == {}) {
      growl.warning('Please select a category.',{title: 'Warning!'});
    }

    var ajaxObj = {};
    ajaxObj['update_info'] = {'category': $scope.input.category};
    ajaxObj['condition'] = {'restaurant_id': restaurant_id};

    restaurantService.updateRestaurant(ajaxObj).then(function(response) {
      if (response == "SUCCESS") {
          growl.success('Successfully updated restaurant category.',{title: 'Success!'});

          //collapse category editing card
          $('#collapseCategory').collapse('hide');
          //clear category
          $scope.input.category = null;

          //update page change
          init();

      }else {
          growl.error('Failed to update restaurant category.',{title: 'Error!'});
      }
    })
  }

  $scope.updateCuisine = function() {

    //if use has not selected choice
    if ($scope.input.cuisine == null || $scope.input.cuisine == {}) {
      growl.warning('Please select a cuisine.',{title: 'Warning!'});
    }

    var ajaxObj = {};
    ajaxObj['update_info'] = {'cuisine': $scope.input.cuisine};
    ajaxObj['condition'] = {'restaurant_id': restaurant_id};

    restaurantService.updateRestaurant(ajaxObj).then(function(response) {
      if (response == "SUCCESS") {
          growl.success('Successfully updated restaurant cuisine.',{title: 'Success!'});

          //collapse cuisine editing card
          $('#collapseCuisine').collapse('hide');
          //clear category
          $scope.input.cuisine = null;

          //update page change
          init();

      }else {
          growl.error('Failed to update restaurant cuisine.',{title: 'Error!'});
      }
    })
  }

  $scope.initCropper = function () {
    var image = document.getElementById('image-holder');
    var cropper = new Cropper(image, {
      aspectRatio: 7 / 4,
      minContainerWidth: 450,
      minContainerHeight: 350,
      strict: false,
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
      }
    });
  }

  $scope.uploadImage = function () {
    if ($scope.restaurant_image == null) {
      //console.log($scope.restaurant_image[0]);
      growl.warning('Select an image to upload.',{title: 'Error!'});
    } else {
      //create form_data for ajax post
      var form_data = new FormData();
      form_data.append($scope.restaurant_image.file_type, $scope.restaurant_image[0]);
      //append file type indicator
      form_data.append('file_type', $scope.restaurant_image.file_type);
      //append database table name
      form_data.append('table_name', 'tb_restaurant');
      form_data.append('restaurant_id', restaurant_id);

      //does not erase original file, just add new file and new path to db
      restaurantService.uploadFile(form_data).then(function (response) {
        if (response == "SUCCESSFULLY UPLOADED") {
          $scope.restaurant_image = null;
          $('#image-holder').val('');
          init();
          growl.success(response, {title: 'Success'});
        } else {
          growl.error(response,{title: 'Error!'});
        }

      });
    }
  }

  


  //menu add
  $scope.menu = {};
  $scope.clearForm = function () {
    $scope.menu = {};
  }
}]);
