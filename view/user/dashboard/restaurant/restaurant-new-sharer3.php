<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Add a logo or image to represent your restaurant  </h3>
    <small> You can skip this step and add an image later! </small>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div id="restaurantAdd" class="card">
         <a href="#"><img class="card-img-top" src="http://via.placeholder.com/250x150" alt="Card image cap"></a>
      </div>
      <div class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharer2')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharer4')" class="btn btn-primary"> Continue/Skip </button>
      </div>
    </form>
  </div>


</div>
