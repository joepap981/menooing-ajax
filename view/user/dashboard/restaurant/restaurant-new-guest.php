<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<script>
  //popover
  $(function () {
    $('[data-toggle="popover"').popover()
  });

  $('.popover-dismiss').popover({
  trigger: 'focus'
});
</script>

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Hey Guest!</h3>
    <p> What is the name of your restaurant?</p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div class="form-group">
        <label for="user_mobile">Restaurant Name</label>
        <input name="mobile" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.name" class="form-control"  required>
      </div>

      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new')" class="btn btn-secondary"> Back </button>
        <button ng-click="registerRestaurant('/restaurant-new-guest2'); saveFile()" class="btn btn-primary"> Continue </button>
      </div>

    </form>
  </div>
</div>
