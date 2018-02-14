<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null" ></no-session-view>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-controller="restaurantProfileCtrl" ng-model="restaurant">
    <div class="home-content">

      <div>
        <div class="btn clear-btn submit " ng-click="redirect('/restaurant-list')"><img id="circular-button" src="/img/left-arrow-circular-button.png"> Back</div>
        <div class="btn clear-btn"> Profile </div>
        <div class="btn clear-btn" ng-click="redirect('/restaurant-menu')"> Menu </div>
      </div>

      <div class="card restaurant-profile">
        <div class="card-header"> Basic Info </div>
        <div class="card-block container">
          <a href="#"><img id="restaurant-image" src="http://via.placeholder.com/700x300" alt=""></a>
          <a href="#"> Add image </a>
        </div>
      </div>


      <div class="card restaurant-profile">
        <div class="card-header"> Basic Info </div>
        <div class="card-block container">

          <form>
            <div class="form-group row" >
              <div class="col-sm-3">
                <label for="restaurantName"> Restaurant Name: </label>
              </div>
              <div class="col-sm-9">
                <input type="text" readonly class="form-control-plaintext" id="restaurantName" ng-model ="restaurant.restaurant_name" value="{{ restaurant.restaurant_name }}">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">
                <label for="restaurantAdd1"> Address 1: </label>
              </div>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="restaurantAdd1"  ng-model ="restaurant.restaurant_address1" text="Sushiyaa">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">
                <label for="restaurantAdd2"> Address 2: </label>
              </div>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="restaurantAdd2"  ng-model ="restaurant.restaurant_address2">
              </div>
            </div>

            <div class="row">
              <div class="form-group row col-md-6">
                <div class="col-sm-4">
                  <label for="restaurantCity"> City: </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="restaurantCity"  ng-model ="restaurant.restaurant_city">
                </div>
              </div>

              <div class="form-group row col-md-3">
                <div class="col-sm-4">
                  <label for="restaurantState"> State: </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="restaurantState" ng-model ="restaurant.restaurant_state" >
                </div>
              </div>


              <div class="form-group row col-md-4">
                <div class="col-sm-5">
                  <label for="restaurantZip"> Zipcode: </label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="restaurantZip" ng-model ="restaurant.restaurant_zip" >
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">
                <label for="restaurantPhone"> Phone: </label>
              </div>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="restaurantPhone"  ng-model ="restaurant.restaurant_phone" >
              </div>
            </div>
          </div>

          </form>
        </div>

        <div class="card restaurant-profile">
          <div class="card-header"> Restaurant Management </div>
          <div class="card-block container">
            <form>


                <div class="form-group row col">
                  <div class="form-row align-items-center">
                    <div class="col-sm-3">
                      <label> Restaurant Hours </label>
                    </div>
                    <div class="col-auto my-1">
                      <select class="restaurant-hours custom-select mr-sm-2">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="col-auto my-1">
                      <select class="restaurant-hours custom-select mr-sm-2">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="col-auto my-1">
                      <select class="restaurant-hours custom-select mr-sm-2">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="col-auto my-1">
                      <select class="restaurant-hours custom-select mr-sm-2">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>

                </div>
              </div>


              <div class="form-group row">
                <div class="col-sm-5">
                  <label for="restaurantCuisine"> Restaurant Keyword </label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="restaurantKeyword" ng-model ="restaurant.restaurant_cuisine" >
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="restaurantPrice"> Price Range </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" id="restaurantPrice"  placeholder="" >
                </div>
              </div>

            </div>

            </form>
          </div>
          <button id="restaurant-save-changes" class="btn btn-primary"> Save Changes </button>
        </div>
      </div>
    </div>
  </div>
</div>
