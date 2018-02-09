<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null" ></no-session-view>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
    <div class="home-content">

      <div class="navbar">
        <button class="submit right-margin clear-btn" ng-click="redirect('restaurant')"><img id="circular-button" src="/img/left-arrow-circular-button.png"> Back</button>
        <button class="clear-btn"> Profile </button>
        <button class="clear-btn"> Menu </button>
      </div>

      <div class="content">
      </div>


    </div>
  </div>
</div>