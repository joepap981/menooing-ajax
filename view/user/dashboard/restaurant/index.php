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
      <div id="restaurant-menubar">
        <div class='btn btn-primary' ng-click="selectPage('restaurant-new')"> Register New Restaurant </div>
      </div>
      <div id="restaurant-list">
        <div class="row">
          <div class="col-lg-4 col-sm-6 portfolio-item" ng-repeat="restaurant in userRestaurants">
            <div class="card h-100">
              <a href="#" ng-click="selectPage('restaurant-profile')"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#" ng-click="selectPage('restaurant-profile')">{{ restaurant.restaurant_name }}</a>
                </h4>
                <p class="card-text">{{ restaurant.restaurant_address1 }} {{ restaurant.restaurant_address2 }} {{ restaurant.restaurant_state }} {{ restaurant.restaurant_zip }}</p>
                <p class="card-text"> Status: {{ restaurant.restaurant_status }} <p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
