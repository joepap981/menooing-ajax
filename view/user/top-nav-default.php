<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <div class="container">
    <span ng-click ="redirect('/')" class="navbar-brand logo"> menooing </span>
    <!--show before a user is in session -->
    <div id="guest" ng-show="session['user_id'] == null" >
      <div class="btns">
        <span ng-hide="checkURL('/sharekitchen')" class="clear-btn larger-space" ng-click="redirect('/sharekitchen')"> Share Your Kitchen </span>
        <span class="clear-btn" ng-click="redirect('/signin')"> Sign in</span>
        <span class="clear-btn" ng-click="redirect('/signup')">Sign up</span>
      </div>
    </div>
    <!-- show when a session is running-->
    <div id="logon-user" ng-show="session['user_id'] != null" >
        <a class="clear-btn" ng-click="logout()">Logout</a>
    </div>
  </div>
</nav>
