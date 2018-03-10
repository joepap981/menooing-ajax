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
        <select class="custom-select col-input" id="restaurantCuisine" ng-model="restaurant.cuisine">
          <option value="American" selected>American</option>
          <option value="British">British</option>
          <option value=">Caribbean">Caribbean</option>
          <option value="Chinese">Chinese</option>
          <option value="French">French</option>
          <option value="Greek">Greek</option>
          <option value="Indian">Indian</option>
          <option value="Italian">Italian</option>
          <option value="Japanese">Japanese</option>
          <option value="Mediterranean">Mediterranean</option>
          <option value="Mexican">Mexican</option>
          <option value="Moroccan">Moroccan</option>
          <option value="Spanish">Spanish</option>
          <option value="Thai">Thai</option>
          <option value="Turkish">Turkish</option>
          <option value="Korean">Korean</option>

        </select>
      </div>
      <div class="form-group row">
        <span class="col-label">Restaurant Category</span>
        <select class="custom-select col-input" id="restaurantCategory" ng-model="restaurant.category">
          <option value="Casual Dining" selected>Casual Dining</option>
          <option value="Fine Dining">Fine Dining</option>
          <option value="Fast Casual">Fast Casual</option>
          <option value="Fast Food">Fast Food</option>
        </select>
      </div>

      <div class="restaurant-text-title">
        <p> What are the operation hours? </p>
      </div>

      <div class="form-group row">
        <span class="col-label">Open Days</span>
        <div class="col-input">
          <select class="custom-select" id="openDay" ng-model='restaurant.open_day'>
            <option value="Sunday" selected>Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value=">Friday">Friday</option>
            <option value=">Saturday">Saturday</option>
          </select>
          <span> to </span>
          <select class="custom-select" id="closeDay" ng-model='restaurant.close_day'>
            <option value="Sunday" selected>Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value=">Friday">Friday</option>
            <option value=">Saturday">Saturday</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <span class="col-label">Open Hours</span>
        <div class="row col-input shiftright">
          <div class="row half">
            <select class="custom-select col timepick" id="openHour" ng-model = "operationHours.openHour">
              <option value="00" selected>00</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <span> : </span>
            <select class="custom-select col timepick" id="openMin" ng-model = "operationHours.openMin">
              <option value="00" selected>00</option>
              <option value="30">30</option>
            </select>
            <select class="custom-select col timepick" id="open" ng-model = "operationHours.open">
              <option value="am" selected>am</option>
              <option value="pm">pm</option>
            </select>
          </div>
          <div class="row half">
            <select class="custom-select col timepick" id="closeHour" ng-model = "operationHours.closeHour">
              <option value="00" selected>00</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <span>:</span>
            <select class="custom-select col timepick" id="closeHour" ng-model = "operationHours.closeMin">
              <option value="00" selected>00</option>
              <option value="30">30</option>
            </select>
            <select class="custom-select col timepick" id="close" ng-model = "operationHours.close">
              <option value="am" selected>am</option>
              <option value="pm">pm</option>
            </select>
          </div>
        </div>
      </div>
      <small class="text-nowrap text-center"> You can skip this step for now and edit them later.</small>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharer2')" class="btn btn-secondary"> Back </button>
        <button ng-click="buildTime(); registerRestaurant('restaurant-new-sharer4')" class="btn btn-primary"> Continue </button>
      </div>
    </form>
  </div>


</div>
