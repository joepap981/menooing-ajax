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
                <input type="text" class="form-control" id="restaurantAdd1"  placeholder="" text="Sushiyaa">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">
                <label for="restaurantAdd2"> Address 2: </label>
              </div>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="restaurantAdd2" placeholder="" >
              </div>
            </div>

            <div class="row">
              <div class="form-group row col">
                <div class="col-sm-4">
                  <label for="restaurantCity"> City: </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="restaurantCity"  placeholder="">
                </div>
              </div>

              <div class="form-group row col">
                <div class="col-sm-4">
                  <label for="restaurantState"> State: </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="restaurantState"  placeholder="" >
                </div>
              </div>


              <div class="form-group row col">
                <div class="col-sm-4">
                  <label for="restaurantZip"> Zipcode: </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="restaurantZip"  placeholder="" >
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">
                <label for="restaurantPhone"> Phone: </label>
              </div>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="restaurantPhone"  placeholder="" >
              </div>
            </div>
          </div>
          </form>
        </div>

        <div class="card restaurant-profile">
          <div class="card-header"> Restaurant Management </div>
          <div class="card-block container">

            <form>

              <div class="row">
                <div class="form-group row col">
                  <div class="col-sm-2">
                    <label for="restaurantCity"> Open  </label>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="restaurantOpenDay"  placeholder="">
                  </div>
                  <span> to </span>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="restaurantCloseDay"  placeholder="">
                  </div>

                  <div class="col-sm-1">
                    <input type="text" readonly class="form-control-plaintext" placeholder="">
                  </div>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="restaurantOpenDay"  placeholder="">
                  </div>
                  <span> to </span>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="restaurantCloseDay"  placeholder="">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="restaurantCuisine"> Restaurant Keyword </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="restaurantKeyword"  placeholder="" >
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



          <div class="card restaurant-profile">
            <div class="card-header"> Sharee Info </div>
            <div class="card-block container">

              <form>

                <div class="row">
                  <div class="form-group row col">
                    <div class="col-sm-2">
                      <label for="restaurantCity"> Open  </label>
                    </div>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="restaurantOpenDay"  placeholder="">
                    </div>
                    <span> to </span>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="restaurantCloseDay"  placeholder="">
                    </div>

                    <div class="col-sm-1">
                      <input type="text" readonly class="form-control-plaintext" placeholder="">
                    </div>

                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="restaurantOpenDay"  placeholder="">
                    </div>
                    <span> to </span>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="restaurantCloseDay"  placeholder="">
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-4">
                    <label for="restaurantCuisine"> Restaurant Keyword </label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="restaurantKeyword"  placeholder="" >
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
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
