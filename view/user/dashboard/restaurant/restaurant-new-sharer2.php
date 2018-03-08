<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> We now need some info and documents on your restaurant. </h3>
    <p class="mb-4"> We need to know a few things about you, the owner! </p>
  </div>
  <div class="margin-auto">
    <div class="restaurant-information-form">
      <form name="restaurantRegistration">
        <div class="form-group row">
          <label class="col-label" for="owner_name">Name</label>
          <input type="text" class="form-control col-input" placeholder="" ng-model='restaurant.name' required>
        </div>
        <div class="form-group row">
          <label class="col-label" for="owner_phone">Mobile</label>
          <input type="text" class="form-control col-input" placeholder="" ng-model='restaurant.phone' required>
        </div>
        <div class="form-group row">
          <label>Food Mananger/Handler Certificate</label>
          <input id="restaurantAddHandlerCert" type="file" placeholder="" required>
        </div>

        <p class="text-center mt-4 mb-3 text-nowrap"> Now we need some document for your restaurant! </p>

        <div class="form-group row">
          <label>Certificate of Occupancy</label>
          <input id="restaurantAddCertOccupancy" type="file" placeholder="" required>
        </div>
      </form>
      <small class="text-nowrap"> Your documents will be reviewed by our admins before you can publish your restaurant.</small>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharer')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharer3')" class="btn btn-primary"> Continue </button>
      </div>
    </div>
  </div>


</div>
