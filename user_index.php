<div class="content" ng-controller="AuthController">
	<link href="css/user/index.css<?php echo $jsTimeStamp ?>" rel="stylesheet">
	<!--fonts -->
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">

	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

	<!-- Navigation -->
	<header navbar></header>

	<!-- Main View Section -->

	<main class="content" ng-view></main>

	<!--Footer -->
	<div footer-static></div>


</div>


<!-- Javascript links -->
<script src="js/app.js<?php echo $jsTimeStamp ?>"></script>

<script src="js/controllers/AuthController.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/UserDashboardController.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/restaurantCtrl.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/restaurantRegisterCtrl.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/restaurantProfileCtrl.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/googlePlaceCtrl.js<?php echo $jsTimeStamp ?>"></script>

<script src="js/services/AuthService.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/services/restaurantService.js<?php echo $jsTimeStamp ?>"></script>

<script src="js/directives/UserPage.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/directives/UserDashboardViewDirective.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/directives/fileInputDirective.js<?php echo $jsTimeStamp ?>"></script>
