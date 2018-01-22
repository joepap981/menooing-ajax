<div ng-controller="menuCtrl">

<header> <div top-nav></div></header>

<div left-nav></div>


<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
<BR>
<h1>{{selNav.name}}</h1>

<div ng-if="selNav.itemSysNo == 2" store-list></div>
<div ng-if="selNav.itemSysNo == 4" menu-list></div>
<div ng-if="selNav.itemSysNo == 3" type-list></div>

<div ng-if="selNav.itemSysNo == 11" profile-main></div>
<div ng-if="selNav.itemSysNo == 12" doc-main></div>
<div ng-if="selNav.itemSysNo == 91" user-list></div>

</main>

</div>

<script src="js/app.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/MenuCtrl.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/services/MenuStorage.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/directives/MenuList.js<?php echo $jsTimeStamp ?>"></script>


