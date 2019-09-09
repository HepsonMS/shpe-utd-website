<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';
// Load database and email connector code
include "base.php";
// Helper functions for getting officer information
include "officer_helper.php"
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accept Membership Dues</title>
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
		<script>
			$(document).ready(function(){
				// Set only 1 of both dollar amount inputs to required
				jQuery(function ($) {
					var $inputs = $('input[name=cash_amount],input[name=venmo_amount]');
					$inputs.on('input', function () {
						// Set the required property of the other input to false if this input is not empty.
						$inputs.not(this).prop('required', !$(this).val().length);
					});
				});
				
				// Functionality to submit a payment and receive an email confirmation
				$('#payment_form').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"payment_submit.php",
						method:"POST",
						data:$(this).serialize(),
						success:function(data)
						{
							// Show alert message with results of the payment
							if(!window.alert(data))
							{
								// Refresh the page after the user clicks 'OK'
								window.location.reload();
							}
						}
					})
				});
			});
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
								<h1>Accept Membership Dues</h1>
							</header>
							<?php
							// for user to retry during errors
							$selfLink = "acceptDues.php";
							// set the time-zone to Central Time (for database to track what time this user registered)
							date_default_timezone_set('america/chicago');
							if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Officer']))
							{
								?>
								<form method="post" name="payment_form" id="payment_form">
									<div class="row 100%" style="display: flex;justify-content: center">
										<!--Membership Section-->
										<div class="row uniform">
											<div class="12u$" style="display: flex;justify-content: center">
												<label>Pay Membership Dues</label>
											</div>
											<div class="12u$">
												<hr>
											</div>
											<!--Payment Information-->
											<!--Cash-->
											<div class="6u 12u$(xsmall)" >
												<label for="cash_amount" style="width:50%;display:inline;"><font style="color:#00FF00;font-weight:bold;">Cash:&nbsp&nbsp</font>$</label>
												<input required style="width:50%;display:inline;" type="number" min="10.00" step="10.00" max="20" id="cash_amount" name="cash_amount" value="" placeholder="00" />
											</div>
											<!--Venmo-->
											<div class="6u$ 12u$(xsmall)">
												<label for="venmo_amount" style="width:50%;display:inline;"><font style="color:#48a8de;font-weight:bold;">Venmo:&nbsp&nbsp</font>$</label>
												<input required style="width:50%;display:inline;" type="number" min="10.00" step="10.00" max="20" id="venmo_amount" name="venmo_amount" value="" placeholder="00" />
											</div>
											<!--Login Credentials-->
											<div class="12u$">
												<input required type="email" name="email" id="email" value="" placeholder="UTD Email" />
											</div>
											<div class="12u$">
												<input required type="password" name="password" id="password" value="" placeholder="Password" />
											</div>
											<!--Submit Button-->
											<div class="12u$" style="display: flex;justify-content: center">
												<input type="submit" value="Confirm" class="special" />
											</div>
										</div>
									</div>
								</form>
								<?php
							}
							elseif(!empty($_SESSION['LoggedIn']))
							{
								echo "<h2>Error</h2>";
								echo "<p>Sorry, this page is only available to officers. Please go back or <a href='points.php'>click here</a> to return to your dashboard.</p>";
							}
							else
							{
								echo "<h2>Error</h2>";
								echo "<p>Sorry, you are not logged in. Please go back or <a href='login.php'>click here</a> to log in.</p>";
							}
							?>
							<div class="content">
								<b>Steps to accept dues:</b>
								<ol>
									<li>Verify the member's dues 1 of the 2 ways below:
										<ul>
											<?php echo "<li>Take the member's cash in hand (and deliver it to the Treasurer <b>".getOfficerFullName($dbcon, "Treasurer")."</b> later)</li>";?>
											<li>Verify the member's payment on Venmo to @SHPE-UTD </li>
										</ul>
									</li>
									<li>Request the member sign in, and they will receive an email receipt</li>
								</ol>
							</div>
							<?php
							echo "<strong>Note: </strong>Contact <b>".getOfficerFullName($dbcon, "Technology Chair")."</b> on our <a href=\"officers.php\">Officers Page</a> for any technical difficulties.";
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