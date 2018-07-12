<link rel="stylesheet" href="css/user/restaurant/restaurant-guest-request.css">

<div class="container mt-5" style="min-height: 700px;">
  <button class="btn btn-primary mb-4"> Go back to restaurant </button>
  <div class="row">
    <div class="col-5 text-center">
      <div class="card">
        <div class="card-body">
          <h5> Restaurant Rent Request </h5>
          </hr>
          <div class="dropdown mt-3">
            <span> Rent by </span>
            <button class="btn btn-default btn-sm"> {{ rentBy }} </button>
          </div>

          <div class="mt-4">
            <div style="display:inline-block; min-height:290px;">
              <div uib-datepicker ng-model="dt" class="well well-sm" datepicker-options="options" date-disabled="disabled(date, mode)" ></div>
            </div>

            <div class="d-flex" ng-show="rentBy == 'hour'">
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


            <hr />
            <button class="btn btn-primary w-100" ng-click="addRequestTime()"> Add Date </button>
          </div>


        </div>
      </div>
    </div>

    <div class="col-3">
      <div class="card" style="min-height: 580px;">
        <div class="card-body text-center">
          <h5> Requested Times </h5>

          <!-- request time cards -->
          <div id="available-list">
            <div ng-repeat="item in requestTimeList">
              <div class="d-flex">
                <button ng-if="rentBy == 'month'" class="btn btn-default w-100 mt-1"> {{item.beginTime | date: 'MMM dd' }} to {{ item.endTime | date: 'MMM dd'}} <span class="time-delete-button" ng-click="deleteRequestedTime(item.id)"> x </span> </button>
                <button ng-if="rentBy == 'day'" class="btn btn-default w-100 mt-1"> {{item.beginTime | date: 'MMM dd, EEE' }} <span class="time-delete-button" ng-click="deleteRequestedTime(item.id)"> x </span> </button>
                <button ng-if="rentBy == 'hour'" class="btn btn-default w-100 mt-1"> {{item.beginTime | date: 'MMM dd, HH:mm' }} - {{ item.endTime | date: 'HH:mm'}} <span class="time-delete-button" ng-click="deleteRequestedTime(item.id)"> x </span> </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="col-3">
      <div class="card text-center mb-3">
        <div class="card-body">
          <p> Send the owner rent request</p>
          <button class="btn btn-primary w-100"> Send Request </button>
        </div>
      </div>

      <div class="card mb-3" style='min-height: 440px;'>
        <div class="card-body">
          <h5 class="card-title"> Available Hours </h5>

          <!-- available time cards -->
          <div id="available-list">
            <div ng-repeat="item in availableTime">
              <div class="d-flex">
                <button class="btn btn-default w-100 mt-1"> {{item.available_day }}, {{item.available_begin}} to {{ item.available_end }} </button>
              </div>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>

  </div>

  </div>
</div>
