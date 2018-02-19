<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <no-session-view></no-session-view>
</div>

<!-- show content when user session is in progress -->
<div id="session" ng-if="session['user_id'] != null" >
  <div class="container">
    <restaurant-subnav></restaurant-subnav>
    <div class="row" ng-if="session['user_id'] != null">
      <div class="col-md-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-9">

        <div class="content-box" ng-controller="UserDashboardController">
          <!-- Button trigger modal for Menu Add -->
          <div class="restaurant-category">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMenu">Add Menu</button>
          </div>

          <!-- Menu Add Modal -->
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
          <!--Restaurant-menu end-->
        </div>
      </div>
    </div>
  </div>
</div>
