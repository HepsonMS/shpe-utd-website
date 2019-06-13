<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Account Verification</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
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
								<li><a href="dashboard.php" class="button">Dashboard</a></li>
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
								<h1>Verify Your Account</h1>
							</header>
							<span class="image main"><img src="images/verify.jpg" alt="" /></span>
							<?php
							if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
							{
								echo "<meta http-equiv='refresh' content='0;dashboard.php'/>";
								?>
								<h3>Logged In</h3>
								<a href="logout.php">Logout</a>
								<?php
							}
							if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['key']) && !empty($_GET['key']))
							{
								// Get data from URL
								$email = mysqli_escape_string($dbcon, $_GET['email']);
								$key = mysqli_escape_string($dbcon, $_GET['key']);
								// Check URL data with database
								$search = mysqli_query($dbcon, "SELECT A.email, A.activation_key, U.verified
													FROM account_activations AS A
													INNER JOIN users AS U
													ON A.user_id = U.UserID
													WHERE A.email='$email' AND A.activation_key='$key' AND U.verified=0") or die(mysqli_error($dbcon)); 
								$match  = mysqli_num_rows($search);
				
								if($match == 1)
								{
									// Verification no longer needed. Remove row from database.
									$delete_verify_row = mysqli_query($dbcon, "DELETE FROM account_activations WHERE email='$email' AND activation_key='$key'") or die(mysqli_error($dbcon)); 
									// Change user status to Verified
									$verify_user = mysqli_query($dbcon, "UPDATE users SET verified = 1 WHERE UTDEmail = '$email' AND verified = 0") or die(mysqli_error($dbcon)); 
									?>
									<h1 style="display: flex;justify-content: center">Success! Welcome to SHPE at UT Dallas</h1>
									<p style="display: flex;justify-content: center; text-align:center">
										Your account has been verified. Please click below to log in.
									</p>
									<div class="12u$" style="display: flex;justify-content: center">
										<a href="login.php" class="button">Login</a>
									</div>
									<?php
								}
								else
								{
									// Check whether account has already been verified
									$if_verified_already = mysqli_query($dbcon, "SELECT UTDEmail, verified FROM users WHERE UTDEmail='$email' AND verified=1") or die(mysqli_error($dbcon)); 
									$result = mysqli_num_rows($if_verified_already);
									if($result == 1)
									{
										?>
										<h2 style="display: flex;justify-content: center">Error</h2>
										<p style="display: flex;justify-content: center; text-align:center">
											The account associated with this email as already been verified.
										</p>
										<div class="12u$" style="display: flex;justify-content: center">
											<a href="registerMember.php" class="button">Login</a>
										</div>
										<?php
									}
									else
									{
										?>
										<h2 style="display: flex;justify-content: center">Error</h2>
										<p style="display: flex;justify-content: center; text-align:center">
											Email verification failed. Your information did not match our system.
										</p>
										<div class="12u$" style="display: flex;justify-content: center">
											<a href="registerMember.php" class="button">Register</a>
										</div>
										<?php
									}
								}
							}
							else
							{
								?>
								<h2 style="display: flex;justify-content: center">Error</h2>
								<p style="display: flex;justify-content: center; text-align:center">
									Email verification failed. No information was provided to match with our system.
								</p>
								<div class="12u$" style="display: flex;justify-content: center">
									<a href="registerMember.php" class="button">Registration</a>
								</div>
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