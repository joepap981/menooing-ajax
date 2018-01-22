angular.module('myApp').controller('IndexController', function ($scope) {
  $scope.state = "user";

  function changeState (state) {
    $scope.state = state;
  }
});
