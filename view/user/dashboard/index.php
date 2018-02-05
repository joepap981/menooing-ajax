<!-- Custom CSS -->
<link href="css/user/userlogin.css" rel="stylesheet">
<link href="css/user/home.css" rel="stylesheet">

<?php
  session_start();
?>
<div class="home-content" ng-controller ="UserDashboardController">
  <div id="no_session" ng-if="session['user_id'] == null">
    <div class="container">
      <h1> Your Session has ended. Want to sign in? </h1>
      <a class="cursor-pointer" ng-click="redirect('/signin')">Sign in</a>
    </div>
  </div>

  <!--Content -->
  <div class="container" ng-if="session['user_id'] != null">
    <dashboard-page-view ng-show="isSelected(1)"></dashboard-page-view>
    <dashboard-page-view ng-show="isSelected(2)"></dashboard-page-view>
    <dashboard-page-view ng-show="isSelected(3)"></dashboard-page-view>
    <dashboard-page-view ng-show="isSelected(4)"></dashboard-page-view>
    <dashboard-page-view ng-show="isSelected(5)"></dashboard-page-view>
  </div>
</div>

<script src="js/directives/UserDashboardViewDirective.js<?php echo $jsTimeStamp ?>"></script>
