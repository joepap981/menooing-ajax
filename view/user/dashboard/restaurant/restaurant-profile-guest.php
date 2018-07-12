<link rel="stylesheet" href="css/user/restaurant/restaurant-profile.css">

<div>
  <img class="masthead-img" src="img/bg-masthead.jpg">
</div>

<div class="container mt-5" ng-controller= "restaurantProfileCtrl">
  <div id="restaurant-main-info" class="row">
    <div class="col-8">
      <div class="restaurant-header">
        <h5> HOST </h5>
        <h1> {{ restaurant.restaurant_name }} </h1>

        <h4 class="p-2"> {{ restaurant.restaurant_locality}}, {{ restaurant.restaurant_administrative_area_level_1}} </h4>


        <div class="collapse" id="collapseAddress">
          <div class="card card-body collapse w-75">
            <p> Current Address: {{ restaurant.address }} </p>
            <div id="locationField">
              <input class="form-control" ng-controller= "googlePlaceCtrl" id="autocomplete" placeholder="Enter your address" ng-focus="geolocate()" type="text"></input>
            </div>
            <div class="btn-box mt-3">
              <button data-toggle= "collapse" data-target="#collapseAddress" class="btn secondary btn-sm"> Cancel </button>
              <button ng-click= "updateAddress()" data-target="#collapseAddress" class="btn btn-primary btn-sm"> Save Changes </button>
            </div>
          </div>
        </div>
      </div>

      <div class="restaurant-description white-space-pre">
        <p> {{ restaurant.restaurant_description }}</p>
      </div>

      <hr>

      <!-- Restaurant Equipment -->

      <div class="restaurant-equipment">
        <h5 class="mb-4"> Equipment </h5>
        <div class="row">
          <div ng-repeat="item in equipmentList" class="col-3">
            <button class="btn btn-light equipment-button" ng-click="setEquipmentEdit(item.equipment_id)" data-toggle="modal" data-target="#equipmentDetailModal"> {{ item.equipment_name }} </button>
          </div>
        </div>
      </div>


      <!-- Equipment Details Modal -->
      <div class="modal fade" id="equipmentDetailModal" tabindex="-1" role="dialog" aria-labelledby="equipmentDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="equipmentDetailModalLabel">Equipment Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <label> Equipment </label>
              <input class="form-control" ng-model="editEquipment.equipment_name" readonly> </input>
              <label> Description </label>
              <textarea class="form-control" style="height: 200px;" ng-model="editEquipment.equipment_description" readonly> </textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Restaurant Facility -->

      <hr>
      <div class="restaurant-facility">
        <h5 class="mb-4"> Facility </h5>
        <div class="row">
          <div ng-repeat="item in facilityList" class="col-3">
            <button class="btn btn-light equipment-button" ng-click="setFacilityEdit(item.facility_id)" data-toggle="modal" data-target="#facilityDetailModal"> {{ item.facility_name }} </button>
          </div>
        </div>
      </div>


      <!-- Facilty Detail Modal -->
      <div class="modal fade" id="facilityDetailModal" tabindex="-1" role="dialog" aria-labelledby="facilityDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="facilityDetailModalLabel">Facility Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <label> Facility </label>
              <input class="form-control" ng-model="editFacility.facility_name" readonly> </input>
              <label> Description </label>
              <textarea class="form-control" style="height: 200px;" ng-model="editFacility.facility_description" readonly> </textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right side card -->

    <div class="col-4">

      <div class ="card mb-3">
        <div class="card-body text-center">
          <p> Interested in renting out this kitchen? </p>
          <div class="text-center">
            <button class="btn btn-primary" ng-click="redirectToRequest()"> Send Request </button>
          </div>
        </div>
      </div>

      <!-- Price and Available Time Card-->
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"> Pricing </h5>
          <div class="d-flex restaurant-price">
            <p class="card-subtitle p-2"> ${{ restaurant.restaurant_fee}} per {{ restaurant.restaurant_fee_standard}}. </p>
          </div>

          <hr>
          <h5 class="card-title"> Available Hours </h5>

          <!-- available time cards -->
          <div id="available-list">
            <div ng-repeat="item in availableTime">
              <div class="d-flex">
                <button class="btn btn-light w-100 mt-1"> {{item.available_day }}, {{item.available_begin}} to {{ item.available_end }} </button>
              </div>
            </div>
          </div>
          <hr>
        </div>
      </div>

    </div>

  </div>
</div>
