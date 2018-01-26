angular.module('menuApp').factory('getSession', function ($http) {
  var session_data = {};

  $http.get("/action/getsession").then(function(response){
    console.log(response);
    /*
    session_data.user_id = response.session['user_id'];
    session_data.user_email = response.session['user_email'];
    session_data.user_first_name = response.session['user_first_name'];
    session_data.user_last_name = response.session['user_last_name'];
    */
  });
  return session_data;
});
