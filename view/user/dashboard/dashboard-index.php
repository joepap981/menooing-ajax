<!-- Custom CSS -->
<link href="css/user/userlogin.css" rel="stylesheet">
<link href="css/user/dashboard.css" rel="stylesheet">

<?php
session_start();
?>
<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <div class="container">
    <h1> Your Session has ended. Want to sign in? </h1>
    <a class="cursor-pointer" ng-click="redirect('/signin')">Sign in</a>
  </div>
</div>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
  <div class="col-md-2">
    <ul class="sidebar-nav" >
      <li>
        <a href="#" ng-click="selectPage('dashboard')">Dashboard</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage('restaurant')">Restaurant</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage('sharee')">Sharee</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage('requests')">Requests</a>
      </li>
      <li>
        <a href="#" ng-click="selectPage('profile')">Profile</a>
      </li>
    </ul>
  </div>
  <div class="col-md-10">
    <div class="home-content">
      <!-- Main tabs -->
      <dashboard-page-view ng-show="page == 'dashboard'"></dashboard-page-view>
      <restaurant-page-view ng-show="page == 'restaurant'"></restaurant-page-view>
      <sharee-page-view ng-show="page == 'sharee'"></sharee-page-view>
      <requests-page-view ng-show="page == 'requests'"></requests-page-view>
      <profile-page-view ng-show="page == 'profile'"></profile-page-view>

      <!-- Sub tabs -->
      <restaurant-new-view ng-show="page == 'restaurant-new'"></restaurant-new-view>
    </div>
  </div>
</div>
