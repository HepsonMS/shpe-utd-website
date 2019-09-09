<?php
// Database connector code
include "base.php";
// Helper functions for getting officer information
include "officer_helper.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
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
										<h1>Log In to See Your Points</h1>
									</header>
									<a id="here"></a>
									<div class="content">
										<p>See your activities, points, and even the point leaderboard!
										</p>
									</div>
									<span class="image main"><img src="images/login.jpg" alt="" /></span>
									<?php
									if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']) && ($_SESSION['Verified'] == 1))
									{
										echo "<meta http-equiv='refresh' content='0;dashboard.php'/>";
										?>
										<h3>Logged In</h3>
										<a href="logout.php">Logout</a>
										<?php
									}
									elseif(!empty($_POST['email']) && !empty($_POST['password']))
									{
										// Collect information from form
										$email = mysqli_real_escape_string($dbcon, $_POST['email']);
										$password = md5(mysqli_real_escape_string($dbcon, $_POST['password']));
										
										// Clean account_verification table of old data older than 1 hour
										delete_old_unverified_records($dbcon);
										$checklogin = mysqli_query($dbcon, "SELECT * FROM users WHERE UTDEmail = '".$email."' AND Password = '".$password."'");
										// Check whether the user exists in the database
										if($checklogin && mysqli_num_rows($checklogin) == 1)
										{
											// Get all of user information from database.
											$row = mysqli_fetch_array($checklogin);
											$_SESSION['FirstName'] = $row['FirstName'];
											$_SESSION['LastName'] = $row['LastName'];
											$_SESSION['EmailAddress'] = $row['UTDEmail'];
											$_SESSION['UserID'] = $row['UserID'];
											$_SESSION['Verified'] = $row['verified'];
											
											// Check whether the account has been email verified
											if($_SESSION['Verified'] == 1)
											{
												// Set session information from database
												$_SESSION['Officer'] = isOfficer($dbcon, $row['UTDEmail']);
												$_SESSION['Position'] = getOfficerPosition($dbcon, $row['UTDEmail']);
												$_SESSION['LoggedIn'] = 1;
												 
												echo "<h1>Success</h1>";
												echo "<p>We are now redirecting you to the member area.</p>";
												echo "<meta http-equiv='refresh' content='0' />";
											}
											else
											{
												?>
												
												<h1 style="display: flex;justify-content: center">Verification Required</h1>
												<p style="justify-content: center; text-align:center">
													Your email <b><?php echo $email ?></b> has not be verified.
													<br>Please find your original verification email or click below to resend it.
													<br><b>Note: </b> Users have 1 hour to verify their emails before their accounts are removed.
												</p>
												<div class="12u$" id="resend_email" style="display: flex;justify-content: center">
													<p id="demo"></p>
													<div id="send_email_button">
														<a href="javascript:void(0);" onclick="js_resend_verification_email(this)" class="button special">Resend Verification Email</a>
													</div>
												</div>
												<script type="text/javascript">
													function js_resend_verification_email(link) {
														// Prevent users from clicking more than once on the button and sending multiple emails
														link.onclick = function(event) {
															event.preventDefault();
														}
														// Resend verification email by using AJAX on this php file
														$("#send_email_button").load("php_resend_verification_email.php");
														return false;
													}
												</script>
												<?php
											}
										}
										else
										{
											echo "<h1>Error</h1>";
											echo "<p>Sorry, your account could not be found. Please <a href=\"login.php\">click here to try again</a>.</p>";
										}
									}
									else
									{
										?>
										<h3>Log In</h3>
										<form method="post" action="login.php" name="signupform" id="signupform">
											<div>
												<div class="6u$ 12u$(xsmall)">
													<input type="email" name="email" id="email" value="" placeholder="Email" />
												</div>
												<br>
												<div class="6u 12u$(xsmall)">
														<input type="password" name="password" id="password" value="" placeholder="Password" />
												</div>
												<br>
												<div class="12u$">
													<ul class="actions">
														<li><input type="submit" value="Login" class="special" /></li>
													</ul>
												</div>
											</div>
										</form>
										</ul>
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