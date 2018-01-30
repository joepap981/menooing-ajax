<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <div class="container">
    <span ng-click ="redirect('/')" class="navbar-brand logo"> menooing </span>
    <!--show before a user is in session -->
    <div id="guest" ng-show="session['user_id'] == null" >
      <div class="btns">
        <span ng-hide="isURL('/sharekitchen')" class="clear-btn larger-space" ng-click="redirect('/sharekitchen')"> Share Your Kitchen </span>
        <span class="clear-btn" ng-click="redirect('/signin')"> Sign in</span>
        <span class="clear-btn" ng-click="redirect('/signup')">Sign up</span>
      </div>
    </div>
    <!-- show when a session is running-->
    <div id="logon-user" ng-show="session['user_id'] != null" >

        <span class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-fluid rounded-circle user_img" src="/img/default-user.png" alt="">
          </a>
          <span class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
              <a class="clear-btn" ng-click="logout()">Logout</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
          </span>
        </span>
    </div>
  </div>
</nav>
