<div class="row">
  <div class="col-md-7" id="restaurant-information-input">
    <h3> Welcome {{ session['user_first_name']}}! </h3>
    <h5> Please give us basic information about your restaurant!</h5>
    <br></br>
    <form name="restaurantRegistration">
      <div class="form-group">
        <label for="restaurant_name">Name</label>
        <input name="name" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.name" class="form-control" placeholder="" required>
      </div>
      <div class="form-group">
        <label for="address">Location</label>
        <input name="address1" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.address1" class="form-control" placeholder="Address 1" required>
      </div>
      <div class="form-group">
        <input name="address2" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.address2" class="form-control" placeholder="Address 2">
      </div>
      <div class="form-inline">
        <div class="form-group">
          <input name="city" id="city" type="text"  ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.city" class="form-control" placeholder="City" required>
        </div>
        <div class="form-group">
          <input name="state" id="state" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.state" class="form-control" placeholder="State" required>
        </div>
        <div class="form-group">
          <input name="zipcode" id="zipcode" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.zip" class="form-control" placeholder="Zip Code" ng-maxlength= "5" required>
        </div>
      </div>

      <div class="form-group">
        <label for="Cuisine">Cuisine</label>
        <input type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.cuisine" class="form-control" id="zipcode" placeholder="Chinese, Mexican, Burger..." required>
      </div>
    </form>
    <button class="submit right-margin clear-btn" ng-click="selectPage('restaurant')"><img id="circular-button" src="/img/left-arrow-circular-button.png"> Back</button>
    <button type='submit' class="clear-btn" ng-click="registerRestaurant()">Submit <img id="circular-button" src="/img/right-arrow-circular-button.png"></button>
  </div>
  <div class="col-md-5">
    <img id="img-fork" src="/img/fork.png">
  </div>
</div>
