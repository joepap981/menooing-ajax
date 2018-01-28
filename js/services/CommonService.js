angular.module('menuApp').factory('Session', function($http) {
  return {
    getSession: function() {
      return $http.get('action/session/').then(function(result) {
        return result;
      });
    },

    endSession: function() {
      return $http.get('action/endsession/').then(function(result) {
        return result;
      });
    }
  }
});
