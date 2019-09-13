<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Membership</title>
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
					<section id="banner" class="style6">
						<div class="inner">
							<span class="image">
								<img src="images/pic06.jpg" alt="" />
							</span>
							<header class="major">
								<h1>Membership</h1>
							</header>
							<div class="content">
								<p>Join The Family</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main" class="alt">
						<section id="one">
							<div class="inner">
								<h3>How to Join</h3>
									<ol>
										<li>Fill out our membership form</li>
										<li>Pay the local dues below</li>
										<li>Join SHPE (UTD) on <a href="https://orgsync.com/16151/chapter" target="_blank">Orgsync</a></li>
										<li>Register with SHPE (national) on <a href="http://www.shpe.org/join-shpe" target="_blank">SHPEConnect</a></li>
										<li>Pay the national dues below</li>
									</ol>
							</div>
						</section>
						<section id="two">
							<div class="inner">
								<h3>Membership Dues</h3>
								<div class="table-wrapper">
									<table>
										<thead>
											<tr>
												<th>Type</th>
												<th>Price</th>
												<th>Payment Options</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Local (UTD only)</td>
												<td>$10 per Semester</td>
												<td>
													<ul>
														<li>
															<strong>Cash</strong>
															<br>
															Contact Jaquelin Rojas (Treasurer)
															<br>
																E-Mail: <a href="mailto:jxr175030@utdallas.edu?Subject=I%20Would%20Like%20to%20Pay%20my%20Membership%20Dues" target="_blank">jxr175030@utdallas.edu</a>
														</li>
														<li>
															<strong>Online</strong>
															<br>
															Venmo: pay at <u>@SHPE-UTD</u>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>National</td>
												<td>$10 Annually</td>
												<td>
													<ul>
														<li>
															<strong>Online</strong>
															<ol>
																<li>Go to <a href="http://www.shpe.org/join-shpe" target="_blank">shpe.org/join-shpe</a></li>
																<li>Click "Join Now"</li>
																<li>Either log in or follow the registration process</li>
																<li>Click "My Membership"</li>
															</ol>
														</li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
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