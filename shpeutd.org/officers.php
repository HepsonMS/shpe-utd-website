<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Officers</title>
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
					<section id="banner" class="style2">
						<div class="inner">
							<span class="image">
								<img src="images/pic07.jpg" alt="" />
							</span>
							<header class="major">
								<h1>Our Officers</h1>
							</header>
							<div class="content">
								<p>Current and Past</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<h2>Make sure to visit:</h2>
										<a href="officers(16-17).php" class="button next">Hall of Past Officers</a>
								</div>
							</section>

						<!-- Two -->
							<header>
								<br>
								<h2>&nbsp&nbspExecutive Officers</h2>
							</header>
							<section id="two" class="spotlights">
								<?php
									function create_officer($name, $position, $email, $img){
										?>
										<section>
											<img src="images/officers/<?php echo $img;?>" alt="" data-position="center center" height=30% width=30%/>
											<div class="content">
												<div class="inner">
													<header class="major">
														<h3><?php echo $name;?></h3>
														<h4><?php echo $position;?></h4>
													</header>
													<p>
													<!-- Biography goes here-->
													<b>Email:</b>
													<a href="mailto:<?php echo $email;?>" target="_blank"><?php echo $email;?></a> 
          				                                  </p>
                              				          </div>
											</div>
										</section>							
										<?php
									}
									$result = mysqli_query($dbcon, "SELECT * FROM `officers`");
									if($result) 
										while($row = $result->fetch_row()) 
											create_officer($row[2], $row[1], $row[3], $row[4]);

								?>
							</section>
						<!-- Three -->
							<section id="three">
								<div class="inner">
									<header class="major">
										<h2>Want to become an officer?</h2>
									</header>
									
									<p>Join the Freshmen RoundTable to make an impact alongside an officer mentor.</p>
									<ul class="actions">
										<?php
											$result = mysqli_query($dbcon, "SELECT * FROM `officers` WHERE `Position` = 'President';");
												$presidentInfo= $result->fetch_row();

											?>
										<li><a href="mailto:<?php echo $presidentInfo[3];?>?Subject=I%20would%20like%20to%20join%20the%20Freshmen%20RoundTable" class="button" target="_blank">Contact <?php echo $presidentInfo[2];?></a></li>
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
