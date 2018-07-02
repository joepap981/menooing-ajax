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


    uploadFile: function (form_data) {
      return $http({ method: "POST", url: "action/uploadfile.php", data: form_data, headers: {'Content-Type': undefined},
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

    downloadFile: function (downloadInfo) {
      return $http({ method : "POST", url: 'action/download.php', data: downloadInfo, responseType: 'blob'})
      .then(function mySuccess(response) {

        //build output filename
        var ext = response.data['type'].split('/')[1];
        var filename = downloadInfo['path'].split('/').pop();
        filename = filename.split('_');
        filename.pop();
        filename = filename.join('_');
        filename = filename + '.' + ext;

        myData = new Blob([response.data], {type: response.data['type']});
        FileSaver.saveAs(myData, filename);
      });
    },

    getInformation: function (queryObject) {
      return $http({ method : "POST", url: 'action/get.php', data: queryObject})
      .then(function mySuccess(response) {
        return response.data;
      });
    },

    updateInformation: function (changes) {
      return $http({ method: "POST", url: "action/update_info.php", data: changes })
    .then(function mySuccess(response) {
        return response.data;
      });
    },


  }
});
