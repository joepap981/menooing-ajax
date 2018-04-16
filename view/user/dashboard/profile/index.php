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

    <div class="row" ng-if="session['user_id'] != null">
      <div class="col-md-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-9">

        <div class="content-box" ng-controller="userProfileCtrl">
          <!--User Profile Image -->
          <div class="card restaurant-profile">
            <div id="profile" class="card-header"> User Profile Image </div>
            <div class="card-block container">
              <div class= "row">
                <div class="col">
                  <div id="profile-image-container">
                    <img id="profile-image-preview" ng-show = "user.user_id_img_ref != null" class="pointer" ng-src="{{ user.user_id_img_ref }}" alt="">
                    <img id="profile-image-preview" ng-show = "user.user_id_img_ref == null" class="pointer" src="/noexec/square.jpg" alt="">
                  </div>
                </div>
                <div class="col">
                  <p> Upload a profile picture.</p>
                  <!-- hidden, linked to profile-image-preview -->
                  <input ng-show="null" id="profile-image-upload" type="file"></input>
                  <button class="btn btn-primary"> Save Image </button>
                </div>
              </div>
            </div>
          </div>
          <!--//user profile image end-->

          <!-- user basic information-->
          <div class="card restaurant-profile">
            <div class="card-header"> User Basic Information </div>
            <div class="card-block container">
              <div class="form-group row" ng-model = "user">
                <label class="col-label"> First Name: </label>
                <input class="col-input form-control" ng-model = "user.first_name"></input>
              </div>
              <div class="form-group row">
                <label class="col-label"> Last Name: </label>
                <input class="col-input form-control" ng-model = "user.last_name"> </input>
              </div>
              <div class="form-group row">
                <label class="col-label"> Phone: </label>
                <input class="col-input form-control" ng-model = "user.user_phone"> </input>
              </div>

              <button class="btn btn-primary mt-3 pull-right"> Save Changes </button>

            </div>
            <!--//user basic information end-->
          </div>
          <div class="card restaurant-profile">
            <div class="card-header"> User Documents </div>
            <div class="card-block container">
              <div class="form-group row">
                <label class="w-25 mr-auto"> Social Security: </label>
                <div class="w-50 ml-3">
                  <p ng-show = "user.user_ssn == null" class="pointer" > Upload File </p>
                  <a href="" ng-show = "user.user_ssn != null" ng-click="downloadFile('user_ssn')" class="w-60"> Download uploaded file </a>
                  <span ng-show = "user.user_ssn != null" class="ml-5 pointer" data-toggle="collapse" data-target="#collapseSSN"> Change file </span class="w-60">
                  <div class="collapse mt-3 mb-3" id="collapseSSN">
                    <div class="card card-body collapse">
                      <input type="file" class="col-input" file-input ="user_ssn" ng-model ="files.user_ssn">
                      <div class="btn-box">
                        <button data-toggle= "collapse" data-target="#collapseSSN" class="btn secondary"> Cancel </button>
                        <button class="btn btn-primary" ng-click = "uploadFile('user_ssn')"> Upload </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="w-26 mr-auto"> Food Manager Certificate: </label>
                <div class="w-50 ml-3">
                  <p ng-show = "user.user_cert == null" class="pointer" > Upload File </p>
                  <a href="" ng-show = "user.user_cert != null" ng-click="downloadFile('user_cert')" class="w-60"> Download uploaded file </a>
                  <span ng-show = "user.user_cert != null" class="ml-5 pointer" data-toggle="collapse" data-target="#collapseFoodManCert"> Change file </span>
                  <div class="collapse mt-3 mb-3" id="collapseFoodManCert">
                    <div class="card card-body collapse">
                      <input type="file" class="col-input" file-input ="user_cert" ng-model ="files.user_cert">
                      <div class="btn-box">
                        <button data-toggle= "collapse" data-target="#collapseFoodManCert" class="btn secondary"> Cancel </button>
                        <button class="btn btn-primary" ng-click = "uploadFile('user_cert')"> Upload </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--//content-box end-->
      </div>
    </div>
  </div>
</div>
