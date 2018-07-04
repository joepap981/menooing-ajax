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
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="request in Requests.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage))" data-toggle="modal" data-target="#requestModal" data-whatever="{{ request }}">
        <th >{{ request.request_id }}</th>
        <td> {{ request.request_created }}</td>
        <td> {{ request.request_type }} </td>
        <td> {{ request.user_ref }}</td>
        <td> {{ request.restaurant_ref }} </td>
      </tr>
    </tbody>

    <!-- Request Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="requestModalLabel"> Request </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <a href="#" ng-click=''> View restaurant profile </a>

            <!--
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-click ="confirmRequest()"> Give Confirmation </button>
          </div>
        </div>
      </div>
    </div>

  </table>

  <ul class="pagination mt-5 d-flex justify-content-center" uib-pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" items-per-page="itemsPerPage"></ul>
</div>
