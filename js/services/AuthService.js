angular.module('menuApp').factory('accessDB', function($http) {
  var data = {};
  return {
    get: function(signin) {
      return $http({method : "POST", url: 'action/signin.php', data: signin})
      .then(function mySuccess(response) {
        data = response.data;
        return data;
      });
    },

    set: function(signup) {
      return $http({ method : "POST", url: 'action/signup.php', data: signup})
      .then(function mySuccess(response) {
        //*** need to implement case where db read or write fail!! ***

          //check if email already exists and if it does,
          if (response.data == "Unavailable") {
            return false;
          } else {
            return true;
          }}, function myError(response) {
        });
    },

    endSession: function() {
      return $http.get('action/endsession/').then(function(result) {
        return result.data;
      });
    },

    checkSession: function () {
      return $http({method : "GET", url: 'action/session/'}).then(function mySuccess(response) {
        return response.data;
      });
    },

    insertRestaurantInfo: function(restaurant) {
      return $http({ method: "POST", url: "action/restaurant_register/", data: restaurant})
      .then(function mySuccess (response) {
        if (response.data == "Success") {
          return true;
        } else {
          return false;
        }
      });
    },


    //check for user session and return restaurnt information related to user
    getRestaurantInfo: function(user_id) {
      return $http({ method: "GET", url: "action/restaurant_get/"})
      .then(function mySuccess (response) {
        if (response.data['length'] != 0) {
          return response.data;
        } else {
          console.log("No result");
          return null;
        }
      });
    }
  }
});
