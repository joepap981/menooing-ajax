<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Share a little more about your restaurant. </h3>
    <p> Tell us what kind of food you make. </p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div class="form-group row">
        <span class="col-label">Restaurant Cuisine</span>
        <select class="custom-select col-input" id="restaurantCuisine">
          <option selected>Choose...</option>
          <option value="1">American</option>
          <option value="2">British</option>
          <option value="3">Caribbean</option>
          <option value="4">Chinese</option>
          <option value="5">French</option>
          <option value="6">Greek</option>
          <option value="7">Indian</option>
          <option value="8">Italian</option>
          <option value="9">Japanese</option>
          <option value="10">Mediterranean</option>
          <option value="11">Mexican</option>
          <option value="12">Moroccan</option>
          <option value="13">Spanish</option>
          <option value="14">Thai</option>
          <option value="15">Turkish</option>
          <option value="16">Korean</option>

        </select>
      </div>
      <div class="form-group row">
        <span class="col-label">Restaurant Category</span>
        <select class="custom-select col-input" id="restaurantCategory">
          <option selected>Choose...</option>
          <option value="1">Casual Dining</option>
          <option value="2">Fine Dining</option>
          <option value="3">Fast Casual</option>
          <option value="4">Fast Food</option>
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
            <option value="1">Sunday</option>
            <option value="2">Monday</option>
            <option value="3">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="3">Thursday</option>
            <option value="3">Friday</option>
            <option value="3">Saturday</option>
          </select>
          <span> to </span>
          <select class="custom-select" id="closeDay">
            <option selected>Choose...</option>
            <option value="1">Sunday</option>
            <option value="2">Monday</option>
            <option value="3">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="3">Thursday</option>
            <option value="3">Friday</option>
            <option value="3">Saturday</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <span class="col-label">Open Hours</span>
        <div class="row col-input shiftright">
          <div class="row half">
            <select class="custom-select col timepick" id="openHour">
              <option value="1" selected>00</option>
              <option value="2">01</option>
              <option value="3">Three</option>
            </select>
            <span> : </span>
            <select class="custom-select col timepick" id="openMin">
              <option value="1" selected>00</option>
              <option value="2">30</option>
            </select>
            <select class="custom-select col timepick" id="open">
              <option value="1" selected>am</option>
              <option value="2">pm</option>
            </select>
          </div>
          <div class="row half">
            <select class="custom-select col timepick" id="closeHour">
              <option value="1" selected>00</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <span>:</span>
            <select class="custom-select col timepick" id="closeHour">
              <option value="1" selected>00</option>
              <option value="2">30</option>
            </select>
            <select class="custom-select col timepick" id="close">
              <option value="1" selected>am</option>
              <option value="2">pm</option>
            </select>
          </div>
        </div>
      </div>
      <small class="text-nowrap text-center"> You can skip this step for now and edit them later.</small>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharer2')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharer4')" class="btn btn-primary"> Continue </button>
      </div>
    </form>
  </div>


</div>
