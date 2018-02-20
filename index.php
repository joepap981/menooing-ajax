<?php $timeStr = time() + (7 * 24 * 60 * 60) ;
$jsTimeStamp = '?version=v-'.$timeStr;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">

		<base href="/">
		<title> Menooing.com </title>

		<!-- Bootstrap core stylesheet-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link href="css/user/index.css<?php echo $jsTimeStamp ?>" rel="stylesheet">
		<link href="lib/growl-css/angular-growl.min.css" rel="stylesheet">

		<!-- Bootstrap core JavaScript ================================================== -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.7/angular-route.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.js"></script>
	</head>

	<body ng-app="menuApp" ng-controller="AuthController">
		<div growl></div>
		<?php

			$urlStr =  $_SERVER['REQUEST_URI'];
			$urlStr = substr($urlStr, -5);

			$b2bFlag = false;

			if ($urlStr == "admin"){
				$b2bFlag = true;
			}

			if ($b2bFlag ) {
				include 'admin_index.php';
			} else {
				include 'user_index.php';
			}


	?>

	<script src="lib/growl-js/angular-growl.min.js"></script>
	</body>
</html>
