/**
 *  Mene Controller will be 
 */


angular.module('menuApp').controller('cartCtrl', function ($scope,MenuStorage) {

  $scope.navList = [
  {"itemSysNo":11,"name":"Profile","type":"P"},{"itemSysNo":12,"name":"Document(w9)","type":"P"},
  {"itemSysNo":2,"name":"VR","type":"P"},
  //{"itemSysNo":3,"name":"Type","type":"N"}, 
  {"itemSysNo":4,"name":"Menu","type":"N"},
  {"itemSysNo":91,"name":"(Admin)User List","type":"A"}, {"itemSysNo":92,"name":"(Admin)Order","type":"A"},
  {"itemSysNo":5,"name":"Order","type":"O"}

  ];

  $scope.selNav = {};
  $scope.selStore = {};
  $scope.selType = {};
	$scope.typeList = {};
	$scope.menuList = {};



    MenuStorage.get("store").then(function (retStorage) {
        $scope.storeList = retStorage.data;
    });
      

    $scope.refreshMenu = function () {


	    MenuStorage.get("type").then(function (retStorage) {
	        $scope.typeList = retStorage.data;
	    });


      MenuStorage.get("menu").then(function (retStorage) {
	        $scope.menuList = retStorage.data;
	    });
    };    

  $scope.refreshMenu();
});

