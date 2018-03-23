<table class="table table-hover" ng-controller = "adminRequestCtrl">
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
    <tr ng-repeat="request in Requests" data-toggle="modal" data-target="#addMenu">>
      <th scope="row">{{ request.request_id }}</th>
      <td> {{ request.request_created }}</td>
      <td> {{ request.request_type }} </td>
      <td> {{ request.user_ref }}</td>
      <td> {{ request.restaurant_ref }} </td>
    </tr>
  </tbody>

  <!-- Request Detail Modal -->
  <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="addMenu" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a new menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <a href="#"><img class="menu-img" src="http://via.placeholder.com/300x200" alt=""></a>
          <div class="menu-img">
            <a href="#"> Add image </a>
          </div>

          <form class="menu-form">
            <div class="form-group row">
              <label class="col-md-3" for="menu-name">Name</label>
              <input class="col-md-8"type="text" class="form-control" ng-model="menu.menu_name" id="menu-name" aria-describedby="" placeholder="Name of your menu">
            </div>
            <div class="row">
              <label class="col-md-3"> Category </label>
              <select id="menu-category"  ng-model="menu.menu_category" class="custom-select custom-select-lg col-md-8">
                <option selected>Choose Category</option>
                <option value="1">Main</option>
                <option value="2">Appetizer</option>
                <option value="3">Drink</option>
              </select>
            </div>
            <div class="form-group row">
              <label class="col-md-3" for="menu-price">Price</label>
              <input class="col-md-8"type="text" class="form-control" ng-model="menu.menu_price" id="menu-price" aria-describedby="" placeholder="$">
            </div>

            <div class="form-group">
              <label for="menu-description">Short Description</label>
              <textarea class="form-control" id="menu-description"  ng-model="menu.menu_description" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="clearForm()">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--Add modal end-->
</table>
