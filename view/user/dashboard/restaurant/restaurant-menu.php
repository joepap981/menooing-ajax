<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null" ></no-session-view>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
    <div class="home-content">

      <div class="restaurant-nav" ng-controller="UserDashboardController as $ctrl">
        <div class="btn clear-btn submit " ng-click="redirect('/restaurant-list')"><img id="circular-button" src="/img/left-arrow-circular-button.png"> Back</div>
        <div class="btn clear-btn" ng-click="redirect('/restaurant-profile')"> Profile </div>
        <div class="btn clear-btn"> Menu </div>
      </div>

      <button class="btn btn-primary" ng-click="$ctrl.open()"> Add Menu+ </button>

      <div id="restaurant-menu">
        <div class="restaurant-category">
          <h6> Main </h6>

          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 portfolio-item" ng-repeat="item in menus">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Project One</a>
                  </h4>
                  <p class="card-text">Price: </p>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="restaurant-category">
          <h6> Appetizer </h6>
          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 portfolio-item" ng-repeat="item in menus">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Project One</a>
                  </h4>
                  <p class="card-text">Price: </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="restaurant-category">
          <h6> Drinks </h6>
          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 portfolio-item" ng-repeat="item in menus">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Project One</a>
                  </h4>
                  <p class="card-text">Price: </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
