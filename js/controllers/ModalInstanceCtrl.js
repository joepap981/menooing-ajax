angular.module('menuApp').controller('ModalInstanceCtrl', function ($scope, $http, $modalInstance, products, selectedProducts, user) {

  //console.log('user', user);
  $scope.products = products;

  $scope.selected = selectedProducts;

  $scope.chkChange = function(item) {
      console.log(item);
      var index  = $scope.selected.indexOf(item);
      if (index > -1) {
          $scope.selected.splice(index, 1);
      }
      else {
          // not selected --> we have to add it
          $scope.selected.push(item);
      }
      console.log($scope.selected);
  };
  //console.log(selectedProducts);
  $scope.ok = function () {
      // prepare everything for sending to sever
      // --> probably check here if the data have changed or not (not implemented yet)

      console.log('new selection', $scope.selected);
      var data = $.param({
            json: JSON.stringify({
                user: user.name,
                products: $scope.selected
            })
        });

      $http.post('/echo/json/', data)
          .success(function(data, status) {
              console.log('posted the following data:', data);
          });

      $modalInstance.close();//); $scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

//custom filter to display the selected products.
app.filter('array', function() {
    return function(input) {
        //console.log(input);
        return input.join(', ');
    };
});
