angular.module('menuApp').factory('restaurantService', function($http, $window) {
  var data = {};
  var googlePlace = {};
  var file_list = [];


  return {
    //insert user and restaurant info to db
    insertRestaurantInfo: function(restaurant_info) {
      return $http({ method: "POST", url: "action/restaurant_create.php", data: restaurant_info})
      .then(function mySuccess (response) {
        if (response.data != null) {
          return parseInt(response.data);
        } else if (response.data == "Failed to write to DB"){
          return 'Failed to write to DB';
        } else {
          return "Something has terribly gone wrong.";
        }
      });
    },

    //check for user session and return restaurnt information related to user
    getRestaurantList: function(request_type) {
      return $http({ method: "POST", url: "action/restaurant_get_list.php", data: request_type})
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
          return response.data;
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

    //receives restaurant info
    //update_info - contains key and value of restaurant information
    //conditions - the conditions that needs to be satisfied
    updateRestaurant: function (restaurant_info) {
      return $http({ method: "POST", url: "action/update_restaurant_info.php", data: restaurant_info
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

    uploadFile: function (form_data) {
      return $http({ method: "POST", url: "action/uploadfile.php", data: form_data, headers: {'Content-Type': undefined},
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

    pushToFileList: function (form_data) {
      file_list.push(form_data);
    },

    getFileList: function () {
      return file_list;
    },

    clearFileList: function () {
      file_list = [];
    },

    checkPrivilege: function (restaurant_id) {
      return $http({ method: "POST", url: "action/check_privilege.php", data: restaurant_id
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

  }
});
