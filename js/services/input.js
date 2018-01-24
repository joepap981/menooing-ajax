angular.module('menuApp').factory("Data", ['$http', 'toaster',
  function($http, toaster) {
    var serviceBase = "db/user_authentification/";
    var obj = {};
    obj.toast = function (data) {
      toaster.pop(data.status, "", data.message, 4000, 'trustedHtml');
    }
    obj.get = function(sa) {
      return $http.get(serviceBase + sa).then(function(results) {
        return results.data;
      });
    };
    obj.post = function(sa, object) {
      return $http.post(serviceBase + sa, object).then(function(results) {
        return results.data;
      });
    };
    obj.put = function(sa, object) {
      return $http.put(serviceBase + sa, object).then(function(results) {
        return results.data;
      });
    };
    obj.delete = function(sa) {
      return $http.delete(serviceBase + sa).then(function(results) {
        return results.data;
      });
    };

    return obj;
  }
]);
