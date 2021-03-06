  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/admin/admin.css" rel="stylesheet">



  <div ng-controller="AdminController">
    <div class="container" ng-if="sessionLive == false">
  	  <div class="card card-login mx-auto mt-5">
  		<div class="card-header">Admin Login</div>
  		<div class="card-body">
  			<form name="signInForm">
  				<div class="form-group">
  					<label for="exampleInputEmail1">Email address</label>
  					<input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter username" ng-model="signin.user_email" required>
  				</div>
  				<div class="form-group">
  					<label for="exampleInputPassword1">Password</label>
  					<input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" ng-model="signin.user_password" required>
  				</div>
  				<div class="form-group">
  					<div class="form-check">
  						<label class="form-check-label">
  							<input class="form-check-input" type="checkbox"> Remember Password</label>
  						</div>
  					</div>
  					<div class="text-center">
  						<button type="submit" class="clear-btn padding-bottom" ng-click="signIn(signin)" data-ng-disabled="signInForm.$invalid">Login</button>
  					</div>
  				</form>
  				<div class="text-center">
  					<span ng-show="user_no_match == true" class="error-message"> User and password does not match! </span>
  				</div>
  			</div>
  		</div>
  	</div>


    <div class="fixed-nav sticky-footer bg-dark" id="page-top" ng-if="sessionLive == true">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html">Admin</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <!--Dashboad-->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
              <a class="nav-link" ng-click ="redirect('/admin')">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <!--Users-->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
              <a class="nav-link" ng-click ="redirect('/admin/user-list')">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <!--Requests-->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Requests">
              <a class="nav-link" ng-click ="redirect('/admin/requests')">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Requests</span>
              </a>
            </li>
          </ul>


          <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
              <a class="nav-link text-center" id="sidenavToggler">
                <i class="fa fa-fw fa-angle-left"></i>
              </a>
            </li>
          </ul>

          <!-- Top nav bar -->
          <div class="top-nav ml-auto">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-envelope"></i>
                <span class="d-lg-none">Messages
                  <span class="badge badge-pill badge-primary">12 New</span>
                </span>
                <span class="indicator text-primary d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">New Messages:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>David Miller</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>Jane Smith</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>John Doe</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all messages</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i>
                <span class="d-lg-none">Alerts
                  <span class="badge badge-pill badge-warning">6 New</span>
                </span>
                <span class="indicator text-warning d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">New Alerts:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                      <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-danger">
                    <strong>
                      <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                      <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all alerts</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
          </ul>
        </div>
      </div>
      </nav>


      <div class="content-wrapper">
        <div class="container-fluid" >

        <!--Main view container-->
        <main class="main-container" ng-view>
          <!-- <div ng-if="pageNum == 1" landing-page-view></div>
          <div ng-if="pageNum == 2" user-list-view></div>
          <div ng-if="pageNum == 3" requests-view></div>
          <div ng-if="pageNum == 4" restaurant-profile-view></div> -->
        </main>

        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" data-dismiss="modal" ng-click="logout()">Logout</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
