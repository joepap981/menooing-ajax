
var verStr = "php?v=v003";


//--------------------------------------------------------
angular.module('menuApp').directive('profileMain', function() {
  return {
    templateUrl: 'view/profile-main.'+ verStr
  };
});
angular.module('menuApp').directive('docMain', function() {
  return {
    templateUrl: 'view/doc-main.'+ verStr
  };
});

angular.module('menuApp').directive('userList', function() {
  return {
    templateUrl: 'view/user-list.'+ verStr
  };
});

angular.module('menuApp').directive('storeList', function() {
  return {
    templateUrl: 'view/store-list.'+ verStr
  };
});

angular.module('menuApp').directive('typeList', function() {
  return {
    templateUrl: 'view/type-list.'+ verStr
  };
});

angular.module('menuApp').directive('menuList', function() {
  return {
    templateUrl: 'view/menu-list.'+ verStr
  };
});
angular.module('menuApp').directive('leftNav', function() {
  return {
    templateUrl: 'view/left-nav.'+ verStr
  };
});
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
