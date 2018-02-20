<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Hey Sharer!</h3>
    <p> Give us some information about your brick and mortar restaurant</p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
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
      <div class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharer2')" class="btn btn-primary"> Continue </button>
      </div>
    </form>
  </div>
</div>
