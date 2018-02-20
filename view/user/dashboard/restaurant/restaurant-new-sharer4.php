<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Add a logo or image to represent your restaurant  </h3>
    <small> You can skip this step and add an image later! </small>
  </div>
  <div class="margin-auto">
    <div class="restaurant-information-form">
      <div id="restaurantAdd" class="card">
         <img class="card-img-top" src="http://via.placeholder.com/250x150" alt="Card image cap">
         <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>

      <div id="restaurantAdd" class="btn-toolbar">
        <button ng-click="redirect('/restaurant-new-sharer3')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharer5')" class="btn btn-primary"> Continue </button>
      </div>
    </div>
  </div>


</div>
