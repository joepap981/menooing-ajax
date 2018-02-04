<link href="css/user/userlogin.css" rel="stylesheet">
<div class="container">
  <h1> This is the user homepage</h1>
  <?php
    session_start();
    echo json_encode($_SESSION['user']);
  ?>
</div>
