<link rel="stylesheet" href="css/user/restaurant/restaurant-profile.css">

<div>
  <img class="masthead-img" src="img/bg-masthead.jpg">
  <button class="top-left btn btn-primary" ng-click="redirect('/restaurant-list')">Go Back to Restaurant</div>
</div>

<div class="container mt-5" ng-controller= "restaurantProfileCtrl">
  <div id="restaurant-main-info" class="row">
    <div class="col-8">
      <div class="restaurant-header mb-5">
        <h5> HOST </h5>
        <h1> {{ restaurant.restaurant_name }} </h1>

        <div class="d-flex">
          <h4 class="p-2"> {{ restaurant.restaurant_locality}}, {{ restaurant.restaurant_administrative_area_level_1}} </h4>
          <i data-toggle="collapse" data-target="#collapseAddress" class="fa fa-edit p-3 edit-button"></i>
        </div>

        <div class="collapse" id="collapseAddress">
          <div class="card card-body collapse w-75">
            <p> Current Address: {{ restaurant.address }} </p>
            <div id="locationField">
              <input class="form-control" ng-controller= "googlePlaceCtrl" id="autocomplete" placeholder="Enter your address" ng-focus="geolocate()" type="text"></input>
            </div>
            <div class="btn-box mt-3">
              <button data-toggle= "collapse" data-target="#collapseAddress" class="btn secondary"> Cancel </button>
              <button ng-click= "updateAddress()" data-target="#collapseAddress" class="btn btn-primary"> Save Changes </button>
            </div>
          </div>
        </div>

      </div>
      <div class="restaurant-description">
        <p> This is the part wehre the description will be filled in.  This is the part wehre the description will be filled in.This is the part wehre the description will be filled in.This is the part wehre the description will be filled in.
        This is the part wehre the description will be filled in.This is the part wehre the description will be filled in.</p>

        <div class="d-flex flex-row-reverse">
          <i class="fa fa-edit p-3 edit-button" ng-click="toggleDescriptionBox()"></i>
        </div>
      </div>

      <div class="restaurant-description-input">
        <textarea class="form-control description-input"></textarea>
        <div class="btn-box mt-3 d-flex flex-row-reverse">
          <button class="btn btn-secondary"> Cancel </button>
          <button ng-click= "" class="btn btn-primary"> Save Changes </button>
        </div>
      </div>

      <hr>

      <div class="restaurant-equipment">
        <h5 class="mb-4"> Equipment </h5>
        <div class="row">
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p> Oven </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p> Oven </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p> Oven </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p> Oven </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="restaurant-facility">
        <h5 class="mb-4"> Facility  </h5>

        <div class="row">
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p class="card-text"> Oven </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p class="card-text"> Oven </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p class="card-text"> Oven </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="padding: 8px;">
            <div class="card">
              <div class="card-body icon-card">
                <p class="card-text"> Oven </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

    </div>

    <div id="right-side-card" class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"> Pricing </h5>
          <p class="card-subtitle"> $500 per month.

          <hr>
          <h5 class="card-title"> Available Hours </h5>

          <hr>

          <p> You restaurant is not discoverable by others yet. Go ahead and request to publish. </p>
          <button class="btn btn-primary d-flex justify-content-center"> Request to Publish </button>
        </div>
      </div>
    </div>
  </div>
</div>
