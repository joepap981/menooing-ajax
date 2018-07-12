angular.module('menuApp').controller('restaurantGuestRequestCtrl',['$scope', '$location', '$routeParams', 'restaurantService', 'authService', 'growl', function ($scope, $location, $routeParams, restaurantService, authService, growl) {

  //initialization function
  var init = function () {
    //get the restaurant id from the url
    var url = $location.path().split('/');
    restaurant_id = url.pop();

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

  //rent by rent standard

  ;

  var getPrice = function () {
    var queryObj = {
      "table_name": "tb_restaurant",
      "condition": {"restaurant_ref": restaurant_id },
      "field": ["restaurant_fee", "restaurant_fee_standard"]
    };

    //bring restaurant information based on restaurant id
    var getPricing = authService.getInfo(queryObj);
    getPricing.then(function (result) {
      $scope.pricing = result;
      console.log()
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

  $scope.addRequestTime = function () {
    var timeSlot = {};

    if($scope.rentBy == 'month') {
      if ($scope.requestTimeList.length > 1) {
        growl.warning('You only need one beginning date to rent the restaurant for a month');
      } else {
        timeSlot = $scope.dt;
        $scope.requestTimeList.push(timeSlot);
        $scope.clear();
      }
    } else if ($scope.rentBy == 'day') {
      if ($scope.requestTimeList.length > 10) {
        growl.warning('You can only schedule 10 days at a time.', {title: 'Warning!'});
      } else {
        timeSlot = $scope.dt;
        $scope.requestTimeList.push(timeSlot);
        $scope.clear();
      }
    } else if ($scope.rentBy == 'hour') {
      if ($scope.requestTimeList.length > 10) {
        growl.warning('You can only schedule 10 slots at a time.', {title: 'Warning!'});
      } else {
        timeSlot.beginTime = $scope.dt;
        timeSlot.beginTime.setHours($scope.beginTime.getHours());
        timeSlot.beginTime.setMinutes($scope.beginTime.getMinutes());
        timeSlot.endTime = $scope.dt;
        timeSlot.endTime.setHours($scope.endTime.getHours());
        timeSlot.endTime.setMinutes($scope.endTime.getMinutes());

        $scope.requestTimeList.push(timeSlot);
        console.log($scope.requestTimeList);
        $scope.clear();
      }
    } else {
      growl.danger('Something went wrong. Refresh the page and try again.', {title: 'Error!'});
    }
  }

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

}]);
