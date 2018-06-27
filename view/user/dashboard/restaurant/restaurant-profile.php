<link rel="stylesheet" href="css/user/restaurant/restaurant-profile.css">

<div>
  <img class="masthead-img" src="img/bg-masthead.jpg">
  <button class="top-left btn btn-primary" ng-click="redirect('/restaurant-list')">Go Back to Restaurant</div>
</div>

<div class="container mt-5" ng-controller= "restaurantProfileCtrl">
  <div id="restaurant-main-info" class="row">
    <div class="col-8">
      <div class="restaurant-header">
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
      <div class="restaurant-description  white-space-pre" ng-show="descriptionBoxSwitch == -1">
        <p> {{ restaurant.restaurant_description }}</p>

        <div class="d-flex flex-row-reverse">
          <i class="fa fa-edit p-3 edit-button" ng-click="toggleDescriptionBox()"></i>
        </div>
      </div>

      <div class="restaurant-description-input white-space-pre" ng-show="descriptionBoxSwitch == 1">
        <textarea class="form-control description-input" ng-model="restaurant.restaurant_description"></textarea>
        <div class="btn-box d-flex flex-row-reverse">
          <button class="btn btn-secondary" ng-click="toggleDescriptionBox()"> Cancel </button>
          <button ng-click= "updateDescription()" class="btn btn-primary"> Save Changes </button>
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

      <div class="mt-3 d-flex justify-content-center">
        <p class="pointer"> Show more </p>
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

      <div class="mt-3 d-flex justify-content-center">
        <p class="pointer"> Show more </p>
      </div>

      <hr>

    </div>

    <div id="right-side-card" class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"> Pricing </h5>
          <div class="d-flex restaurant-price" ng-show="priceBoxSwitch == -1">
            <p class="card-subtitle p-2"> ${{ restaurant.restaurant_fee}} per {{ restaurant.restaurant_fee_standard}}. </p>
            <i class="fa fa-edit p-2 edit-button" ng-click="togglePriceBox()"></i>
          </div>

          <div class="restaurant-price-edit" ng-show="priceBoxSwitch == 1">
            <div class="d-flex">
              <input class="form-control w-50 mr-2" ng-model = "restaurant.restaurant_fee"> </input>
              <select class="custom-select" ng-model = "restaurant.restaurant_fee_standard">
                <option value="hour"> Hour </option>
                <option value="day"> Day</option>
                <option value="month"> Month </option>
              </select>
            </div>

            <div class="btn-box d-flex mt-3">
              <button class="btn btn-secondary" ng-click="togglePriceBox()"> Cancel </button>
              <button ng-click= "updatePrice()" class="btn btn-primary"> Save Changes </button>
            </div>

          </div>

          <hr>
          <h5 class="card-title"> Available Hours </h5>

          <button class="btn btn-light w-100" data-toggle="modal" data-target="#timeModal"> + </button>

          <!-- Modal -->
          <div class="modal fade" id="timeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="timeModalLabel">Add Available Time</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <select class="custom-select day-picker" ng-model = "input.day">
                    <option value="Monday"> Monday </option>
                    <option value="Tuesday"> Tuesday</option>
                    <option value="Wednesday"> Wednesday </option>
                    <option value="Thursday"> Thursday </option>
                    <option value="Friday"> Friday </option>
                    <option value="Saturday"> Saturday </option>
                    <option value="Sunday"> Sunday </option>
                  </select>

                  <div class="d-flex">
                    <div uib-timepicker class="p-2" ng-model="beginTime" ng-change="changed()" hour-step="hstep" minute-step="mstep" show-meridian="true" show-spinners ="false"></div>
                    <div>
                      <i class="glyphicon glyphicon-chevron-up addbutton" ng-click="addMinBegin()"></i> <i class="glyphicon glyphicon-chevron-down minbutton" ng-click="lessMinBegin()"></i>
                    </div>
                    <h5 class="p-3"> to </h5>
                    <div uib-timepicker class="p-2" ng-model="endTime" ng-change="changed()" hour-step="hstep" minute-step="mstep" show-meridian="true" show-spinners ="false" ></div>
                    <div>
                      <i class="glyphicon glyphicon-chevron-up addbutton" ng-click="addMinEnd()"></i> <i class="glyphicon glyphicon-chevron-down minbutton" ng-click="lessMinEnd()"></i>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" ng-click="addAvailableTime()">Add Available Time</button>
                </div>
              </div>
            </div>
          </div>


          <hr>

          <p> You restaurant is not discoverable by others yet. Go ahead and request to publish. </p>
          <button class="btn btn-primary d-flex justify-content-center"> Request to Publish </button>
        </div>
      </div>
    </div>
  </div>
</div>
