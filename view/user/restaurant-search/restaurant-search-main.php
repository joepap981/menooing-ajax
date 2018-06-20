<div class="container mt-5">
  <form class="mb-5">
    <div class="row">
      <div class="col-2">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-primary active" style="margin-right: 0px; box-shadow: 0 0 0 0;">
            <input type="radio" name="options" id="option1" autocomplete="off" checked> All </input>
          </label>
          <label class="btn btn-primary" style="margin-right: 0px; box-shadow: 0 0 0 0;">
            <input type="radio" name="options" id="option2" autocomplete="off"> Host</input>
          </label>
          <label class="btn btn-primary" style="margin-right: 0px; box-shadow: 0 0 0 0;">
            <input type="radio" name="options" id="option3" autocomplete="off"> Guest</input>
          </label>
        </div>
      </div>
      <div class="col-3">
        <label class="mr-sm-2" for="inlineFormCustomSelect"> Search by </label>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
          <option selected>All</option>
          <option value="1"> City </option>
          <option value="2"> Cuisine </option>
          <option value="3">Three</option>
        </select>
      </div>

      <div class="col-4">
         <input type="text" class="form-control" placeholder="Search">
      </div>
      <div class="col-1">
        <button class="btn btn-primary"> Search </button>
      </div>
    </div>
  </form>

  <div id="restaurant-list" ng-controller="restaurantSearchCtrl">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" ng-repeat="restaurant in userRestaurants" ng-show ="restaurant.restaurant_status == 'confirmed' && (restaurant[filter] == condition)" >
        <div class="card h-80">
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
