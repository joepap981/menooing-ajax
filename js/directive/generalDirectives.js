angular.module('eatersAndChefs').directive('messages', function() {
  return {
    templateUrl: 'views/admin/messages.html'
  };
});

angular.module('eatersAndChefs').directive('applications', function() {
  return {
    templateUrl: 'views/admin/applications.html'
  };
});

angular.module('eatersAndChefs').directive('dashboard', function() {
  return {
    templateUrl: 'views/admin/dashboard.html'
  };
});
