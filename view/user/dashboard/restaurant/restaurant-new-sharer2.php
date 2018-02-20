<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Share a little more about your restaurant. </h3>
    <p> Tell us what kind of food your make </p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div class="form-group row">
        <span class="col-label">Restaurant Cuisine</span>
        <select class="custom-select col-input" id="restaurantCuisine">
          <option selected>Choose...</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="form-group row">
        <span class="col-label">Restaurant Category</span>
        <select class="custom-select col-input" id="restaurantCategory">
          <option selected>Choose...</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>

      <div class="restaurant-text-title">
        <p> What are the operation hours? </p>
      </div>

      <div class="form-group row">
        <span class="col-label">Open Days</span>
        <div class="col-input">
          <select class="custom-select" id="openDay">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <span> to </span>
          <select class="custom-select" id="closeDay">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <span class="col-label">Open Hours</span>
        <div class="col-input">
          <select class="custom-select" id="openHour">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <span> to </span>
          <select class="custom-select" id="closeHour">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-label">
          <p>Image/Logo </p>
        </div>
        <div class="col-input">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMenu">Add Image</button>
        </div>
        <!-- Menu Add Modal -->
        <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="addMenu" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add a logo or image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <a href="#"><img class="menu-img" src="http://via.placeholder.com/300x200" alt=""></a>
                <div class="menu-img">
                  <a href="#"> Add image </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Add modal end-->
      </div>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharer')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharer3')" class="btn btn-primary"> Continue </button>
      </div>
    </form>
  </div>


</div>
