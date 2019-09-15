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
								<h1>Our Past Officers</h1>
							</header>
							<div class="content">
								<p>School Year 2016 - 2017</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
								<div class="inner">
								</div>
							</section>

						<!-- Two -->
							<header>
								<br>
								<h2>&nbsp&nbspExecutive Officers</h2>
							</header>
							<section id="two" class="spotlights">
								<section>
									<img src="images/officers(16-17)/citlali.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Citlali Barron</h3>
												<h4>President</h4>
											</header>
											<p>I was a Junior, Computer Science student. I have been involved in SHPE since my freshmen year and I was the current President of SHPE UTD.</p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/denisse.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Denisse Amador</h3>
												<h4>Vice-President</h4>
											</header>
											<p>I am from Dallas, Texas and majoring in Mathematics. I graduated May 2018 and  I was the Vice President for SHPE UTD. I hope to continue to help SHPE grow and obtain an internship this summer.</p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/argelia.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Argelia Simon</h3>
												<h4>Secretary</h4>
											</header>
											<p>I was raised in Dallas and I was a junior majoring in mechanical engineering and I was the Secretary for SHPE UTD. I interned at URS Corporation, which is a civil engineering firm here in Dallas at the age of 17, and was a math tutor for the Academic Bridge Program. I was also an Undergraduate Success Scholar at UTD. During my free time I like to hang out with friends and relax. One of my hobbies is to play the violin. My goal this year is to get an engineering internship.</p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/dalia.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Dalia Franco</h3>
												<h4>Treasurer</h4>
											</header>
											<p>I was raised in Dallas Texas, was a junior majoring in mathematics. I became involved in SHPE Jr. in high school and was the treasurer for the UTD chapter.</p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/gabriel.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Gabriel Barron</h3>
												<h4>SHPE Jr. Chair</h4>
											</header>
											<p>I'm very social, I love meeting new people and making friends. I am excited to see what UTD has to offer! 
											<br><br>
											B.S. Information Technology and Systems, 2019<br>
											Diversity Outreach Team Member<br>
											Hispanic Engagement Achievement Team<br> 
											SHPE Jr. Chair, 2016 </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/jacob.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Jacob Perez</h3>
												<h4>Corporate Liaison</h4>
											</header>
											<p></p>
										</div>
									</div>
								</section>
							</section>
							<header>
								<br>
								<h2>&nbsp&nbspAppointed Officers</h2>
							</header>
							<section id="three part 2" class="spotlights">
								<section>
									<img src="images/officers(16-17)/jenna.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Jenna Lobisser</h3>
												<h4>School Affairs Chair</h4>
											</header>
											<p></p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/jennifer.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Jennifer Medina</h3>
												<h4>Community Chair Affairs</h4>
											</header>
											<p></p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/magaly.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Magaly Narvaez</h3>
												<h4>SHPE Jr. Chair</h4>
											</header>
											<p>I was a sophomore studying supply chain management. I enjoy working as a SHPE Jr. Representative and encouraging underrepresented minority high school students to attend college. I hope to make a difference in their lives and look forward to helping in anything I can.</p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/reilly.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Reilly Martinez</h3>
												<h4>Alumni/Graduate Liaison</h4>
											</header>
											<p></p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/max.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Max Leon</h3>
												<h4>Public Relations</h4>
											</header>
											<p></p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers(16-17)/nohemi.jpg" alt="" data-position="center center" width=100%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Nohemi Jimenez</h3>
												<h4>Recruitment & Retention</h4>
											</header>
											<p>I was transfer student from a small community college located in Corsicana, Tx, about 60 miles south of Dallas. I am very excited to be part of UTD as my 4 year university where I plan to major in Mechanical Engineering. I am a first generation college student, who has to set the standard high for my 2 younger sisters. I am excited yet nervous to be part of UTD but I know that I will succeed in my plans as I make various friends along the way!</p>
										</div>
									</div>
								</section>
							</section>
						<!-- Three -->
							<section id="three">
								<div class="inner">
									<header class="major">
										<h2>Want to become an officer?</h2>
									</header>
									<p>Join the Freshmen RoundTable to make an impact alongside an officer mentor.</p>
									<ul class="actions">
										<li><a href="mailto:exl170030@utdallas.edu?Subject=I%20would%20like%20to%20join%20the%20Freshmen%20RoundTable" class="button" target="_blank">Contact Emily Lomas</a></li>
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