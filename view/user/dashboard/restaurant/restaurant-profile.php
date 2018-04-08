<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <no-session-view></no-session-view>
</div>

<!-- show content when user session is in progress -->
<div id="session" ng-if="session['user_id'] != null" >
  <div class="container">
    <restaurant-subnav></restaurant-subnav>
    <div class="row" ng-if="session['user_id'] != null">
      <div class="col-md-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-9">

        <div class="content-box" ng-controller="restaurantProfileCtrl">
          <!--Restaurant Basic information -->
          <div class="card restaurant-profile">
            <div id="profile" class="card-header"> Location Info </div>
            <div class="card-block container">
              <form>
                <div class=" form-group row" >
                  <span class="col-label" for="restaurantName"> Restaurant Name: </span>
                  <p class="col-input" id="restaurantName" ng-model ="restaurant.restaurant_name"> {{ restaurant.restaurant_name }} </p>
                </div>

                <div class=" form-group row" >
                  <span class="col-label" for="restaurantAddress"> Address: </span>
                  <div class="col-input">
                    <p data-toggle="collapse" data-target="#collapseAddress" class="pointer" id="restaurantAddress" ng-model ="restaurant.address">{{ restaurant.address }} </p>
                    <div class="collapse" id="collapseAddress">
                      <div class="card card-body collapse">
                        <div id="locationField">
                          <input ng-controller= "googlePlaceCtrl" id="autocomplete" placeholder="Enter your address" ng-focus="geolocate()" type="text"></input>
                        </div>
                        <div class="btn-box">
                          <button data-toggle= "collapse" data-target="#collapseAddress" class="btn secondary"> Cancel </button>
                          <button ng-click= "updateAddress()" class="btn btn-primary"> Save Changes </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <span class="col-label" for="restaurantPhone"> Phone: </span>
                  <div class="col-input">
                    <p ng-if = "restaurant.restaurant_phone != null" data-toggle="collapse" data-target="#collapsePhone" class="pointer" id="restaurantPhone" ng-model ="restaurant.restaurant_phone"> {{ restaurant.restaurant_phone }} </p>
                    <a href='#' ng-if = "restaurant.restaurant_phone == null" data-toggle="collapse" data-target="#collapsePhone"> Click to add number </a>
                    <div class="collapse" id="collapsePhone">
                      <div class="card card-body collapse">
                        <input type="text" class="form-control" id="restaurantPhone" ng-model ="input.phone">
                        <div class="btn-box">
                          <button data-toggle= "collapse" data-target="#collapsePhone" class="btn secondary"> Cancel </button>
                          <button class="btn btn-primary" ng-click= "updatePhone()"> Save Changes </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <span class="col-label" for="restaurantPhone"> Certificate of Occupancy </span>
                  <span ng-if="restaurant.restaurant_cert == null"> Upload Certificate </span>
                  <div>
                    <a href="" ng-click="downloadRestaurantCert()" ng-if="restaurant.restaurant_cert != null"> {{ restaurant.cert_name}} </a>
                    <span class="ml-5 pointer" data-toggle="collapse" data-target="#collapseCert"> Change file </span>
                    <div class="collapse" id="collapseCert">
                      <div class="card card-body collapse">
                        <input type="file" class="col-input" id="coFile" ng-model ="restaurant.co">
                        <div class="btn-box">
                          <button data-toggle= "collapse" data-target="#collapseCert" class="btn secondary"> Cancel </button>
                          <button class="btn btn-primary"> Upload </button>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </form>
            </div>
          </div>
          <!--//restaurant basic information end-->

          <!-- Restaurant management information-->
          <div class="card restaurant-profile">
            <div id="profile" class="card-header"> Restaurant Management </div>
            <div class="card-block container">
              <form>
                <!-- Restaurant hours dropdown-->
                <div class="form-group row">
                  <span class="col-label"> Restaurant Hours </span>
                  <div class="col-input">
                    <p ng-if = " ">

                    <div class="collapse" id="collapseHours">
                      <div class="card card-body collapse">
                        <input type="file" class="col-input" id="coFile" ng-model ="restaurant.co">
                        <div class="btn-box">
                          <button data-toggle= "collapse" data-target="#collapseHours" class="btn secondary"> Cancel </button>
                          <button class="btn btn-primary"> Upload </button>
                        </div>
                      </div>
                    </div>

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
          </div>
          <!--//Restaurant management information end-->
        </div>
        <!--//content-box end-->
        <!-- Save changes button-->
        <button id="restaurant-save-changes" class="btn btn-primary"> Save Changes </button>
      </div>
    </div>
  </div>
</div>
