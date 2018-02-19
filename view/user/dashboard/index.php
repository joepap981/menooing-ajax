<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <no-session-view></no-session-view>
</div>

<!-- show content when user session is in progress -->
<div id="session" ng-if="session['user_id'] != null" >
  <div class="subnav"></div>
  <div class="container">
    <div class="row" ng-if="session['user_id'] != null">
      <div class="col-md-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-9">
        <div class="content-box" ng-controller="UserDashboardController">
          <h1> Welcome {{ session['user_first_name']}}!  </h1>
        </div>
      </div>
    </div>
  </div>
</div>
