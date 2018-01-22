<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menooing</title>

    <!-- Bootstrap core CSS -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="lib/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Angular core -->
    <script src="lib/angular.min.js"></script>
    <script src="lib/angular-route.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Javascript -->
    <script src="js/app.js"></script>


  </head>

  <body ng-app="myApp">

    <?php
    //get the URL string
    $urlStr =  $_SERVER['REQUEST_URI'];
    $urlStr = substr($urlStr, 1,5);

    //if the URL is admin, use admin template
    if($urlStr == "admin") {
      include 'admin_main.php';
    //else use the user template
    } else {
      include 'user_main.php';
    }
    ?>




  </body>

</html>
