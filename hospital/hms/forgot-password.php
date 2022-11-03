<?php
session_start();
error_reporting(0);
include("include/config.php");

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor1/autoload.php";

if (isset($_SESSION["user_id"])) {
	header("Location: reset-password.php");
  }
//Checking Details for reset password
if(isset($_POST['submit'])){
$name=mysqli_real_escape_string($con,$_POST['fullname']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$query=mysqli_query($con,"select id from  users where fullName='$name' and email='$email'");
// $row=mysqli_num_rows($query);
if(mysqli_num_rows($query) > 0){
	$data = mysqli_fetch_assoc($query);
// $_SESSION['name']=$name;
// $_SESSION['email']=$email;
// header('location:reset-password.php');
// } else {
// echo "<script>alert('Invalid details. Please try with valid details');</script>";
// echo "<script>window.location.href ='forgot-password.php'</script>";
// }
//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions
try{
  
  //Set mailer to use smtp
  $mail->isSMTP();
  //Define smtp host
  $mail->Host = "smtp.gmail.com";
  //Enable smtp authentication
  $mail->SMTPAuth = true;
  $mail->Username = $my_email;
  $mail->Password = 'camiguin5597890';
  //Set smtp encryption type (ssl/tls)
  $mail->SMTPSecure = "tls";
  //Port to connect smtp
  $mail->Port = "587";

  //From email address and name
  $mail->From = $my_email;
  $mail->FromName = "MGJR clinic";

  //To address and name
  $mail->addAddress($email, $name);
  
  $body = "
  <html>
  <head>
  <title>{$subject}</title>
  </head>
  <body>
  <p><strong>Dear {$name},</strong></p>
  <p>Forgot Password? Not a problem. Click below link to reset your password.</p>
  <p><a href='{$base_url}finalproject-main/hospital/hms/reset-password.php?token={$data['token']}'>Reset Password</a></p>
  </body>
  </html>
  ";

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Reset Password";
	$mail->Body = $body;
	$mail->AltBody = strip_tags($body);
	
	$mail->send();
	echo "<script>alert('We have sent a reset password link to your email :{$email}.');</script>";
	} catch (Exception $e) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
	} else {
		echo "<script>alert('Email not found.');</script>";
	}

}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pateint  Password Recovery</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.html"><h2> HMS | Patient Password Recovery</h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
								Patient Password Recovery
							</legend>
							<p>
								Please enter your Email and password to recover your password.<br />
					
							</p>

							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="text" class="form-control" name="fullname" placeholder="Registred Full Name">
									<i class="fa fa-lock"></i>
									 </span>
							</div>

							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Registred Email">
									<i class="fa fa-user"></i> </span>
							</div>

							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Reset <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								Already have an account? 
								<a href="user-login.php">
									Log-in
								</a>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HMS</span>. <span>All rights reserved</span>
					</div>
			
				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>