angular.module('menuApp').controller('restaurantGuestRequestCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', function ($scope, $location, $routeParams, restaurantService, authService, growl) {

  //initialization function
  var init = function () {
    //get the restaurant id from the url
    var url = $location.path().split('/');
    restaurant_id = url.pop();

    getHostUser();
    //update available time list
    updateAvailableList();
    getPrice();
  }

  //available time lists
  $scope.availableTime = {};

  var updateAvailableList = function () {
    var queryObj = {
      "table_name": "tb_restaurant_available",
      "condition": {"restaurant_ref": restaurant_id }
    };

    //bring restaurant information based on restaurant id
    var getAvailable = authService.getInfo(queryObj);
    getAvailable.then(function (result) {
      $scope.availableTime = result;
    })
  }


  var getHostUser = function () {
    var queryObj = {
      "table_name": "tb_restaurant",
      "condition": {"restaurant_id": restaurant_id },
      "field": ["user_ref"]
    };

    //bring restaurant information based on restaurant id
    var getHostUser= authService.getInfo(queryObj);
    getHostUser.then(function (result) {
      $scope.host_user_ref = result[0].user_ref;
    })
  }

  //rent by rent standard
  var getPrice = function () {
    var queryObj = {
      "table_name": "tb_restaurant",
      "condition": {"restaurant_id": restaurant_id },
      "field": ["restaurant_fee", "restaurant_fee_standard"]
    };

    //bring restaurant information based on restaurant id
    var getPricing = authService.getInfo(queryObj);
    getPricing.then(function (result) {
      $scope.pricing = result[0];
      $scope.rentBy = $scope.pricing.restaurant_fee_standard;

    })
  }


    init();

  //DatepickerDemoCtrl
  $scope.today = function() {
    $scope.dt = new Date();
    $scope.dt.setHours(null);
    $scope.dt.setMinutes(null);
    $scope.dt.setSeconds(null);
  };
  $scope.today();

  $scope.clear = function() {
    $scope.dt = null;
  };

  $scope.options = {
    customClass: getDayClass,
    minDate: new Date(),
    showWeeks: true
  };

  // Disable weekend selection
  function disabled(data) {
    var date = data.date,
      mode = data.mode;
    return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
  }

  $scope.toggleMin = function() {
    $scope.options.minDate = $scope.options.minDate ? null : new Date();
  };

  $scope.toggleMin();

  $scope.setDate = function(year, month, day) {
    $scope.dt = new Date(year, month, day);
    console.log($scope.dt);
  };

  var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var afterTomorrow = new Date(tomorrow);
  afterTomorrow.setDate(tomorrow.getDate() + 1);
  $scope.events = [
    {
      date: tomorrow,
      status: 'full'
    },
    {
      date: afterTomorrow,
      status: 'partially'
    }
  ];

  function getDayClass(data) {
    var date = data.date,
      mode = data.mode;
    if (mode === 'day') {
      var dayToCheck = new Date(date).setHours(0,0,0,0);

      for (var i = 0; i < $scope.events.length; i++) {
        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

        if (dayToCheck === currentDay) {
          return $scope.events[i].status;
        }
      }
    }

    return '';
  }


  $scope.requestTimeList = [];
  $scope.rentBy = 'month';

  //add requested time slot
  $scope.addRequestTime = function () {
    var timeSlot = {};

    if($scope.rentBy == 'month') {
      if ($scope.requestTimeList.length >= 1) {
        growl.warning('You only need one beginning date to rent the restaurant for a month');
      } else {
        timeSlot.beginTime = new Date($scope.dt.getTime());
        timeSlot.beginTime.setHours(0);
        timeSlot.beginTime.setMinutes(0);

        timeSlot.endTime = new Date($scope.dt.getTime());
        timeSlot.endTime.setDate(timeSlot.beginTime.getDate() + 30);
        timeSlot.endTime.setHours(0);
        timeSlot.endTime.setMinutes(0);

        $scope.requestTimeList.push(timeSlot);
        $scope.clear();
      }
    } else if ($scope.rentBy == 'day') {
      if ($scope.requestTimeList.length >= 10) {
        growl.warning('You can only schedule 10 days at a time.', {title: 'Warning!'});
      } else {
        timeSlot.beginTime = new Date($scope.dt.getTime());
        timeSlot.beginTime.setHours(0);
        timeSlot.beginTime.setMinutes(0);

        timeSlot.endTime = new Date($scope.dt.getTime());
        timeSlot.endTime.setHours(0);
        timeSlot.endTime.setMinutes(0);

        $scope.requestTimeList.push(timeSlot);
        $scope.clear();
      }
    } else if ($scope.rentBy == 'hour') {
      if ($scope.requestTimeList.length >= 10) {
        growl.warning('You can only schedule 10 slots at a time.', {title: 'Warning!'});
      } else {

        //check time format
        if($scope.beginTime.getHours() > $scope.endTime.getHours()) {
            growl.warning('Check the time and try again.',{title: 'Wrong time format!'});
            return;
        }
        timeSlot.beginTime = new Date($scope.dt.getTime());
        timeSlot.beginTime.setHours($scope.beginTime.getHours());
        timeSlot.beginTime.setMinutes($scope.beginTime.getMinutes());

        timeSlot.endTime = new Date($scope.dt.getTime());
        timeSlot.endTime.setHours($scope.endTime.getHours());
        timeSlot.endTime.setMinutes($scope.endTime.getMinutes());

        $scope.requestTimeList.push(timeSlot);
        $scope.clear();
      }
    } else {
      growl.error('Something went wrong. Refresh the page and try again.', {title: 'Error!'});
    }
  }

  //delete selected time slot
  $scope.deleteRequestedTime = function (hashKey) {
    $scope.requestTimeList = $scope.requestTimeList.filter(slot => slot.$$hashKey != hashKey);
    console.log(hashKey);
  }

  //disable reserved dates
  $scope.disabled = function (date, mode) {
    return (mode === 'day' && (date.getDay() === 0 || date.getDay() === 6));
  };

  //timepicker functions
  $scope.beginTime = new Date();
  $scope.beginTime.setHours( 0 );
  $scope.beginTime.setMinutes( 0 );

  $scope.endTime = new Date();
  $scope.endTime.setHours( 0 );
  $scope.endTime.setMinutes( 0 );

  $scope.hstep = 1;
  $scope.mstep = 15;

  $scope.options = {
    hstep: [1, 2, 3],
    mstep: [1, 5, 10, 15, 25, 30]
  };

  $scope.ismeridian = true;
  $scope.toggleMode = function() {
    $scope.ismeridian = ! $scope.ismeridian;
  };

  $scope.update = function() {
    var d = new Date();
    d.setHours( 14 );
    d.setMinutes( 0 );
    $scope.mytime = d;
  };


  $scope.clear = function() {
    $scope.mytime = null;
  };

  //send rent request

  $scope.sendRequest = function () {
    //post_data to send to server
    var post_data = {};
    post_data = {
      "restaurant_ref": restaurant_id,
      "request_host_user_ref": $scope.host_user_ref,
      "condition": $scope.requestTimeList,
    }

    var sendResult = authService.rentRequest(post_data);
    sendResult.then(function (result) {
      if (result == "Successfully inserted information") {
        $location.path('/request-success/'+restaurant_id);
        growl.success('Successfully sent request!')

      } else if(result == "Failed to create request") {

      } else if (result == "Failed to insert information") {

      } else {

      }
      console.log(result);
    })
  }

}]);
