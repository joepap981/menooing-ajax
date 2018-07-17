angular.module('menuApp').directive('landingPageView', function() {
  return {
    templateUrl: 'view/admin/landing-page.php'
  };
});

angular.module('menuApp').directive('userListView', function() {
  return {
    templateUrl: 'view/admin/user-list.php'
  };
});

angular.module('menuApp').directive('requestsView', function() {
  return {
    templateUrl: 'view/admin/requests.php'
  };
});

angular.module('menuApp').directive('restaurantProfileView', function() {
  return {
    templateUrl: 'view/admin/restaurant-profile-admin.php'
  };
});
