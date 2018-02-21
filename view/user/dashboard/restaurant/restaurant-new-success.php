<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title mt-5">
    <h3> Thanks! Your registration request has been sent to our team! </h3>
    <p> After review, an email will be sent to you to finalize your restaurant registration. Until then, your restaurant will not be public to users.</p>
    <p> You can still add menus and edit your restaurant information.</p>

    <button class="btn btn-secondary" ng-click="redirect('/restaurant-list')"> Edit Restaurant </button>
    <button class="btn btn-primary" ng-click="redirect('/restaurant-list')"> Move to Restaurants </button>

  </div>
</div>
