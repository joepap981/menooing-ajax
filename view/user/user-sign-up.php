<!-- Custom styles for this template -->
<link href="css/userlogin.css" rel="stylesheet">

<div class="container">
	<div class="card card-register mx-auto mt-5">
		<div class="card-header">Register an Account</div>
		<div class="card-body">
			<form name="signUpForm">
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="exampleInputName">First name</label>
							<input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" ng-model="signup.user_first_name" required>
						</div>
						<div class="col-md-6">
							<label for="exampleInputLastName">Last name</label>
							<input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" ng-model="signup.user_last_name" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" ng-model="signup.user_email" focus>
					<span ng-show ="signUpForm.user_email.$error.user_email" class="help-inline">Invalid email address</span>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="exampleInputPassword1">Password</label>
							<input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" ng-model="signup.user_password" ng-model="signup.user_password" required>
						</div>
						<div class="col-md-6">
							<label for="exampleConfirmPassword">Confirm password</label>
							<input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password" ng-model="signup.confPassword" password-match="signup.user_password" required>
							<span class="errorMessage" data-ng-show="signUpForm.confPassword.$dirty && signUpForm.confPassword.$error.required"> Enter confirm password </span>
							<span style="color:#F00" class="errorMessage" data-ng-show="signUpForm.confPassword.$drity && signUpForm.confPassword.$error.passwordNoMatch && !signUpForm.confPassword.$error.required">Passwords do no match</span>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-block" ng-click="signUp(signup)" data-ng-disabled="signUpForm.$invalid">Register</button>
			</form>
			<div class="text-center">
				<a class="d-block small mt-3" href="/signin">Login Page</a>
				<a class="d-block small" href="/forgot-password">Forgot Password?</a>
			</div>
		</div>
	</div>
</div>
