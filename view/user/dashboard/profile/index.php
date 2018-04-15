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

    <div class="row" ng-if="session['user_id'] != null">
      <div class="col-md-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-9">

        <div class="content-box" ng-controller="userProfileCtrl">
          <!--User Profile Image -->
          <div class="card restaurant-profile">
            <div id="profile" class="card-header"> User Profile Image </div>
            <div class="card-block container">
              <div class= "row">
                <div class="col">
                  <div id="profile-image-container">
                    <img id="profile-image-preview" class="pointer" src="/noexec/square.jpg" alt="">
                  </div>
                </div>
                <div class="col">
                  <p> Upload a profile picture.</p>
                  <!-- hidden, linked to profile-image-preview -->
                  <input ng-show="null" id="profile-image-upload" type="file"></input>
                  <button class="btn btn-primary"> Save Image </button>
                </div>
              </div>
            </div>
          </div>
          <!--//user profile image end-->

          <!-- user basic information-->
          <div class="card restaurant-profile">
            <div class="card-header"> User Basic Information </div>
            <div class="card-block container">
              <div class="row">
                
              </div>


              <form>
                <!-- Restaurant hours dropdown-->
                <div class="form-group row">
                  <span class="col-label"> Restaurant Hours </span>
                  <div class="col-input">
                    <p ng-if ="checkDateHours() == true" data-toggle="collapse" data-target="#collapseOpen" class="pointer" id="restaurantOpen"> {{ restaurant.open_time }}</p>

                    <div class="collapse" id="collapseOpen">
                      <div class="card card-body collapse">
                        <div class="form-group row">
                          <span class="w-25">Open Days</span>
                          <div class="w-75">
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
                              <option value="Friday">Friday</option>
                              <option value="Saturday">Saturday</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <span class="w-25">Open Hours</span>
                          <div class="row w-75 shiftright">
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
                      </div>
                      <div class="btn-box">
                        <button data-toggle= "collapse" data-target="#collapseHours" class="btn secondary"> Cancel </button>
                        <button class="btn btn-primary" ng-click="updateOperationHours()"> Save Changes </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Restaurant category dropdown-->
                <div class="form-group row">
                  <span class="col-label"> Category </span>
                  <div>
                    <p data-toggle="collapse" data-target="#collapseCategory" class="pointer" id="restaurantAddress">{{ restaurant.restaurant_category }} </p>

                    <div class="collapse" id="collapseCategory">
                      <div class="card card-body collapse">
                        <select id="restaurant-type" class="restaurant-hours custom-select mr-sm-2" ng-model = "input.category">
                          <option value="Casual Dining" selected>Casual Dining</option>
                          <option value="Fine Dining">Fine Dining</option>
                          <option value="Fast Casual">Fast Casual</option>
                          <option value="Fast Food">Fast Food</option>
                        </select>
                        <div class="btn-box">
                          <button data-toggle= "collapse" data-target="#collapseCategory" class="btn secondary"> Cancel </button>
                          <button ng-click= "updateCategory()" class="btn btn-primary"> Save Changes </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <span class="col-label"> Cuisine </span>
                  <div>
                    <p data-toggle="collapse" data-target="#collapseCuisine" class="pointer" id="restaurantCuisine">{{ restaurant.restaurant_cuisine }} </p>

                    <div class="collapse" id="collapseCuisine">
                      <div class="card card-body collapse">
                        <select id="restaurant-type" ng-model = "input.cuisine" class="restaurant-hours custom-select mr-sm-2">
                          <option value="American" selected>American</option>
                          <option value="British">British</option>
                          <option value="Caribbean">Caribbean</option>
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
                        <div class="btn-box">
                          <button data-toggle= "collapse" data-target="#collapseCuisine" class="btn secondary"> Cancel </button>
                          <button ng-click= "updateCuisine()" class="btn btn-primary"> Save Changes </button>
                        </div>
                      </div>
                    </div>
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" ng-click = "initCropper()" data-target="#addMenu">Add Image</button>
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
                        <div class=".image-container row align-items-center justify-content-center">
                          <img id="image-holder" src="/noexec/byung1.jpg" alt="">
                        </div>
                        <input id="image-input" type="file" class ="menu-img mt-2" image-input ="restaurant_image"></input>
                        <div class="btn-box mt-4 pull-right">
                          <button type="button" class="btn btn-secondary">Cancel</button>
                          <button type="button" class="btn btn-primary" ng-click="uploadImage()">Save Image</button>
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
      </div>
    </div>
  </div>
</div>
