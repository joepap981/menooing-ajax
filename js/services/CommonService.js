angular.module('menuApp').factory('getSession', function ($http) {
  var session_data = {};

  $http.get("/action/getsession").then(function(response){
    session_data.user_id = response.data["user_id"]
    session_data.user_first_name = response.data['user_first_name'];
    session_data.user_last_name = response.data['user_last_name'];
  });
  return session_data;
});
