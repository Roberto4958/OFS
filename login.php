<?php
session_start();

// if(isset($_SESSION['usr_id'])) {
// 	header("Location: index.php");
// }

include_once './Scripts/logininfo.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	echo "signing up...";
	$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lastname']);
//	$uname = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$lname)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	// if (!preg_match("/^[a-zA-Z_-]+$/",$uname)) {
	// 	$error = true;
	// 	$name_error = "Invalid Username: can only contain alphabets, numbers, -,or _";
	// }
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO users(`firstname`, `lastname`, `Email`, `password`) VALUES('".$fname."', '".$lname."', '".$email."', '".md5($password)."')")) {
			$successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		} else {
			$errormsg = "Error in registering...Please try again later!";
			echo mysqli_error($conn);
		}
	}
}
?>

<!DOCTYPE html>
<head>
	<title>Login/Register Page</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form" style="display: block;">
									<div class="form-group col-sm-12">
										<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php if($error) echo $email; ?>">
									</div>
									<div class="form-group col-sm-12">
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
									</div>
									<!-- <div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div> -->
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<!-- <div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div> -->
								</form>
								<form id="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signup" role="form" style="display: none;">
									<div class="form-group col-sm-6">
										<input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required value="<?php if($error) echo $fname; ?>"/>
										<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
									</div>
									<div class="form-group col-sm-6">
										<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required value="<?php if($error) echo $lname; ?>"/>
										<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
									</div>
									<div class="form-group col-sm-12">
										<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required value="<?php if($error) echo $email; ?>">
										<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
									</div>
									<div class="form-group col-sm-6">
										<input type="password" name="password" id="password" required class="form-control" placeholder="Password">
										<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
									</div>
									<div class="form-group col-sm-6">
										<input type="password" name="confirm-password" id="confirm-password" required class="form-control" placeholder="Confirm Password">
										<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
								<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
								<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="./js/login.js"></script>
</body>
</html>