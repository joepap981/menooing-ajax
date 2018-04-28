angular.module('eatersAndChefs').factory('adminService', function($http) {
  return {
    getList: function(data) {
      return $http({ method: "POST", url: "actions/get_list.php", data: data})
      .then(function mySuccess (response) {
        if (response.data['length'] != 0) {
          return response.data;
        } else {
          console.log("No result");
          return null;
        }
      });
    },

  }
});
