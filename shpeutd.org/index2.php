<?php
include "base.php";
?>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: LoginMySQL.php");
    exit;
}
?>
<!DOCTYPE HTML>
<html>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<head>
		<title>SHPE at UT Dallas</title>
		<meta name="description" content="Official Website of The Society of Hispanic Professional Engineers at The Unviersity of Texas at Dallas. 
                        Welcome! We are an organization dedicated to improving the lives and professional experience of our members. 
                        We are largely Hispanic but everyone is invited to join and every engineering student can benefit from being a part of SHPE at UTD." />
		<meta name="keywords" content="SHPE Society of Hispanic Professional Engineers UTD UT University of Texas at Dallas Engineering" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
                <meta name="google-site-verification" content="lEbCi5wOXYaBC7dc6Fiz2wVl9oxlJw7oG6Pv5r7LMrw" />
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<a href="index.php" class="logo"><strong>SHPE</strong> <span>at UTD</span></a>
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
					<section id="banner" class="major">
						<div class="inner">
							<header class="major">
								<h1>Hi, we are SHPE at UT Dallas</h1>
							</header>
							<div class="content">
								<p>The Society of Hispanic Professional Engineers</p>
								<ul class="actions">
									<li><a href="#one" class="button next scrolly">This Way</a></li>
								</ul>
							</div>
						</div>
					</section>
                                        <section>
                                                <center>
                                                <!--<video height="600" width=100% controls>
                                                        <source src="images/UTD_chant(RLDC2017).mp4" type="video/mp4">
                                                        Your browser does not support HTML5 video.
                                                </video>-->
                                                </center>
                                        </section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one" class="tiles">
								<article>
									<span class="image">
										<img src="images/pic01.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="aboutUs.php" class="link">Who We Are</a></h3>
										<p>Origin and Purpose</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/pic02.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="officers.php" class="link">Our Officers</a></h3>
										<p>Current and Past</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/pic03.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="newsletter.php" class="link">Newsletter</a></h3>
										<p>What's New</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/pic04.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="calendar.php" class="link">Calendar</a></h3>
										<p>Stay Up To Date</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/pic05.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="shpejr.php" class="link">SHPE Jr.</a></h3>
										<p>For Prospective Engineers</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/pic06.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="membership.php" class="link">Membership</a></h3>
										<p>Join the Family</p>
									</header>
								</article>
                                                                <article>
									<span class="image">
										<img src="images/resources.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="resources.php" class="link">Resources for Students</a></h3>
										<p>Scholarships and Grants</p>
									</header>
								</article>
                                                                <article>
									<span class="image">
										<img src="images/sponsors.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="sponsors.php" class="link">Sponsors</a></h3>
										<p>Thank You</p>
									</header>
								</article>
                                                                </article>
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
											<li><a href="https://www.instagram.com/shpeutd/" class="icon alt fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>
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