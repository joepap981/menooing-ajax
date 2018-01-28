<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <div class="container">
    <a class="navbar-brand" href="/">Menooing</a>
    <!--show before a user is in session -->
    <div id="guest" ng-show="session['user_id'] == null" >
      <div class="btns">
        <a class="btn btn-secondary" href="/signin">Sign In</a>
        <a class="btn btn-primary" href="/signup">Sign Up</a>
      </div>
    </div>
    <!-- show when a session is running-->
    <div id="logon-user" ng-show="session['user_id'] != null" >
        <a class="btn btn-primary" ng-click="logout()">Logout</a>
    </div>
  </div>
</nav>
