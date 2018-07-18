<link rel="stylesheet" href="css/user/pagination-custom.css">
<div class="admin-container" ng-controller = "adminRequestCtrl">
  <div class="d-flex mb-3">
    <select class="form-control w-25" ng-model="request_type_filter">
      <option value="{{undefined}}">All </option>
      <option value="rent_request">Rent Request</option>
      <option value="restaurant_confirmation">Restaurant Confirmation </option>
      <option value="user_verification">User Verification</option>
    </select>

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
      | filter: {request_type: request_type_filter}
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

            <!-- Modal for restaurant confirmation requests-->
            <div ng-if="selectedRequest.request_type == 'restaurant_confirmation'">
              <label> Status : {{ selectedRestaurant.restaurant_status }} </label>
              <p> Restaurant Name : {{ selectedRestaurant.restaurant_name }} </p>
              <p> Address : {{ selectedRestaurant.address}}</p>
              <p> Owner Name : {{ selectedUser2.user_first_name }} {{ selectedUser2.user_last_name }}</p>
              <p> Contact: {{ selectedUser.user_phone }}</p>
              <label> Certificate of Occupancy </label>
              <button class="btn btn-sm" ng-class = "restaurantCertButton" ng-click ="downloadFile('restaurant_cert')"> {{ restaurantCertMessage }} </button>
              <label> User Identification Document </label>
              <button class="btn btn-sm" ng-class = "userSSNButton" ng-click ="downloadFile('user_snn')"> {{ userSSNMessage }} </button>
              <button class="btn btn-sm btn-info" ng-click="redirectToRestaurantProfile()"> Edit Restaurant </button>

              <div class="btn-box mt-5">
                <button class="btn btn-primary btn-sm" ng-click="changeRestaurantStatus('CONFIRMED')"> Give Confirmation </button>
                <button class="btn btn-danger btn-sm" ng-click="changeRestaurantStatus('UNCONFIRMED')"> Unpublish </button>
              </div>
            </div>

            <!-- Modal for rent requests-->
            <div ng-if="selectedRequest.request_type == 'rent_request'">
              <h5> Guest </h5>
              <p> Request Sender User ID:  {{ selectedUser.user_ref }} </p>
              <p> User status: <button class="btn btn-sm btn-default">{{ selectedUser.user_status}}</button> <p>
              <label> Food Handler Certificate </label>
              <button class="btn btn-sm" ng-class = "userCertButton" ng-click ="downloadFile('user_cert')"> {{ userCertMessage }} </button>
              <label> User Identification Document </label>
              <button class="btn btn-sm" ng-class = "userSSNButton" ng-click ="downloadFile('user_ssn')"> {{ userSSNMessage }} </button>

            <hr>
              <h5> Host </h5>
              <button class="btn btn-primary btn-sm" ng-click="redirectToRestaurantProfile()"> View Profile </button>


              <div class="btn-box mt-5">
                <button class="btn btn-primary btn-sm" ng-click="changeRequestStatus('ALLOWED')"> Confirm Request </button>
                <button class="btn btn-danger btn-sm" ng-click="changeRequestStatus('DENIED')"> Deny Request </button>
              </div>
            </div>

            <!-- Modal for user verification requests-->
            <div ng-if="selectedRequest.request_type == 'user_verification'">
              <h5> User </h5>
              <p> Request Sender User ID:  {{ selectedUser.user_ref }} </p>
              <p> User status: <button class="btn btn-sm btn-default">{{ selectedUser.user_status}}</button> <p>
              <label> Food Handler Certificate </label>
              <button class="btn btn-sm" ng-class = "userCertButton" ng-click ="downloadFile('user_cert')"> {{ userCertMessage }} </button>
              <label> User Identification Document </label>
              <button class="btn btn-sm" ng-class = "userSSNButton" ng-click ="downloadFile('user_ssn')"> {{ userSSNMessage }} </button>

              <div class="btn-box mt-5">
                <button class="btn btn-primary btn-sm" ng-click="changeRequestStatus('ALLOWED'); changeUserStatus('VERIFIED')"> Confirm Request </button>
                <button class="btn btn-danger btn-sm" ng-click="changeRequestStatus('DENIED'); changeUserStatus('UNVERIFIED')"> Deny Request </button>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button ng-show="selectedRequest['request_status'] == 'Unhandled'" type="button" class="btn btn-primary" ng-click ="confirmRequest()"> Give Confirmation </button>
            <button ng-show="selectedRequest['request_status'] == 'Handled'" type="button" class="btn btn-danger" ng-click ="confirmRequest()"> Cancel Confirmation </button>
          </div>
        </div>
      </div>
    </div>

  </table>

</div>

<ul class="pagination mt-5 d-flex justify-content-center" uib-pagination total-items="requestTotalItems" ng-model="requestCurrentPage" ng-change="pageChanged()" items-per-page="requestItemsPerPage"></ul>
