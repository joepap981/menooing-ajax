/**
 * Created by Chris on 6/3/16.
 */
var API_PATH = "action/";
angular.module('menuApp').factory('MenuStorage', function ($http, $q) {

  var storage = {
    todos: [],


    get: function (callTypeStr) {

      var SUB_PATH = API_PATH + callTypeStr;

      var deferred = $q.defer();
      $http.get(SUB_PATH)
          .then(function success(response) {
            console.log(storage,response.data);
            deferred.resolve(angular.copy(response.data, storage.todos));
          }, function error(err) {
            console.error(err);
            deferred.reject(err);
          });
      return deferred.promise;
    },

    getNavList: function (){



    }



  };

  return storage;
});