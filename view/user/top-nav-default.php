<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <div class="container">
    <span ng-click ="redirect('/')" class="navbar-brand"> <img id="logo" src="img/men_logo.png" alt="Menooing" /> </span>
    <!--show before a user is in session -->
    <div id="guest" ng-show="session['user_id'] == null" >
      <div class="btns">
        <span class="clear-btn" ng-click="redirect('/signin')"> SIGN IN</span>
        <span class="clear-btn" ng-click="redirect('/signup')">SIGN UP</a>
      </div>
    </div>
    <!-- show when a session is running-->
    <div id="logon-user" ng-show="session['user_id'] != null" >
        <a class="clear-btn" href="/" ng-click="logout()">LOGOUT</a>
    </div>
  </div>
</nav>
