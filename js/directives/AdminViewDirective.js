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

angular.module('menuApp').directive('editPersonDialog', [function() {
  return {
    restrict: 'E',
    scope: {
      model: '=',
    },
    link: function(scope, element, attributes) {
      scope.$watch('model.visible', function(newValue) {
        var modalElement = element.find('.modal');
        modalElement.modal(newValue ? 'show' : 'hide');
      });

      element.on('shown.bs.modal', function() {
        scope.$apply(function() {
          scope.model.visible = true;
        });
      });

      element.on('hidden.bs.modal', function() {
        scope.$apply(function() {
          scope.model.visible = false;
        });
      });

    },
    templateUrl: 'edit-person-dialog.html',
  };
}]);
