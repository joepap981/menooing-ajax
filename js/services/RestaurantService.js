angular.module('menuApp').factory('restaurantService', function($http, $window) {
  var data = {};
  var googlePlace = {};

  return {
    insertRestaurantInfo: function(restaurant) {
      return $http({ method: "POST", url: "action/restaurant_register.php", data: restaurant})
      .then(function mySuccess (response) {
        if (response.data == "Success") {
          return 1;
        } else if (response.data == "Failed"){
          return 0;
        } else {
          return -1;
        }
      });
    },

    //check for user session and return restaurnt information related to user
    getRestaurantList: function(user_id) {
      return $http({ method: "GET", url: "action/restaurant_get_list.php"})
      .then(function mySuccess (response) {
        if (response.data['length'] != 0) {
          return response.data;
        } else {
          console.log("No result");
          return null;
        }
      });
    },

    getRestaurantInfo: function(restaurant_id) {
      var queryObj = {
        "table": "tb_restaurant",
        "key": {"restaurant_id": restaurant_id }
      };

      return $http({ method: "POST", url: "action/get.php", data: queryObj})
      .then(function mySuccess (response) {
        if (response.data != null) {
          var restaurant = response.data[0];
          return restaurant;
        } else {
          return null;
        }
      });
    },

    //add restaurant data to sessionStorage for temporary storage
    saveRestaurantToSession: function (restaurant) {
      //when there is nothing in Session, do not parse session.restaurant
      if ($window.sessionStorage.restaurant == {}) {
        var response = {};
      }
      //when there are items saved in session, parse JSON and add items
      else {
        var response = JSON.parse($window.sessionStorage.restaurant);
      }

      for(key in restaurant) {
        response[key] = restaurant[key];
      }
      $window.sessionStorage.restaurant = JSON.stringify(response);
    },

  }
});
