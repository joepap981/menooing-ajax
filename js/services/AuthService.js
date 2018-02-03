angular.module('menuApp').factory('accessDB', function($http) {
  var data = {};
  return {
    get: function(signin) {
      return $http({method : "POST", url: 'action/signin/', data: signin})
      .then(function mySuccess(response) {
        data = response.data;
        return data;
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
    }
  }
});
