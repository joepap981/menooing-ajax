<!-- Custom CSS -->
<link href="css/user/userlogin.css" rel="stylesheet">
<link href="css/user/home.css" rel="stylesheet">
<div class="home-content">
  <div id="no_session" ng-if="session['user_id'] == null">
    <div class="container">
      <h1> Your Session has ended. Want to sign in? </h1>
      <a class="cursor-pointer" ng-click="redirect('/signin')">Sign in</a>
    </div>
  </div>

  <!--Content -->
  <div class="container" ng-if="session['user_id'] != null">
    <h1> This is the Profile Page </h1>
  </div>
</div>
