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
