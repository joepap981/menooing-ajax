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
    }
  }
});
