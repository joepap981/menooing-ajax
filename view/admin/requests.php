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
    <tr ng-repeat="request in Requests">
      <th scope="row">{{ request.request_id }}</th>
      <td> {{ request.request_created }}</td>
      <td> {{ request.request_type }} </td>
      <td> {{ request.user_ref }}</td>
      <td> {{ request.restaurant_ref }} </td>
    </tr>
  </tbody>
</table>
