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
