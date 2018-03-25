angular.module('menuApp').factory('adminService', function($http) {
  return {

    getRequestList: function() {
      return $http({ method: "POST", url: "action/get_requests.php"})
      .then(function mySuccess (response) {
        if (response.data['length'] != 0) {
          return response.data;
        } else {
          console.log("No result");
          return null;
        }
      });
    },

    //confirm restaurant_status to confirmed + request_status to handled
    confirmRestaurantRegister: function(data) {
      return $http({ method: "POST", url: "action/restaurant_confirmation.php", data: data})
      .then(function mySuccess (response) {
        return response.data;
      });
    },
  }

});
