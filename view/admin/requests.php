<link rel="stylesheet" href="css/user/pagination-custom.css">
<div ng-controller = "adminRequestCtrl">
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
      <tr style="cursor:pointer;" ng-repeat="request in Requests.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage))" data-toggle="modal" data-target="#requestModal" data-whatever="{{ request }}" ng-click="loadRequest(request)">
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
            <label> Status : {{ selectedRestaurant.restaurant_status }} </label>
            <p> Restaurant Name : {{ selectedRestaurant.restaurant_name }} </p>
            <p> Address : {{ selectedRestaurant.address}}</p>
            <p> Owner Name : {{ selectedUser2.user_first_name }} {{ selectedUser2.user_last_name }}</p>
            <p> Contact: {{ selectedUser.user_phone }}</p>
            <label> Certificate of Occupancy </label>
            <button class="btn btn-sm" ng-class = "restaurantCertButton" ng-click ="downloadFile('restaurant_cert')"> {{ restaurantCertMessage }} </button>
            <label> User Identification Document </label>
            <button class="btn btn-sm" ng-class = "userCertButton" ng-click ="downloadFile('user_cert')"> {{ userCertMessage }} </button>
            <button class="btn btn-sm btn-info"> Edit Restaurant </button>

            <div class="btn-box mt-5">
              <button class="btn btn-primary btn-sm" ng-click="changeRestaurantStatus('CONFIRMED')"> Give Confirmation </button>
              <button class="btn btn-danger btn-sm" ng-click="changeRestaurantStatus('UNCONFIRMED')"> Unpublish </button>
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

  <ul class="pagination mt-5 d-flex justify-content-center" uib-pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" items-per-page="itemsPerPage"></ul>
</div>
