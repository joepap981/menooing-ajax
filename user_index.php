<div ng-controller="AuthController">
	<link href="css/user/index.css<?php echo $jsTimeStamp ?>" rel="stylesheet">

	<!-- Navigation -->
	<header> <div top-nav-default></div></header>


	<!-- Main View Section -->
	<main ng-view></main>

	<!--Footer -->
	<div footer-static></div>

</div>


<!-- Javascript links -->
<script src="js/app.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/controllers/AuthController.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/services/MenuStorage.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/directives/UserPage.js<?php echo $jsTimeStamp ?>"></script>
<script src="js/services/CommonService.js<?php echo $jsTimeStamp ?>"></script>
