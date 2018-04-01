<!-- Restaurant Menu Index -->
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
        <div class="content-box">
          <div class='btn btn-primary' ng-click="redirect('restaurant-new')"> Register New Restaurant </div>
          <div id="restaurant-list" ng-controller="restaurantCtrl">
            <div class="row">
              <div class="col-lg-4 col-sm-6 portfolio-item" ng-repeat="restaurant in userRestaurants">
                <div class="card h-100">
                  <a href="#" ng-click="redirectToProfile(restaurant.restaurant_id)"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="#" ng-click="redirectToProfile(restaurant.restaurant_id)">{{ restaurant.restaurant_name }}</a>
                    </h4>
                    <p class="card-text">{{ restaurant.restaurant_locality}}, {{ restaurant.restaurant_administrative_area_level_1 }} </p>
                    <p class="card-text"> Status: {{ restaurant.restaurant_status }} <p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
