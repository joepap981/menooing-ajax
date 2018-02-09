<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <div class="container">
    <h1> Your Session has ended. Want to sign in? </h1>
    <a class="cursor-pointer" ng-click="redirect('/signin')">Sign in</a>
  </div>
</div>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
  <div class='col-md-2'>
    <nav-side-view></nav-side-view>
  </div>

  <div class="col-md-10">
    <div class="home-content">
      <h1> Welcome {{ session['user_first_name']}}!  </h1>
    </div>
  </div>
</div>
