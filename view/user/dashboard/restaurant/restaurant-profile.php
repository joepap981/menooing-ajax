<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <no-session-view></no-session-view>
</div>

<!-- show content when user session is in progress -->
<!-- show content when user session is in progress -->
<div id="session" ng-if="session['user_id'] != null" >
  <div class="container">
    <restaurant-subnav></restaurant-subnav>
    <div class="row" ng-if="session['user_id'] != null">
      <div class="col-md-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-9">

        <div class="content-box" ng-controller="UserDashboardController">
          <!--Restaurant image-->
          <div class="card restaurant-profile">
            <div class="card-header"> Image </div>
            <div class="card-block container">
              <a href="#"><img id="restaurant-image" src="http://via.placeholder.com/700x300" alt=""></a>
              <a href="#"> Add image </a>
            </div>
          </div>

          <!--Restaurant Basic information -->
          <div class="card restaurant-profile">
            <div class="card-header"> Location Info </div>
            <div class="card-block container">
              <form>
                <div class=" form-group row" >
                  <span class="col-label" for="restaurantName"> Restaurant Name: </span>
                  <input type="text" readonly class="form-control-plaintext col-input" id="restaurantName" ng-model ="restaurant.restaurant_name" value="{{ restaurant.restaurant_name }}">
                </div>

                <div class="form-group row">
                  <span class="col-label" for="restaurantAdd1"> Address 1 </span>
                  <input class="form-control col-input" type="text" id="restaurantAdd1"  ng-model ="restaurant.restaurant_address1">
                </div>

                <div class="form-group row">
                  <span class="col-label" for="restaurantAdd2"> Address 2 </span>
                  <input type="text" class="form-control col-input" id="restaurantAdd2"  ng-model ="restaurant.restaurant_address2">
                </div>

                <div class="form-group row">
                  <span id="city-label" for="restaurantCity"> City </span>
                  <input id="city-input" type="text" class="form-control" id="restaurantCity"  ng-model ="restaurant.restaurant_city">
                  <span id="state-label" for="restaurantState"> State </span>
                  <input id="state-input" type="text" class="form-control" id="restaurantState" ng-model ="restaurant.restaurant_state">
                  <span id="zip-label" for="restaurantZip"> Zipcode </span>
                  <input id="zip-input" type="text" class="form-control" id="restaurantZip" ng-model ="restaurant.restaurant_zip">
                </div>

                <div class="form-group row">
                  <span class="col-label" for="restaurantPhone"> Phone: </span>
                  <input type="text" class="form-control col-input" id="restaurantPhone"  ng-model ="restaurant.restaurant_phone">
                </div>

                <div class="form-group row">
                  <span class="col-label" for="restaurantPhone"> CO (Certificate of Occupancy) </span>
                  <input type="file" class="form-control col-input" id="coFile" ng-model ="restaurant.co">
                </div>
              </form>
            </div>
          </div>
          <!--//restaurant basic information end-->

          <!-- Restaurant management information-->
          <div class="card restaurant-profile">
            <div class="card-header"> Restaurant Management </div>
            <div class="card-block container">
              <form>
                <!-- Restaurant hours dropdown-->
                <div class="form-group row">
                  <span class="col-label"> Restaurant Hours </span>
                  <div class="col-input">
                    <select class="restaurant-hours custom-select mr-sm-2">
                      <option selected>Day</option>
                      <option value="1">Monday</option>
                      <option value="2">Tuesday</option>
                      <option value="3">Wednesday</option>
                      <option value="4">Thursday</option>
                      <option value="5">Friday</option>
                      <option value="6">Saturday</option>
                      <option value="7">Sunday</option>
                    </select>
                    <select class="restaurant-hours custom-select mr-sm-2">
                      <option selected>Day</option>
                      <option value="1">Monday</option>
                      <option value="2">Tuesday</option>
                      <option value="3">Wednesday</option>
                      <option value="4">Thursday</option>
                      <option value="5">Friday</option>
                      <option value="6">Saturday</option>
                      <option value="7">Sunday</option>
                    </select>
                    <select class="restaurant-hours custom-select mr-sm-2">
                      <option selected>Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <select class="restaurant-hours custom-select mr-sm-2">
                      <option selected>Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>

                <!--Restaurant category dropdown-->
                <div class="form-group row">
                  <div class="col-half">
                    <span class="col-label"> Category </span>
                    <select id="restaurant-type" class="restaurant-hours custom-select mr-sm-2">
                      <option selected>Day</option>
                    </select>
                  </div>
                  <div class="col-half">
                    <span class="col-label"> Cuisine </span>
                    <select id="restaurant-type" class="restaurant-hours custom-select mr-sm-2">
                      <option selected>Day</option>
                    </select>
                  </div>
                </div>

                <!--Restaurant Price range-->
                <div class="form-group row">
                  <span class="col-label" for="restaurantPrice"> Price Range </span>
                  <input type="text" readonly class="form-control-plaintext col-input" id="restaurantPrice"  placeholder="" >
                </div>
              </form>
            </div>
          </div>
          <!--//Restaurant management information end-->
          <!-- Save changes button-->
          <button id="restaurant-save-changes" class="btn btn-primary"> Save Changes </button>
        </div>
        <!--//content-box end-->
      </div>
    </div>
  </div>
</div>
