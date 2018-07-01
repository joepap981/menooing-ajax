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
          <button data-toggle="collapse" data-target="#collapseAddress" class="btn btn-primary btn-sm ml-auto h-25"> Edit Address</button>
        </div>

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
      <div class="restaurant-description  white-space-pre" ng-show="descriptionBoxSwitch == -1">
        <p> {{ restaurant.restaurant_description }}</p>

        <div class="d-flex flex-row-reverse">
          <button class="btn btn-primary btn-sm" ng-click="toggleDescriptionBox()">Edit Description </button>
        </div>
      </div>

      <div class="restaurant-description-input white-space-pre" ng-show="descriptionBoxSwitch == 1">
        <textarea class="form-control description-input" ng-model="restaurant.restaurant_description"></textarea>
        <div class="btn-box d-flex flex-row-reverse">
          <button class="btn btn-secondary btn-sm" ng-click="toggleDescriptionBox()"> Cancel </button>
          <button ng-click= "updateDescription()" class="btn btn-primary btn-sm"> Save Changes </button>
        </div>
      </div>

      <hr>

      <!-- Restaurant Equipment -->

      <div class="restaurant-equipment">
        <h5 class="mb-4"> Equipment </h5>
        <div class="row">
          <div class="col-3">
            <button class="btn btn-light equipment-button" data-toggle="modal" data-target="#equipmentAddModal"> + </button>
          </div>

          <div ng-repeat="item in equipmentList" class="col-3">
            <button class="btn btn-light equipment-button" ng-click="setEquipmentEdit(item.equipment_id)" data-toggle="modal" data-target="#equipmentEditModal"> {{ item.equipment_name }} </button>
          </div>
        </div>
      </div>



      <!-- Equipment Add Modal -->
      <div class="modal fade" id="equipmentAddModal" tabindex="-1" role="dialog" aria-labelledby="equipmentAddModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="equipmentAddModalLabel">Add Equipment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <label> Equipment </label>
              <input class="form-control" ng-model="input.equipment_name"> </input>
              <label> Description </label>
              <textarea class="form-control" style="height: 200px;" ng-model="input.equipment_description"> </textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" ng-click="addRestaurantEquipment()">Add Equipment</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Equipment Edit Modal -->
      <div class="modal fade" id="equipmentEditModal" tabindex="-1" role="dialog" aria-labelledby="equipmentEditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="equipmentEditModalLabel">Edit Equipment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <label> Equipment </label>
              <input class="form-control" ng-model="editEquipment.equipment_name"> </input>
              <label> Description </label>
              <textarea class="form-control" style="height: 200px;" ng-model="editEquipment.equipment_description"> </textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="deleteEquipment()">Delete Equipment</button>
              <button type="button" class="btn btn-primary" ng-click="saveEquipmentChanges()"> Save Changes </button>
            </div>
          </div>
        </div>
      </div>


      <!-- Restaurant Facility -->

      <hr>
      <div class="restaurant-facility">
        <h5 class="mb-4"> Facility </h5>
        <div class="row">
          <div class="col-3">
            <button class="btn btn-light equipment-button" data-toggle="modal" data-target="#facilityAddModal"> + </button>
          </div>

          <div ng-repeat="item in facilityList" class="col-3">
            <button class="btn btn-light equipment-button" ng-click="setFacilityEdit(item.facility_id)" data-toggle="modal" data-target="#facilityEditModal"> {{ item.facility_name }} </button>
          </div>
        </div>
      </div>



      <!-- Facilty Add Modal -->
      <div class="modal fade" id="facilityAddModal" tabindex="-1" role="dialog" aria-labelledby="facilityAddModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="facilityAddModalLabel">Add Facility</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <label> Facility </label>
              <input class="form-control" ng-model="input.facility_name"> </input>
              <label> Description </label>
              <textarea class="form-control" style="height: 200px;" ng-model="input.facility_description"> </textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" ng-click="addRestaurantFacility()">Add Facility</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Facility Edit Modal -->
      <div class="modal fade" id="facilityEditModal" tabindex="-1" role="dialog" aria-labelledby="facilityEditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="facilityEditModalLabel">Edit Facility</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <label> Facility </label>
              <input class="form-control" ng-model="editFacility.facility_name"> </input>
              <label> Description </label>
              <textarea class="form-control" style="height: 200px;" ng-model="editFacility.facility_description"> </textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="deleteFacility()">Delete Facility</button>
              <button type="button" class="btn btn-primary" ng-click="saveFacilityChanges()"> Save Changes </button>
            </div>
          </div>
        </div>
      </div>

      <hr>

    </div>

    <!-- Right side card -->

    <!-- Request card -->
    <div id="right-side-card" class="col-4">
      <div class ="card mb-3">
        <div class="card-body">
          <p> Your restaurant is not discoverable by others yet. Go ahead and request to publish. </p>
          <div class="text-center">
            <button class="btn btn-primary"> Request to Publish </button>
          </div>
        </div>
      </div>

      <!-- Price and Available Time Card-->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"> Pricing </h5>
          <div class="d-flex restaurant-price" ng-show="priceBoxSwitch == -1">
            <p class="card-subtitle p-2"> ${{ restaurant.restaurant_fee}} per {{ restaurant.restaurant_fee_standard}}. </p>
            <buton class="btn btn-primary btn-sm ml-auto" ng-click="togglePriceBox()"> Edit Price </button>
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

          <button class="btn btn-light" style="width: 97%;" data-toggle="modal" data-target="#timeModal"> + </button>

          <!-- available time cards -->
          <div id="available-list">
            <div ng-repeat="item in availableTime">
              <div class="d-flex">
                <button class="btn btn-light w-100 mt-1"> {{item.available_day }}, {{item.available_begin}} to {{ item.available_end }} <span class="time-delete-button" ng-click="deleteAvailabletime( item.available_id )"> x </span> </button>

              </div>
            </div>
          </div>


          <!-- Available Time Add Modal -->
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

        </div>
      </div>

      <!-- Restaurant Certification Card -->
      <div class="card">
        
      </div>




    </div>
  </div>
</div>
