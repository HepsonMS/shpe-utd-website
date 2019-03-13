<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Newsletter</title>
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
                                                                <li><a href="login.php" class="button special">Log In</a></li>
                                                                <?php
                                                        }
                                                        ?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main" class="alt">
							<section id="one">
								<div class="inner">
									<!-- Begin Mailchimp Signup Form -->
									<div id="mc_embed_signup">
									<form action="https://shpeutd.us20.list-manage.com/subscribe/post?u=2d719e9a41d3800f0ce0cd6cd&amp;id=aa49373eb8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
										<div id="mc_embed_signup_scroll">
										<h2>Subscribe to our weekly mailing list</h2>
									<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
									<div class="mc-field-group">
										<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
									</label>
										<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
									</div>
									<div class="mc-field-group">
										<label for="mce-FNAME">First Name </label>
										<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
									</div>
									<div class="mc-field-group">
										<label for="mce-LNAME">Last Name </label>
										<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
									</div>
									<div class="mc-field-group">
										<label for="mce-MMERGE6">Middle Name </label>
										<input type="text" value="" name="MMERGE6" class="" id="mce-MMERGE6">
									</div>
									<div class="mc-field-group">
										<label for="mce-MMERGE8">Notes </label>
										<input type="text" value="" name="MMERGE8" class="" id="mce-MMERGE8">
									</div>
										<div id="mce-responses" class="clear">
											<div class="response" id="mce-error-response" style="display:none"></div>
											<div class="response" id="mce-success-response" style="display:none"></div>
										</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
										<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2d719e9a41d3800f0ce0cd6cd_aa49373eb8" tabindex="-1" value=""></div>
										<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
										</div>
									</form>
									</div>
									<!--End mc_embed_signup-->
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