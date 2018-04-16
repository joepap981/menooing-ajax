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
                    <img id="profileImagePreview" class="pointer" ng-src="{{ user.img_ref }}" alt="">
                  </div>
                </div>
                <div class="col">
                  <p> Upload a profile picture.</p>
                  <!-- hidden, linked to profileImagePreview -->
                  <input ng-show="null" id="profileImageUpload" file-input="user_img" type="file"></input>
                  <button class="btn btn-primary" ng-click="uploadFile('user_img')"> Save Image </button>
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

              <button class="btn btn-primary mt-3 pull-right" ng-click="saveChanges()"> Save Changes </button>

            </div>
            <!--//user basic information end-->
          </div>
          <div class="card restaurant-profile">
            <div class="card-header"> User Documents </div>
            <div class="card-block container">
              <div class="form-group row">
                <label class="w-25"> Social Security: </label>
                <div class="w-74 ml-3 ml-auto">
                  <span ng-show = "user.user_ssn == null" class="pointer" data-toggle="collapse" data-target="#collapseSSN"> Upload File </span>
                  <a href="" ng-show = "user.user_ssn != null" ng-click="downloadFile('user_ssn')"> {{ user.ssn_name }} </a>
                  <span ng-show = "user.user_ssn != null" class="ml-5 pointer" data-toggle="collapse" data-target="#collapseSSN"> Change file </span>
                  <div class="collapse mt-3 mb-3" id="collapseSSN">
                    <div class="card card-body collapse">
                      <input type="file" id="ssnFileInput" class="col-input" file-input ="user_ssn" ng-model ="files.user_ssn">
                      <div class="btn-box">
                        <button data-toggle= "collapse" data-target="#collapseSSN" class="btn secondary"> Cancel </button>
                        <button class="btn btn-primary" ng-click = "uploadFile('user_ssn')"> Upload </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="w-26"> Food Manager Certificate: </label>
                <div class="w-74 ml-3 ml-auto">
                  <p ng-show = "user.user_cert == null" class="pointer" data-toggle="collapse" data-target="#collapseFoodManCert"> Upload File </p>
                  <a href="" ng-show = "user.user_cert != null" ng-click="downloadFile('user_cert')"> {{ user.cert_name }} </a>
                  <span ng-show = "user.user_cert != null" class="ml-5 pointer" data-toggle="collapse" data-target="#collapseFoodManCert"> Change file </span>
                  <div class="collapse mt-3 mb-3" id="collapseFoodManCert">
                    <div class="card card-body collapse">
                      <input type="file" id="foodCertFileInput" class="col-input" file-input ="user_cert" ng-model ="files.user_cert">
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
