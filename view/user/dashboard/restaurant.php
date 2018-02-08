<div id="restaurant-menubar">
  <div class='btn btn-primary' ng-click="selectPage('restaurant-new')"> Register New Restaurant </div>
</div>

<div id="restaurant-list">
  <div class="card" ng-repeat= "restaurant in userRestaurants">
    <div class="row">
      <div class="col-md-3">
        <img class="card-img-top" src="http://placehold.it/500x325" alt="">
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <h4 class="card-title">{{ restaurant.restaurant_name }}</h4>
          <p class="card-text"> {{restaurant.restaurant_address1}} {{ restaurant.restaurant_state }} {{restaurant.restaurant_zip }}</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Find Out More!</a>
        </div>
      </div>
    </div>
  </div>
</div>
