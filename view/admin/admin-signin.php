<!-- Custom styles for this template -->
<link href="css/user/userlogin.css" rel="stylesheet">

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
