<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Hi, you want to start your restaurant on menooing? </h3>
    <p> Yes, I want to register my restaurant for lease on menooing! </p>
  </div>
  <div style="margin-left:37%;">

      <a href="#" ng-click="setRestaurantData('entity', 'host'); registerRestaurant('restaurant-new-host')" class="card card-link">
        <div class="card-body text-center">
          <h5 class="card-title">Host</h5>
          <p class="card-text">You are a brick and mortar restaurant extra owner who wants to rent out your kitchen space!</p>
        </div>
      </a>
      <!-- <a href="#" ng-click="setRestaurantData('entity', 'guest'); registerRestaurant('restaurant-new-guest')" class="card card-link">
        <div class="card-body text-center">
          <h5 class="card-title">Guest</h5>
          <p class="card-text">You are a food entrepreneur looking for a place to show off your culinary skills and business acumen!</p>
        </div>
      </a> -->

  </div>
</div>
