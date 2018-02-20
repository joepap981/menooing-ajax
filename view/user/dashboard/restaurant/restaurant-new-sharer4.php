<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Now, we need some information for you to become a Sharer!  </h3>
    <p> We need to know a few things about you, the owner! </p>
  </div>
  <div class="margin-auto">
    <div class="restaurant-information-form">
      <form name="restaurantRegistration" class="restaurant-information-form">
        <div class="form-group row">
          <label class="col-label" for="owner_name">Name</label>
          <input type="text" class="form-control col-input" placeholder="" required>
        </div>
        <div class="form-group row">
          <label class="col-label" for="owner_phone">Mobile</label>
          <input type="text" class="form-control col-input" placeholder="" required>
        </div>
        <div class="form-group row">
          <label>Food Mananger/Handler Certificate</label>
          <input id="restaurantAddFile" type="file" placeholder="" required>
        </div>

        <p class="text-center mt-5"> We need some documents for your restaurant. </p>

        <div class="form-group row">
          <label>Certificate of Occupancy</label>
          <input id="restaurantAddFile" type="file" placeholder="" required>
        </div>

        <div id="restaurantAdd" class="btn-toolbar mt-3">
          <button ng-click="redirect('/restaurant-new-sharer')" class="btn btn-secondary"> Back </button>
          <button ng-click="saveAndContinue('/restaurant-new-sharer3')" class="btn btn-primary"> Continue </button>
        </div>
      </form>
    </div>
  </div>


</div>
