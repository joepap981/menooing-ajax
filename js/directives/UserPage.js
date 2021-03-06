
var verStr = "php?v=v003";

//admin view directives
angular.module('menuApp').directive('adminNav', function() {
  return {
    templateUrl: 'view/admin/admin_nav.'+ verStr
  };
});

//user view directives
angular.module('menuApp').directive('navbar', function() {
  return {
    templateUrl: 'view/user/navigation/navbar.'+ verStr
  };
});
angular.module('menuApp').directive('footerStatic', function() {
  return {
    templateUrl: 'view/user/navigation/footer.'+ verStr
  };
});

angular.module('menuApp').directive('sideNav', function() {
  return {
    templateUrl: 'view/user/navigation/sidenav.'+ verStr
  };
});

angular.module('menuApp').directive('restaurantSubnav', function() {
  return {
    templateUrl: 'view/user/dashboard/restaurant/restaurant-subnav.'+ verStr
  };
});
