<!-- Custom styles for this template -->
<link href="css/user/userlogin.css" rel="stylesheet">

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
					<input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name = "user_email" ng-model="signup.user_email">
					<span ng-show ="signUpForm.user_email.$dirty && signUpForm.user_email.$error.email">Invalid email address</span>
    			<span ng-show="email_exists"> This email address is already registered! </span>
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
							<span class="error-message" data-ng-show="signUpForm.confPassword.$dirty && signUpForm.confPassword.$error.required"> Enter confirm password </span>
						</div>
					</div>
					<div class="error-message" data-ng-show="passwordNoMatch">Passwords do not match. Please enter again.</div>
				</div>
				<div class="text-center">
					<button type="submit" class="clear-btn text-center padding-bottom" ng-click="signUp()" data-ng-disabled="signUpForm.$invalid">Register</button>
				</div>
			</form>
			<div class="text-center">
				<div class="clear-btn small" ng-click="redirect('/signin')">Login Page</a>
				<div class="clear-btn small" ng-click="redirect('/forgot-password')">Forgot Password?</a>
			</div>
		</div>
	</div>
</div>
