<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';
// Load database and email connector code
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Register New Member</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="stylesheet" href="yearpicker.css">
		<!--Scripts for 4 fields that ask about Year-->
		<script src="yearpicker.js" async></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous">
		</script>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<a href="index.php" class="logo"><strong>SHPE</strong> <span>at UT Dallas</span></a>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<ul class="links">
							<li><a href="index.php">Home</a></li>
                                                        <li><a href="newsletter.php">Newsletter</a></li>
							<li><a href="calendar.php">Calendar</a></li>
							<li><a href="#contact">Contact</a></li>
							<?php
							if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
							{
									?>
									<li><a href="dashboard.php" class="button special">Dashboard</a></li>
									<li><a href="logout.php" class="button">Log Out</a></li>
									<?php
							}
							else
							{
									?>
									<li><a href="login.php" class="button">Log In</a></li>
									<li><a href="registerMember.php" class="button special">Register</a></li>
									<?php
							}
							?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main" class="alt">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<header class="major">
										<h1>Account Registration</h1>
									</header>
									<div class="content">
										<p>Use your account to keep track of your membership and points from being an active SHPE member at UT Dallas!
										<br>
										<strong>Note: </strong>If you are having technical difficulties, please contact Hepson Sanchez on our <a href="officers.php">Officers Page</a>.
										</p>
									</div>
									<span class="image main"><img src="images/register.jpg" alt="" /></span>
									<?php
									$selfLink = "registerMember.php";	// for user to retry during errors
									// set the time-zone to Central Time (for database to track what time this user registered)
									date_default_timezone_set('america/chicago');
									// check whether the form was completely filled out
									if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) &&
										!empty($_POST['password']) && !empty($_POST['cpassword']))
									{
										// cleanup form values for database (against SQL Injections)
										$firstname = mysqli_real_escape_string($dbcon, $_POST['firstname']);
										$lastname = mysqli_real_escape_string($dbcon, $_POST['lastname']);
										$email = mysqli_real_escape_string($dbcon, $_POST['email']);
										$password = md5(mysqli_real_escape_string($dbcon, $_POST['password']));
										$cpassword = md5(mysqli_real_escape_string($dbcon, $_POST['cpassword']));

										// used to check whether email ends in "@utdallas.edu"
										$checkemail = mysqli_query($dbcon, "SELECT * FROM users WHERE UTDEmail = '".$email."'");
										$utdedu = "utdallas.edu";
										$emaillength = strlen($utdedu);
										
										// check whether the email ends in "utdallas.edu"
										if(substr($email, -$emaillength) == $utdedu)
										{
											// check whether the email already exists in the database
											if(mysqli_num_rows($checkemail) == 0)
											{
												// check whether confirmation password matches
												if($password == $cpassword)
												{
													// add user to database
													$registereddatetime = date("Y\-m\-d H\:i\:s");
													$registermember = mysqli_query($dbcon, "INSERT INTO users (FirstName, LastName, UTDEmail, Password, RegisteredDateTime) 
																					VALUES('$firstname', '$lastname', '$email', '$password', '$registereddatetime')");
													// check whether database row insertion worked
													if($registermember)
													{
														// get the new user id
														$userid = mysqli_insert_id($dbcon);
																	 
														// create a random key used to confirm account
														$key = $firstname . $lastname . $email . $registereddatetime;
														$key = md5($key);
														
														// add activation information to database
														$key_datetime = date("Y\-m\-d H\:i\:s");
														$confirm = mysqli_query($dbcon, "INSERT INTO `account_activations` (user_id, activation_key, email, created) VALUES('$userid','$key','$email', '$key_datetime')"); 
														
														// check whether database row insertion worked
														if($confirm)
														{
															// Instantiation and passing `true` enables exceptions
															$mail = new PHPMailer(true);
															try
															{
																//Server settings
																$mail->isSMTP();									// Set mailer to use SMTP
																$mail->Host       = 'smtp.gmail.com';  				// Specify main and backup SMTP servers
																$mail->SMTPAuth   = true;                           // Enable SMTP authentication
																$mail->Username   = 'utdshpe@gmail.com';            // SMTP username, our shpe gmail account
																$mail->Password   = 'fpexxcenjhhzlbsd';           	// SMTP password (automatic password created by Google for SMTP to your gmail)
																$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted. TLS required with port 587.
																$mail->Port       = 587;                           	// TCP port to connect to. 587 for Gmail

																//Recipients
																$mail->setFrom('utdshpe@gmail.com');
																$mail->addCC('utdshpe@gmail.com');
																$mail->addAddress($email);

																// Content
																$mail->Subject = 'SHPE UTD Signup | Verification';
																$mail->Body    = '
Thank you for signing up to become a SHPE UTD member!
Your account has been created with the following credentials.
Please finish activating your account by clicking the url below.

------------------------
First Name: '.$firstname.'
Last Name: '.$lastname.'
Username: '.$email.'
------------------------

Please click this link to activate your account:
http://shpeutd.org/verifyAccount.php?email='.$email.'&key='.$key.'
																';

																$mail->send();
																?>
																<h1 style="display: flex;justify-content: center">Success!</h1>
																<p style="display: flex;justify-content: center; text-align:center">
																	A verification email has been sent to <?php echo $email; ?>
																	<br>
																	Please check your UT Dallas inbox and spam folders.
																</p>
																<div class="12u$" style="display: flex;justify-content: center">
																	<a href="https://webmail.utdallas.edu/owa/" class="button" target="_blank" >Take me to my UTD email</a>
																</div>
																<?php
															}
															catch (Exception $e)
															{
																// Show error message
																echo "<b>ERROR: </b> Sorry, failed to send your verification email to <b>".$email."</b>.<br>";
																echo "Mailer Error: {$mail->ErrorInfo}<br>";
																// Undo previous sql INSERT
																$delete_user_row = mysqli_query($dbcon, "DELETE FROM `users` WHERE `UserID` = '$userid'");
																if($delete_user_row)
																{echo "<b>Note: </b>Removed your <b>account</b> information from the system.<br>";}
																else
																{echo "<b>Error: </b>Failed to remove your <b>account</b> information from the system. Reason: ".mysqli_error($dbcon)."<br>";}
																// Undo previous sql INSERT
																$delete_verify_row = mysqli_query($dbcon, "DELETE FROM `account_activations` WHERE `user_id` = '$userid'");
																if($delete_verify_row)
																{echo "<b>Note: </b>Removed your <b>verification</b> information from the system.<br>";}
																else
																{echo "<b>Error:</b> Failed to remove <b>verification</b> information from the system. Reason: ".mysqli_error($dbcon)."<br>";}
																// Return message
																echo "<br>Please go back or <a href='".$selfLink."'>click here</a> to try again.";
															}
														}
														else
														{
															$delete_user_row = mysqli_query($dbcon, "DELETE FROM `users` WHERE `UserID` = '$userid'") or die(mysqli_error($dbcon)); 
															echo "<h2>Error</h2>
															<p>Sorry, failed to add your confirmation information to the system. Reason: ".mysqli_error($dbcon)."
															<br>Your account was removed from the database.
															<br>Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>"; 
														}
													}
													else
													{
														echo "<h2>Error</h2>
														<p>Sorry, your member registration failed. Reason: ".mysqli_error($dbcon)."
														<br>Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>"; 
													}
												}
												else
												{
													echo "<h2>Error</h2>";
													echo "<p>Sorry, your passwords do not match. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
												}
											}
											elseif(mysqli_num_rows($checkemail) == 1)
											{
												?>
												<h2 style="display: flex;justify-content: center">Error</h2>
												<p style="display: flex;justify-content: center; text-align:center">
													Sorry, An account associated with <?php echo $email; ?> already exists.
													<br>
												</p>
												<div class="row uniform">
													<div class="12u$" style="display: flex;justify-content: center">
														<a href="login.php" class="button" target="_blank">Login</a>
													</div>
													<div class="12u$" style="display: flex;justify-content: center">
														<a href="registerMember.php" class="button" target="_blank">Register</a>
													</div>
												</div>
												<?php
											}
											else
											{
												echo "<h2>Error</h2>";
												echo "<p>Sorry. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
											}
										}
										else
										{
											echo "<h3>Error</h3>";
											echo "<p>Sorry, that email does not end in \"utdallas.edu\". Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
										}
									}
									elseif(!(empty($_POST['firstname']) && empty($_POST['lastname']) && 
												empty($_POST['email']) && empty($_POST['password']) && empty($_POST['cpassword'])))
									{
										echo "<h2>Error</h2>";
										echo "<p>Sorry, the form is incomplete. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
									}
									else
									{
										?>
										<form method="post" action="registerMember.php" name="signupform" id="signupform">
											<div class="row 200%" style="display: flex;justify-content: center">
												<!--Membership Section-->
												<div class="row uniform">
													<!--Personal Information-->
													<div class="12u$" style="display: flex;justify-content: center">
														<label>Personal Information</label>
													</div>
													<div class="6u 12u$(xsmall)">
														<input required type="text" name="firstname" id="firstname" value="" placeholder="First Name" />
													</div>
													<div class="6u$ 12u$(xsmall)">
														<input required type="text" name="lastname" id="lastname" value="" placeholder="Last Name" />
													</div>
													<div class="12u$">
														<input required type="email" name="email" id="email" value="" placeholder="UTD Email" />
													</div>
													<div class="6u 12u$(xsmall)">
														<input required type="password" name="password" id="password" value="" placeholder="Password" />
													</div>
													<div class="6u$ 12u$(xsmall)">
														<input required type="password" name="cpassword" id="cpassword" value="" placeholder="Confirm Password" />
													</div>
													<!--Submit Button-->
													<div class="12u$" style="display: flex;justify-content: center">
														<ul class="actions">
															<li><input type="submit" value="Register" class="special" /></li>
														</ul>
													</div>
												</div>
												<!--Submit Button-->
											</div>
										</form>
										<?php
									}
									?>
								</div>
							</section>

					</div>

				<!-- Contact -->
					<section id="contact">
						<div class="inner">
							<section>
									<div class="contact-method">
										<span class="icon alt fa-home"></span>
										<h3>Address</h3>
										<span>800 W Campbell Rd.<br />
										Richardson, TX 75080<br />
										United States of America</span>
									</div>
							</section>
							<section class="split">
								<section>
									<div class="contact-method">
										<span class="icon alt fa-envelope"></span>
										<h3>Email</h3>
										<a href="mailto:utdshpe@gmail.com" target="_blank">utdshpe@gmail.com</a>
									</div>
								</section>
								<section>
									<div class="icons">
										<ul class="icons">
											<li><a href="https://twitter.com/shpeutd?lang=en" class="icon alt fa-twitter" target="_blank"><span class="label" >Twitter</span></a></li>
											<li><a href="https://www.facebook.com/SHPEUTD/" class="icon alt fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
											<li><a href="https://www.instagram.com/utdshpe/" class="icon alt fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>
										</ul>
										<h3>Follow us on Social Media</h3>
									</div>
								</section>
							</section>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
	</body>
</html>