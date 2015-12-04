
<html>
<head>
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">


	
	function showRegsitrationForm(){
		$("#registrationForm").show();
		$("#loginForm").hide();
		$("#successMsg").hide("");
		$("#loginFailed").hide();
	}
	
	function showLoginForm(){
		$("#loginForm").show();
		$("#registrationForm").hide();
		$("#errorMsg").hide();
	}

</script>
</head>
<body>
<?php 
	
	session_start();
	$is_user_logged_out = isset($_GET["logOutUser"]) ? $_GET["logOutUser"] : '';
	if($is_user_logged_out == "true"){
		session_destroy();
	}
	
	$successMsg = isset($_GET["successMsg"]) ? $_GET["successMsg"] : '';
	if($successMsg == "userCreated"){
		print "<div class='alert alert-success' id='successMsg'><strong>Registered Successfully. Please login</strong></div>";
	}
	
	$loginFailed = isset($_GET["loginFailed"]) ? $_GET["loginFailed"] : '';
	if($loginFailed == "true"){
		print "<div class='alert alert-danger' id='loginFailed'><strong>Username/password did not match</strong></div>";
	}
	
	$errorMsg = isset($_GET["errorMsg"]) ? $_GET["errorMsg"] : '';
	if($errorMsg == "userExist"){
		print "<div class='alert alert-danger' id='errorMsg'><strong>User already exist. Please register with different username</strong></div>";
		
		print "<script>$(document).ready(function() {showRegsitrationForm();});</script>";
	}
?>
<div class="container">
	<form id="loginForm" method="post" action="loginRegsiter.php" class="form-horizontal" role="form">
		<fieldset>
			<h1>Login Here:</h1>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Email:</label>
					<div class="col-sm-10">
						<input type="email" required="required" class="form-control" id="email"
							placeholder="Enter email" name="email">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Password:</label>
					<div class="col-sm-10">
						<input type="password" required="required" name="password" class="form-control" id="pwd"
							placeholder="Enter password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label><input name="user_type" value="customer" type="radio" required="required"> Customer</label>
							<label><input name="user_type" value="admin" type="radio" required="required"> Admin</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Submit</button>
						<input type="hidden" value="login" name="form_type">
						<a href="#" onclick="showRegsitrationForm()">New User?</a>
					</div>
				</div>
				
		</fieldset>
	</form>
	<form action="loginRegsiter.php" id="registrationForm" style="display: none" method="post" class="form-horizontal" role="form">
		<fieldset>
				<h1>Register Here:</h1>
			
			
			<div class="form-group">
					<label class="control-label col-sm-2" for="email">Email:</label>
					<div class="col-sm-10">
						<input type="email" required="required" class="form-control" id="email"
							placeholder="Enter email" name="email">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Password:</label>
					<div class="col-sm-10">
						<input type="password" required="required" name="password" class="form-control" id="pwd"
							placeholder="Enter password">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Re-Password:</label>
					<div class="col-sm-10">
						<input type="password" required="required" name="re_password" class="form-control" id="pwd"
							placeholder="Enter password again">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Submit</button>
						<input type="hidden" value="signUp" name="form_type">
						<a href="#" onclick="showLoginForm()">Login Here</a>
					</div>
				</div>
			
			
		</fieldset>
	</form>
	</div>
</body>
</html>