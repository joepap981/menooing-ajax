<!-- Custom styles for this template -->
<link href="css/userlogin.css" rel="stylesheet">

<div class="container">
	<div class="card card-login mx-auto mt-5">
		<div class="card-header">Login</div>
		<div class="card-body">
			<form name="signInForm">
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" ng-model="signin.user_email" required>
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
					<button type="submit" class="btn btn-primary btn-block" ng-click="signIn()" data-ng-disabled="signInForm.$invalid">Login</button>
				</form>
				<div class="text-center">
					<a class="d-block small mt-3" href="/signup">Register an Account</a>
					<a class="d-block small" href="/forgot-password">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>
