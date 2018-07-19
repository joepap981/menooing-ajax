<!-- Requests Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="css/user/pagination-custom.css">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null"></no-session-view>

<!-- show content when user session is in progress -->
<div class="container" ng-if="session['user_id'] != null" ng-model="page">
  <div class="row mt-5">
    <!--side navigation -->
    <div class="col-md-3">
      <side-nav></side-nav>
    </div>

    <!-- Request list -->
    <div class="admin-container col-md-9" ng-controller = "userRequestCtrl">
      <div class="d-flex mb-3">
        <div class="btn-group btn-group-toggle ml-3" data-toggle="buttons">
          <label class="btn btn-default active" ng-click="changeRequestStatusFilter(undefined)">
            <input type="radio" autocomplete="off" checked > All </input>
          </label>
          <label class="btn btn-default" ng-click="changeRequestStatusFilter(true)">
            <input type="radio" autocomplete="off" > Handled </input>
          </label>
          <label class="btn btn-default" ng-click="changeRequestStatusFilter(false)">
            <input type="radio" autocomplete="off" > Unhandled </input>
          </label>

        </div>
      </div>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Request Created</th>
            <th scope="col">Request Type</th>
            <th scope="col">User ID</th>
            <th scope="col">Restaurant ID</th>
            <th scope="col">Request Status </th>
          </tr>
        </thead>
        <tbody>
          <tr style="cursor:pointer;" ng-repeat="request in Requests.slice(((requestCurrentPage-1)*requestItemsPerPage), ((requestCurrentPage)*requestItemsPerPage))
          | filter: {request_type: 'rent_request'}
          | filter: requestStatusFilter"
          data-toggle="modal" data-target="#requestModal" data-whatever="{{ request }}" ng-click="loadRequest(request)">
            <th >{{ request.request_id }}</th>
            <td> {{ request.request_created }}</td>
            <td> {{ request.request_type }} </td>
            <td> {{ request.user_ref }}</td>
            <td> {{ request.restaurant_ref }} </td>
            <td> {{ request.request_status }} </td>
          </tr>
        </tbody>

        <!-- Request Modal -->
        <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel"> {{ selectedRequest.request_type}} for restaurant {{ selectedRequest.restaurant_ref}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <!-- Modal for rent requests-->
                <div ng-if="selectedRequest.request_type == 'rent_request'">
                  <h5> Request Sender </h5>
                  <p> Name :  {{ selectedUser2.user_first_name }} {{ selectedUser2.user_last_name}} </p>
                  <p> Phone #: {{ selectedUser.user_phone}}
                  <div class="d-flex mb-1">
                    <p> Food Handler Certificate </p>
                    <button class="btn btn-sm ml-auto h-75" ng-class = "userCertButton" ng-click ="downloadFile('user_cert')"> {{ userCertMessage }} </button>
                  </div>
                  <div class="d-flex">
                    <label> User Identification Document </label>
                    <button class="btn btn-sm ml-auto h-75" ng-class = "userSSNButton" ng-click ="downloadFile('user_ssn')"> {{ userSSNMessage }} </button>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="btn-box mt-2">
                  <button class="btn btn-primary btn-sm" ng-click="changeRequestStatus('ALLOWED')"> Confirm Request </button>
                  <button class="btn btn-danger btn-sm" ng-click="changeRequestStatus('DENIED')"> Deny Request </button>
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
          </div>
        </div>

      </table>
      <ul class="pagination mt-5 d-flex justify-content-center" uib-pagination total-items="requestTotalItems" ng-model="requestCurrentPage" ng-change="pageChanged()" items-per-page="requestItemsPerPage"></ul>
    </div>


  </div>
</div>
