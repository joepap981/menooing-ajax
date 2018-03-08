angular.module('menuApp').factory('restaurantService', function($http) {
  var data = {};
  var restaurant = {};

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

    //add item to var restaurant
    buildRestaurant: function (key, value) {
      restaurant[key] = value;
    },

    //deletes an element of var restaurnat array attribute
    deleteRestaurantAttribute: function (attribute) {
      delete restaurant[attribute];
    },

    getRestaurant: function () {
      return restaurant;
    },

  }
});
