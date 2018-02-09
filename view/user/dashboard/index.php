<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null"></no-session-view>

<!-- show content when user session is in progress -->
<div class="home-content" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
  <h1> Welcome {{ session['user_first_name']}}!  </h1>
</div>
