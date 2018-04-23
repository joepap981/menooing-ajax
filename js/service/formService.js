angular.module('eatersAndChefs').factory('formService', function($http) {
  return {
    //use post method to upload packet to database
    post: function (packet) {
      return $http({ method : "POST", url: 'actions/post.php', data: packet})
      .then(function (response) {
          return response.data;
        }
      );
    },

    uploadFile: function (form_data) {
      return $http({ method: "POST", url: "actions/uploadfile.php", data: form_data, headers: {'Content-Type': undefined},
    }).then(function mySuccess(response) {
        return response.data;
      });
    },

  }
});
