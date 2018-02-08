<div id="restaurant-menubar">
  <div class='btn btn-primary' ng-click="selectPage('restaurant-new')"> Register New Restaurant </div>
</div>

<div id="restaurant-list">
  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item" ng-repeat="restaurant in userRestaurants">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">{{ restaurant.restaurant_name }}</a>
          </h4>
          <p class="card-text">{{ restaurant.restaurant_address1 }} {{ restaurant.restaurant_address2 }} {{ restaurant.restaurant_state }} {{ restaurant.restaurant_zip }}</p>
          <p class="card-text"> Status: {{ restaurant.restaurant_status }} <p>
        </div>
      </div>
    </div>
  </div>
</div>
