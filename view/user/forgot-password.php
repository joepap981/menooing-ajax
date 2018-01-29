<link href="css/user/userlogin.css" rel="stylesheet">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form>
          <div class="form-group">
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email address">
          </div>
          <div class="text-center">
            <div class="clear-btn text-center padding-bottom" href="login.html">Reset Password</div>
          </div>
        </form>
        <div class="text-center">
          <div class="clear-btn small" ng-click="redirect('/signup')">Register an Account</div>
          <div class="clear-btn small" ng-click="redirect('/signin')">Login Page</div>
        </div>
      </div>
    </div>
  </div>
