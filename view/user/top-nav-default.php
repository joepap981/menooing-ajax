<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <!-- Sidebar -->
  <div ng-if="session['user_id'] != null" class="navbar-default">
    <ul class="sidebar-nav">
      <li>
        <a href="#">Dashboard</a>
      </li>
      <li>
        <a href="#">Shortcuts</a>
      </li>
      <li>
        <a href="#">Overview</a>
      </li>
      <li>
        <a href="#">Events</a>
      </li>
      <li>
        <a href="#">About</a>
      </li>
      <li>
        <a href="#">Services</a>
      </li>
      <li>
        <a href="#">Contact</a>
      </li>
    </ul>
  </div>
  <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>
  <!--show when NO session -->
  <div id="guest" ng-if="session['user_id'] == null" >
    <div class="btns">
      <span ng-hide="isURL('/sharekitchen')" class="clear-btn larger-space" ng-click="redirect('/sharekitchen')"> Share Your Kitchen </span>
      <span class="clear-btn" ng-click="redirect('/signin')"> Sign in</span>
      <span class="clear-btn" ng-click="redirect('/signup')">Sign up</span>
    </div>
  </div>
  <!-- show when a session is running-->
  <div id="logon-user" ng-if="session['user_id'] != null" >
    <div id="session-user-name"> {{ session['user_first_name'] }} </div>
      <!-- User ICON NAVIGATION -->
    <span class="nav-item dropdown">
      <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="img-fluid rounded-circle user_img" src="/img/default-user.png" alt="">
      </a>
      <span class="dropdown-menu" aria-labelledby="messagesDropdown">
        <a class="dropdown-item" ng-click="redirect('/home')">Profile</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Settings</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" ng-click="logout()">Logout</a>
      </span>
    </span>
  </div>
</nav>
