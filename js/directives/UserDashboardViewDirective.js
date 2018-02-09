angular.module('menuApp').directive('dashboardPageView', function() {
  return {
    templateUrl: 'view/user/dashboard/dashboard.php'
  };
});

angular.module('menuApp').directive('restaurantPageView', function() {
  return {
    templateUrl: 'view/user/dashboard/restaurant.php'
  };
});

angular.module('menuApp').directive('shareePageView', function() {
  return {
    templateUrl: 'view/user/dashboard/sharee.php'
  };
});

angular.module('menuApp').directive('requestsPageView', function() {
  return {
    templateUrl: 'view/user/dashboard/requests.php'
  };
});

angular.module('menuApp').directive('profilePageView', function() {
  return {
    templateUrl: 'view/user/dashboard/profile.php'
  };
});


angular.module('menuApp').directive('restaurantListView', function() {
  return {
    templateUrl: 'view/user/dashboard/restaurant/restaurant-list.php'
  };
});
angular.module('menuApp').directive('restaurantNewView', function() {
  return {
    templateUrl: 'view/user/dashboard/restaurant/restaurant-new.php'
  };
});
angular.module('menuApp').directive('restaurantNew2View', function() {
  return {
    templateUrl: 'view/user/dashboard/restaurant/restaurant-new2.php'
  };
});
angular.module('menuApp').directive('restaurantProfileView', function() {
  return {
    templateUrl: 'view/user/dashboard/restaurant/restaurant-profile.php'
  };
});

angular.module('menuApp').directive('navSideView', function() {
  return {
    templateUrl: 'view/user/dashboard/nav-side.html'
  };
});
angular.module('menuApp').directive('noSessionView', function() {
  return {
    templateUrl: 'view/user/dashboard/nosession.html'
  };
});
