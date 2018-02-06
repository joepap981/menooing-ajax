<div class="row">
  <div class="col-md-7" id="restaurant-information-input">
    <h3> Welcome {{ session['user_first_name']}}! </h3>
    <h5> Please give us basic information about your restaurant!</h5>
    <br></br>
    <form>
      <div class="form-group">
        <label for="restaurant_name">Name</label>
        <input type="text" class="form-control" id="address1" placeholder="">
      </div>
      <div class="form-group">
        <label for="address">Location</label>
        <input type="text" ng-model="restaurant.address1" class="form-control" id="address1" placeholder="Address 1">
      </div>
      <div class="form-group">
        <input type="text" ng-model="restaurant.address2" class="form-control" id="address2" placeholder="Address 2">
      </div>
      <div class="form-inline">
        <div class="form-group">
          <input type="text" ng-model="restaurant.city" class="form-control" id="city" placeholder="City">
        </div>
        <div class="form-group">
          <input type="text" ng-model="restaurant.state" class="form-control" id="state" placeholder="State">
        </div>
        <div class="form-group">
          <input type="text" ng-model="restaurant.zipcode" class="form-control" id="zipcode" placeholder="Zip Code">
        </div>
      </div>

      <div class="form-group">
        <label for="Cuisine">Cuisine</label>
        <input type="text" ng-model="restaurant.cuisine" class="form-control" id="zipcode" placeholder="Chinese, Mexican, Burger...">
      </div>
    </form>
    <a href='#' class="right-margin clear-btn" ng-click="selectPage('restaurant')"><img id="circular-button" src="/img/left-arrow-circular-button.png">Back</a>
    <a href='#' class="clear-btn" ng-click="selectPage('restaurant-new2')">Submit <img id="circular-button" src="/img/right-arrow-circular-button.png"></a>
  </div>
  <div class="col-md-5">
    <img id="img-fork" src="/img/fork.png">
  </div>
</div>
