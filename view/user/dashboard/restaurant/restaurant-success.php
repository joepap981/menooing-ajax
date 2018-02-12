<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null" ></no-session-view>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
    <div class="home-content">

      <h3> Thanks! Your registration request has been sent to our team! </h3>
      <h5> After review, an email will be sent to you to finalize your restaurant registration.</h5>
      <a href="#" ng-click="redirect('/restaurant-list')"> Go back to 'Restaurant' </a>

    </div>
  </div>
</div>
