<!-- Top Navigation -->

<!-- NO SESSION (NOT LOGGED IN) -->
<nav class="navbar navbar-light bg-light static-top" ng-if="session['user_id'] == null">
    <!--logo-->
    <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>

    <div class="btn">
      <span ng-hide="isURL('/sharekitchen')" class="clear-btn larger-space" ng-click="redirect('/sharekitchen')"> Share Your Kitchen </span>
      <span class="clear-btn" ng-click="redirect('/signin')"> Sign in</span>
      <span class="clear-btn" ng-click="redirect('/signup')">Sign up</span>
    </div>
</nav>

<!-- SESSION (LOGGED IN) -->
<nav class="navbar navbar-light bg-light static-top" ng-if="session['user_id'] != null">
  <ul class="sidebar-nav" ng-controller="AuthController" >
    <li>
      <a href="#" ng-click="redirect('/home')">Dashboard</a>
    </li>
    <li>
      <a href="#" ng-click="redirect('/restaurant-list')">Restaurant</a>
    </li>
    <li>
      <a href="#" ng-click="redirect('/sharee')">Sharee</a>
    </li>
    <li>
      <a href="#" ng-click="redirect('/requests')">Requests</a>
    </li>
    <li>
      <a href="#" ng-click="redirect('/profile')">Profile</a>
    </li>
  </ul>

  <!--logo-->
  <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>
  <div class="clear-btn nav-item ml-auto" ng-click="redirect('/home')"> Dashboard </div>
  <div class="nav-item dropdown">
    <!-- User ICON image -->
    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img class="img-fluid rounded-circle user_img" src="/img/default-user.png" alt="">
    </a>

    <!--dropdown menu-->
    <span class="dropdown-menu" aria-labelledby="messagesDropdown">
      <a class="dropdown-item" ng-click="redirect('/home')">Dashboard</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Settings</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" ng-click="logout()">Logout</a>
    </span>
  </div>
</nav>
