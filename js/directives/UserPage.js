
var verStr = "php?v=v003";

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


angular.module('menuApp').directive('topNav', function() {
  return {
    templateUrl: 'view/top-nav.'+ verStr
  };
});
angular.module('menuApp').directive('footerStatic', function() {
  return {
    templateUrl: 'view/footer.'+ verStr
  };
});
angular.module('menuApp').directive('landingPage', function() {
  return {
    templateUrl: 'view/landing-page.'+ verStr
  };
});
