<!-- Restaurant New -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<!-- if the session has ended show redirect page-->
<div id="no_session" ng-if="session['user_id'] == null">
  <no-session-view></no-session-view>
</div>

<!-- show content when user session is in progress -->
<div id="session" ng-if="session['user_id'] != null" ng-controller="userProfileCtrl">
  <div class="container">

    <div class="row mt-5" ng-if="session['user_id'] != null">
      <div class="col-md-2 mt-3">
        <side-nav></side-nav>
      </div>
      <div class="col-md-7">

        <div class="content-box">
          <!--User Profile Image -->
          <div class="card mt-3">
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
                  <button class="btn btn-primary pointer" ng-click="uploadFile('user_img')"> Save Image </button>
                </div>
              </div>
            </div>
          </div>
          <!--//user profile image end-->

          <!-- user basic information-->
          <div class="card mt-3">
            <div id="profile" class="card-header"> User Basic Information </div>
            <div class="card-block container">
              <div class="form-group row" ng-model = "user">
                <label class="col-label"> First Name: </label>
                <input class="col-input form-control" ng-model = "user.user_first_name"></input>
              </div>
              <div class="form-group row">
                <label class="col-label"> Last Name: </label>
                <input class="col-input form-control" ng-model = "user.user_last_name"> </input>
              </div>
              <div class="form-group row">
                <label class="col-label"> Phone: </label>
                <input class="col-input form-control" ng-model = "user.user_phone"> </input>
              </div>

              <button class="btn btn-primary mt-3 pull-right pointer" ng-click="saveChanges()"> Save Changes </button>

            </div>
            <!--//user basic information end-->
          </div>
          <div class="card mt-3">
            <div id="profile" class="card-header"> User Documents </div>
            <div class="card-block container">
              <div class="form-group row">
                <label class="w-25"> Social Security: </label>
                <div class="w-74 ml-3 ml-auto">
                  <button class="btn btn-primary btn-sm pointer" ng-show = "user.user_ssn == null" class="pointer" data-toggle="collapse" data-target="#collapseSSN"> Upload File </button>
                  <button class="btn btn-success btn-sm pointer" ng-show = "user.user_ssn != null" ng-click="downloadFile('user_ssn')"> Download File </button>
                  <button class="btn btn-info btn-sm pointer" ng-show = "user.user_ssn != null" class="ml-5 pointer" data-toggle="collapse" data-target="#collapseSSN"> Change file </button>

                  <div class="collapse mt-3 mb-3" id="collapseSSN">
                    <div class="card card-body collapse">
                      <input type="file" id="ssnFileInput" class="col-input" file-input ="user_ssn" ng-model ="files.user_ssn">
                      <div class="btn-box">
                        <button data-toggle= "collapse pointer" data-target="#collapseSSN" class="btn secondary"> Cancel </button>
                        <button class="btn btn-primary pointer" ng-click = "uploadFile('user_ssn')"> Upload </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="form-group row">
                <label class="w-26"> Food Manager Certificate: </label>
                <div class="w-74 ml-3 ml-auto">
                  <button class="btn btn-primary btn-sm pointer" ng-show = "user.user_cert == null" class="pointer" data-toggle="collapse" data-target="#collapseFoodManCert"> Upload File </button>
                  <button class="btn btn-success btn-sm pointer" ng-show = "user.user_cert != null" ng-click="downloadFile('user_cert')">  Download File </button>
                  <button class="btn btn-info btn-sm pointer" ng-show = "user.user_cert != null" class="ml-5 pointer" data-toggle="collapse" data-target="#collapseFoodManCert"> Change file </button>
                  <div class="collapse mt-3 mb-3" id="collapseFoodManCert">
                    <div class="card card-body collapse">
                      <input type="file" id="foodCertFileInput" class="col-input" file-input ="user_cert" ng-model ="files.user_cert">
                      <div class="btn-box">
                        <button data-toggle= "collapse" data-target="#collapseFoodManCert" class="btn secondary pointer"> Cancel </button>
                        <button class="btn btn-primary pointer" ng-click = "uploadFile('user_cert')"> Upload </button>
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
      <div class="col-md-3 mt-3">
        <div class="card mb-3">
          <p id="profile" class="card-header"> Restaurant Verification </p>
          <div class="card-body text-center">

            <div ng-if="user.user_status == 'UNVERIFIED'">
              <button class="btn btn-danger w-100"> Unverified </button>
            </div>
            <div ng-if="user.user_status == 'VERIFIED'">
              <button class="btn btn-success w-100"> Verified </button>
            </div>
            <div ng-if="user.user_status == 'PENDING'">
              <button class="btn btn-warning w-100"> Pending </button>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body text-center">

            <div ng-if="user.user_status == 'UNVERIFIED'">
              <p> Your user account has not been verified by the admin yet. You need verification in order to publish or rent a restaurant. </p>
              <button class="btn btn-primary pointer" ng-click ="verifyVerificationRequest()"> Request Verification </button>
            </div>
            <div ng-if="user.user_status == 'PENDING'">
              <p> Your verification request has been sent. Please wait for the admin to confirm. </p>
              <!-- <button class="btn btn-warning pointer" data-toggle="modal" data-target="#requestCancelModal"> Cancel Request </button> -->
            </div>
          </div>
        </div>
      </div>

      <!-- user verification information check modal -->
      <div class="modal fade" id="requestContinueModal" tabindex="-1" role="dialog" aria-labelledby="requestContinueModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="requestContinueModalLabel"> Continue Request?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p> You forgot to give us some information about your user. Your request may be rejected if your restaurant lacks
                too much information. Do you want to continue? </p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal" ng-click = "confirmVerificationRequest()"> Send Request </button>
            </div>
          </div>
        </div>
      </div>

      <!-- user verification cancel modal -->
      <!-- <div class="modal fade" id="requestCancelModal" tabindex="-1" role="dialog" aria-labelledby="requestCancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="requestContinueModalLabel"> Cancel Request?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p> Are you sure you want to cancel your user verification request? </p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal" ng-click = "cancelVerificationRequest()"> Cancel Request </button>
            </div>
          </div>
        </div>
      </div> -->

    </div>
  </div>
</div>
