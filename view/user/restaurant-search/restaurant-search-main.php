<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <p> Restaurant name </p>
    </div>
    <div class="card-body">
      <div id="restaurant-list" ng-controller="restaurantSearchCtrl">
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
