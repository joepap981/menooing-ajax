<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Owner and Restaurant Information </h3>
    <p class="mb-4"> We need some information and documents for confirmation. </p>
  </div>
  <div class="margin-auto">
    <div class="restaurant-information-form">
      <form name="restaurantRegistration">
        <div class="form-group row">
          <label class="col-label" for="owner_phone">Owner Mobile #</label>
          <input type="text" class="form-control col-input" placeholder="" ng-model='user.phone' required>
        </div>
        <div class="form-group row">
          <label>Food Mananger/Handler Certificate</label>
          <input id="restaurantAddHandlerCert" type="file" file-input ="user_cert_img_ref" required/>
        </div>

        <p class="text-center mt-4 mb-3 text-nowrap"> Please provide legal documents of your restaurant. </p>

        <div class="form-group row">
          <label>Certificate of Occupancy</label>
          <input id="restaurantAddCertOccupancy" type="file" file-input ="restaurant_cert"  required>
        </div>
      </form>
      <small class="text-nowrap"> These documents are required for your restaurant to be published to the public.</small>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-host')" class="btn btn-secondary"> Back </button>
        <button ng-click="registerRestaurant('/restaurant-new-host3'); saveFile()" class="btn btn-primary"> Continue </button>
      </div>
    </div>
  </div>


</div>
