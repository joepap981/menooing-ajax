angular.module('eatersAndChefs').factory('formService', function($http) {
  return {
    //use post method to upload packet to database
    post: function (packet) {
      return $http({ method : "POST", url: 'actions/post.php', data: packet})
      .then(function (response) {
          console.log(response);
        }
      );
    },
  }
});
