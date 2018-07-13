angular.module('menuApp').factory('authService', function($http, FileSaver) {
  var data = {};
  return {
    signin: function(signin) {
      return $http({method : "POST", url: 'action/signin.php', data: signin})
      .then(function mySuccess(response) {
        data = response.data;
        return data;
      });
    },

    signup: function(signup) {
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

    //CRUD Functions
    //table_name
    //update_info - contains key and value of restaurant information
    //conditions - the conditions that needs to be satisfied

    //create
    insertInfo: function (post_data) {
      return $http({ method: "POST", url: "action/insert.php", data: post_data
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

    //read
    getInfo: function(queryObj) {
      return $http({ method: "POST", url: "action/get.php", data: queryObj})
      .then(function mySuccess (response) {
        if (response.data != null) {
          return response.data;
        } else {
          return null;
        }
      });
    },

    //update
    updateInfo: function (post_data) {
      return $http({ method: "POST", url: "action/update.php", data: post_data
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

    //delete
    deleteInfo: function (queryObj) {
      return $http({ method: "POST", url: "action/delete.php", data: queryObj})
      .then(function mySuccess (response) {
          return response.data;
      });
    },

    //insert multiple
    insertMultiple: function (post_data) {
      return $http({ method: "POST", url: "action/insert_multiple.php", data: post_data
    }).then(function mySuccess(response) {
        return response.data;
      });
    },


    //Session Functions
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


    //File upload download functions
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


  }
});
