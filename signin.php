<?php
session_start();

// if(isset($_SESSION['usr_id'])!="") {

// 	header("Location: index.php");
// }

include_once 'Scripts/config.php';
include_once 'Scripts/loginInfo.php';
include_once 'Scripts/helperScripts.php';

//check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

    $conn = new mysqli($hn, $un, $pw, $db);
    if (!$conn->connect_error){
        $salt  = getSalt($conn, $email);
        if(! $salt){
            //Email does not exist
        }
        else{
            $hashedpass = hash('sha256', $password . $salt);
            $loginInfo = passIsCorrect($conn, $email, $hashedpass);
            if(!$loginInfo){
                //Wrong user email/password combination
            }
            else{
                $token = randomString(20);
                $id= $loginInfo[0];
                $conn->query("update users set authtoken = '$token' where id = $id"); 
                startSession($token, $id);
                header('Location: index.php');
            }
        }
    }
    $conn->close();
}




function getSalt($conn, $email){
    $stmt = $conn->prepare("select salt from users where email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_NUM);
    $stmt->close();
    if(!$row) return false;
    return $row[0];
}

function passIsCorrect($conn, $email, $hashedpass){
    $stmt = $conn->prepare("select id from users where email = ? and password = ?");
    $stmt->bind_param('ss', $email, $hashedpass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_NUM);
    $stmt->close();
    if(!$row) return false;
    return array($row[0]);
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body  style="background-image: url('images/grapesBanner.jpg');">
<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div>
								<a href="#login" class="active" id="login-form-link">Login</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="signin.php" method="post" name="login" role="form" style="display: block;">
									<div class="form-group col-sm-12">
										<input type="text" name="email" id="email" class="form-control" placeholder="Email">
									</div>
									<div class="form-group col-sm-12">
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
								<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 text-center">	
				New User? <a href="signup.php">Sign Up Here</a>
			</div>
		</div>
	</div>

	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./js/login.js"></script>
</body>
</html>