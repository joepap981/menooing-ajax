
var verStr = "php?v=v003";

//admin view directives
angular.module('menuApp').directive('adminNav', function() {
  return {
    templateUrl: 'view/admin/admin_nav.'+ verStr
  };
});

//user view directives
angular.module('menuApp').directive('topNavDefault', function() {
  return {
    templateUrl: 'view/user/top-nav-default.'+ verStr
  };
});
angular.module('menuApp').directive('footerStatic', function() {
  return {
    templateUrl: 'view/user/footer.'+ verStr
  };
});
angular.module('menuApp').directive('landingPage', function() {
  return {
    templateUrl: 'view/user/landing-page.'+ verStr
  };
});
angular.module('menuApp').directive('userSignUp', function() {
  return {
    templateUrl: 'view/user/user-sign-up.'+ verStr
  };
});
