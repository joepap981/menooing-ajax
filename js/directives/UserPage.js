
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
    templateUrl: 'view/user/navigation/top-nav-default.'+ verStr
  };
});
angular.module('menuApp').directive('footerStatic', function() {
  return {
    templateUrl: 'view/user/navigation/footer.'+ verStr
  };
});
