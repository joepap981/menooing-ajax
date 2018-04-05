angular.module('menuApp').factory('authService', function($http, FileSaver) {
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
          if (response.data == "Available") {
            return 'Available';
          } else if (response.data == "Database Insert Error") {
            return 'DBError';
          } else  if(response.data == "Unavailable"){
            return 'Unavailable';
          } else {
            return 'Failed';
          }}, function myError(response) {
        });
    },

    endSession: function() {
      return $http.get('action/endsession.php').then(function(result) {
        return result.data;
      });
    },

    checkSession: function () {
      return $http({method : "GET", url: 'action/session.php'}).then(function mySuccess(response) {
        return response.data;
      });
    },

    downloadFile: function (downloadInfo) {
      return $http({ method : "POST", url: 'action/download.php', data: downloadInfo, responseType: 'blob'})
      .then(function mySuccess(response) {
        var myData = new Blob([response.data], {type: 'image/png'});
        FileSaver.saveAs(myData, 'pic.png');
      });
    },


  }
});
