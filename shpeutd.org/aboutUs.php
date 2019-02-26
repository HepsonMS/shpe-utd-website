<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>About Us</title>
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
				<!-- Note: The "styleN" class below should match that of the banner element. -->
					<header id="header" class="alt style2">
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

				<!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" class="style1">
						<div class="inner">
							<span class="image">
								<img src="images/pic01.jpg" alt="" />
							</span>
							<header class="major">
								<h1>Who We Are</h1>
							</header>
							<div class="content">
								<p>Origin and Purpose</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<header class="major">
										<h2>Mission</h2>
									</header>
									<p>SHPE changes lives by empowering the Hispanic community to realize their fullest potential and impacts the world through STEM awareness, access, support and development.</p>
								</div>
							</section>

						<!-- Two -->
							<section id="two" class="spotlights">
								<section>
									<a href="http://shpe2017.shpe.org/" class="image" target="_blank">
										<img src="images/pic08.jpg" alt="" width=100% data-position="center center" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Vision</h3>
											</header>
											<p>SHPE's vision is a world where Hispanics are highly valued and influential as the leading innovators, scientists, mathematicians and engineers.</p>
										</div>
									</div>
								</section>
								<section>
									<a href="http://shpe2017.shpe.org/" class="image" target="_blank">
										<img src="images/pic09.jpg" alt="" data-position="25% 25%" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>General Information</h3>
											</header>
											<p>The Society of Hispanic Professional Engineers (SHPE) was founded in Los Angeles, California, in 1974 by a group of engineers employed by the city of Los Angeles. Their objective was to form a national organization of professional engineers to serve as role models in the Hispanic community.</p>
											<p>The concept of Networking was the key basis for the organization. SHPE quickly established two student chapters to begin the network that would grow to encompass the nation as well as reach countries outside the United States. Today, SHPE enjoys a strong but independent network of professional and student chapters throughout the nation.</p>
											<ul class="actions">
												<li><a href="http://shpe.org/" class="button" target="_blank">Learn more</a></li>
											</ul>
										</div>
									</div>
								</section>
							</section>
						<!-- Three -->
							<section id="three">
								<div class="inner">
									<header>
										<h2>Our SHPE Constitution and Bylaws at UT Dallas</h2>
									</header>
									<ul class="actions">
										<li><a href="https://drive.google.com/open?id=0B6yM0pJL-zPESzE4RlJscTd6TlU&authuser=0" class="button next" target="_blank">Constitution</a></li>
										<br><br>
										<li><a href="https://drive.google.com/open?id=0B6yM0pJL-zPEa1hGZ3BiU2xFWjA&authuser=0" class="button next" target="_blank">Bylaws</a></li>
									</ul>
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