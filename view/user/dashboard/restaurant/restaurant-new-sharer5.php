<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>

  <div ng-if="true">
    <div class="restaurant-text-title">
      <h3> Your restaurant has been created! </h3>
      <p> Your restaurant will not be visible to the public until the admin gives a confirmation.</p>
      <p> You can still add menus and edit your restaurant information.</p>
      <button class="btn btn-secondary" ng-click="redirect('/restaurant-list')"> Edit Restaurant </button>
      <button class="btn btn-primary" ng-click="redirect('/restaurant-list')"> Move to Restaurants </button>
    </div>
  </div>
</div>
