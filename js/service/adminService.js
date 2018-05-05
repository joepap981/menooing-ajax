angular.module('eatersAndChefs').factory('adminService', function($http, FileSaver) {
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

    downloadFile: function (downloadInfo) {
    return $http({ method : "POST", url: 'actions/download.php', data: downloadInfo, responseType: 'blob'})
    .then(function mySuccess(response) {

      //build output filename
      var ext = response.data['type'].split('/')[1];
      var filename = downloadInfo['path'].split('/').pop();
      filename = filename.split('_');
      filename.pop();
      filename = filename.join('_');
      filename = filename + '.' + ext;


      FileSaver.saveAs(response.data, filename);
      });
    },

  }
});
