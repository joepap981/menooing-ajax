angular.module('menuApp').factory('restaurantService', function($http, $window) {
  var data = {};
  var googlePlace = {};


  return {
    //insert sessionStorage restaurant info to DB
    insertRestaurantInfo: function() {
      if ($window.sessionStorage.restaurant != null) {
        var restaurant = $window.sessionStorage.restaurant;
      } else {
        var restaurant = {};
      }
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

    insertUserInfo: function() {
      if ($window.sessionStorage.user != null) {
        var user = $window.sessionStorage.user;
      } else {
        var user = {};
      }
      return $http({ method: "POST", url: "action/user_info_input.php", data: user})
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

    //add  data to sessionStorage for temporary storage
    //type: name of sessionStorage object
    //obj: object to save into sessionStorage object
    saveToSession: function (type, obj) {
      //when there is nothing in Session, do not parse session.restaurant
      if ($window.sessionStorage[type] == null) {
        var response = {};
      }
      //when there are items saved in session, parse JSON and add items
      else {
        var response = JSON.parse($window.sessionStorage[type]);
      }

      //loop through each item and save to session storage
      for(key in obj) {
        response[key] = obj[key];
      }
      $window.sessionStorage[type] = JSON.stringify(response);
    },

    uploadFile: function (table_name, form_data) {
      return $http({ method: "POST", url: "action/uploadfile.php", data: form_data, headers: {'Content-Type': undefined},
    }).then(function mySuccess(response) {
        alert(response);
      });
    }

  }
});
