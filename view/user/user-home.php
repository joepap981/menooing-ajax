<div class="container">
  <h1> Welcome, <span style="color:#f5a521;"> {{user_name}}.</span></h1>
  <br/>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="well well-sm">
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <img src="img/user.png" alt="" class="img-rounded img-responsive" />
            </div>
            <div class="col-sm-6 col-md-8">
              <h5><span class="glyphicon glyphicon-user"></span>&nbsp;User Name: {{user_first_name}} {{user_last_name}}</h5>
              <h5><span class="glyphicon glyphicon-user"></span>&nbsp;User ID: {{user_id}} </h5>
              <h5><span class="glyphicon glyphicon-envelope"></span>&nbsp;Email: {{user_email}} </h5>
              <!--Split button-->
              <div class="btn-group">
                <button type="button" ng-click="logout();" class="btn btn-primary">Logout </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
