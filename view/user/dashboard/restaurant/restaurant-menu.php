<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<no-session-view id="no_session" ng-if="session['user_id'] == null" ></no-session-view>

<!-- show content when user session is in progress -->
<div class="row" ng-if="session['user_id'] != null" ng-model="page" ng-controller="UserDashboardController">
    <div class="home-content">

      <div class="restaurant-nav">
        <div class="btn clear-btn submit " ng-click="redirect('/restaurant-list')"><img id="circular-button" src="/img/left-arrow-circular-button.png"> Back</div>
        <div class="btn clear-btn" ng-click="redirect('/restaurant-profile')"> Profile </div>
        <div class="btn clear-btn"> Menu </div>
      </div>


      <!-- Button trigger modal -->
      <div class="restaurant-category">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMenu">Add Menu</button>
      </div>

      <!-- Modal -->
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
                  <input class="col-md-8"type="text" class="form-control" id="menu-name" aria-describedby="" placeholder="Name of your menu">
                </div>
                <div class="row">
                  <label class="col-md-3"> Category </label>
                  <select id="menu-category" class="custom-select custom-select-lg col-md-8">
                    <option selected>Choose Category</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="form-group row">
                  <label class="col-md-3" for="menu-price">Price</label>
                  <input class="col-md-8"type="text" class="form-control" id="menu-price" aria-describedby="" placeholder="$">
                </div>
              </form>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">I'm a modal!</h3>
        </div>
        <div class="modal-body" id="modal-body">
            <h4> body </h4>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="">OK</button>
            <button class="btn btn-warning" type="button" ng-click="">Cancel</button>
        </div>
    </script>

      <div id="restaurant-menu">
        <div class="restaurant-category">
          <h6> Main </h6>

          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 portfolio-item" ng-repeat="item in menus">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Project One</a>
                  </h4>
                  <p class="card-text">Price: </p>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="restaurant-category">
          <h6> Appetizer </h6>
          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 portfolio-item" ng-repeat="item in menus">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Project One</a>
                  </h4>
                  <p class="card-text">Price: </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="restaurant-category">
          <h6> Drinks </h6>
          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 portfolio-item" ng-repeat="item in menus">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Project One</a>
                  </h4>
                  <p class="card-text">Price: </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
