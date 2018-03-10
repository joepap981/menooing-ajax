<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Hey Sharer!</h3>
    <p> What is the name of your restaurant?</p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div class="form-group row">
        <label class="col-label" for="owner_name">Name</label>
        <input type="text" class="form-control col-input" placeholder="" ng-model='restaurant.name' required>
      </div>

      <div class="restaurant-text-title">
        <p> Where is your brick and mortar store located? </p>
      </div>

      <input ng-controller= "googlePlaceCtrl" id="autocomplete" placeholder="Enter your address" ng-focus="geolocate()" type="text"></input>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new')" class="btn btn-secondary"> Back </button>
        <button ng-click="extractAddress(); registerRestaurant('/restaurant-new-sharer2')" class="btn btn-primary"> Continue </button>
      </div>
    </form>
  </div>
</div>
