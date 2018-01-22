/**
 *  Mene Controller will be 
 */


angular.module('menuApp').controller('menuCtrl', function ($scope,MenuStorage) {

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
      
    $scope.selectNav = function (rec) {
      $scope.selNav= rec;
      $scope.refreshMenu();
    };
    $scope.selectStore = function (rec) {
      $scope.selStore = rec;
      $scope.refreshMenu();
    };
    $scope.selectType = function (rec) {
      $scope.selType = rec;
      $scope.refreshMenu();
    };

    $scope.checkValuee = function (rec) {
      rec.itemSysNo ==   $scope.selType
    };

    $scope.refreshMenu = function () {


	    MenuStorage.get("type").then(function (retStorage) {
	        $scope.typeList = retStorage.data;
	    });

      if ($scope.selStore.itemSysNo <= 0){ return;}   
      MenuStorage.get("menu").then(function (retStorage) {
	        $scope.menuList = retStorage.data;
	    });
    };    

     console.log("1",$scope.storeList  );
     console.log("2",$scope.menuList  );
});

