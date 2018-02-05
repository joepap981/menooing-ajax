<!-- Custom CSS -->
<link href="css/user/userlogin.css" rel="stylesheet">
<link href="css/user/dashboard.css" rel="stylesheet">

<?php
session_start();
?>
<div class="row" ng-model="page" ng-controller="UserDashboardController">
  <div class="col-md-2">
    <ul class="sidebar-nav" >
      <li>
        <a href="#" ng-click="selectPage(1)">Dashboard</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage(2)">Restaurant</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage(3)">Sharee</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage(4)">Requests</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage(5)">Profile</a>
      </li>
    </ul>
  </div>
  <div class="col-md-10">
    <div class="home-content">
      <!-- if the session has ended show redirect page-->
      <div id="no_session" ng-if="session['user_id'] == null">
        <div class="container">
          <h1> Your Session has ended. Want to sign in? </h1>
          <a class="cursor-pointer" ng-click="redirect('/signin')">Sign in</a>
        </div>
      </div>

      <!-- show content when user session is in progress -->
      <div ng-if="session['user_id'] != null">
        <dashboard-page-view ng-show="page == 1"></dashboard-page-view>
        <restaurant-page-view ng-show="page == 2"></restaurant-page-view>
        <sharee-page-view ng-show="page == 3"></sharee-page-view>
        <requests-page-view ng-show="page == 4"></requests-page-view>
        <profile-page-view ng-show="page == 5"></profile-page-view>
      </div>
    </div>
  </div>
</div>
