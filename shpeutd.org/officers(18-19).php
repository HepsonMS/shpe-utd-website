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
								<section>
									<img src="images/officers/hepson.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Hepson Sanchez</h3>
												<h4>President</h4>
											</header>
											<p> Hepson Manuel Sanchez is a Junior studying Computer Science with the ultimate goal of helping his family and community rise from financial and political struggles.
                                                                                        Aside from President of SHPE, he had the pleasure of serving as Director of Technology for both the Artificial Intelligence Society (AIS) at UTD and Association of Latino Professionals For America
                                                                                        (ALPFA) at UTD. 
                                                                                        Currently, Hepson is involved with the League of United Latin American Citizens (LULAC) and serves as the Community Service Chair for the Academic Bridge Program (ABP).
                                                                                        During his free time, he can be found playing guitar, fantasizing about racing in Tokyo Drift, and spending time with the special people around him. 
                                                                                        <br><br>
											He became president of SHPE for his passion for his culture and people. His desire is to help other minorities achieve their dreams and believes that SHPE is the answer.
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:hepson.sanchez@utdallas.edu" target="_blank">hepson.sanchez@utdallas.edu</a> 
                                                                                        </p>
                                                                                </div>
									</div>
								</section>
								<section>
									<img src="images/officers/jose2.png" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Jose Vargas</h3>
												<h4>Vice-President</h4>
											</header>
											<p>
                                                                                        Experience: FEA of Reverse Shoulder Arthroplasty, Joe W. Fly Co., Inc., Human-Enabled Robotic Technology (Hero) Lab, Biomedical Engineering Society, AES Mentor
											<br><br>
											Hobbies: News, Soccer, Table Tennis, Exploring
											<br><br>
											Interests: Orthopedics, Haptics, Genomics, Environmental Science, Nuclear Science
											<br><br>
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:Jose.Vargas2@utdallas.edu" target="_blank">Jose.Vargas2@utdallas.edu</a> 
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/samantha.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Samantha Montoya</h3>
												<h4>Secretary</h4>
											</header>
											<p>My name is Samantha and I am currently a junior majoring in mathematics. I joined SHPE during my freshman year and am glad I am part of the SHPE familia!
                                                                                        I love volunteering, watching movies, and hanging out with friends and family. SHPE has given me opportunities like being the Academic Chair, attending SHPE Nationals, and 
                                                                                        organizing SHPE events, which all allowed me to grow as a leader.
                                                                                        My main goal is to increase membership participation through better communication and informing everyone about all of our events!
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:Samantha.Montoya@utdallas.edu" target="_blank">Samantha.Montoya@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/mathew.png" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Matthew Vazquez</h3>
												<h4>Treasurer</h4>
											</header>
											<p>Matthew Vazquez is a junior Terry Scholar double majoring in actuarial science and mathematics with a specialization in statistics. He plan’s on continuing his higher-level education by working towards a master’s degree in actuarial science by utilizing the fast track program UT Dallas has to offer. 
                                                                                        He joined SHPE during the second semester of his freshman year and has enjoyed not only volunteering and promoting SHPE but also allowing SHPE to help him grow both as an individual and as a leader. 
                                                                                        Aside from being the treasurer for SHPE, he is also the Academic Coordinator and Enrichment Advisor for the Terry Scholars at UTD, and serves as a mentor and mathematics tutor for the Academic Bridge Program  (ABP). 
                                                                                        He is also involved in other major related organizations including the Actuarial Student Association (ASA). 
                                                                                        During his free time, he enjoys being in the gym pumping some iron, playing guitar, or studying for his actuarial exam.
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:Matthew.Vazquez@utdallas.edu" target="_blank">Matthew.Vazquez@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/carlosm.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Carlos Morin</h3>
												<h4>SHPE Jr. Chair</h4>
											</header>
											<p>I am junior studying Mechanical Engineering born and raised in Dallas, TX.
                                                                                        My parents are two Mexican immigrants from Guanajuato. 
                                                                                        I am also the oldest of 30 plus younger cousins, on my mom side. 
                                                                                        On my father side, I am somewhere around the middle, but I was the first on both sides to graduation and attend college.
                                                                                        My goal for this semester will be to help as many students understand the importance of education after high school. 
                                                                                        Whether it's a STEM-related major or otherwise. 
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:Carlos.MorinGuzman@utdallas.edu" target="_blank">Carlos.MorinGuzman@utdallas.edu</a>
             

                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/carla.png" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Karla Roman</h3>
												<h4>Academic Chair</h4>
											</header>
											<p>My name is Karla Roman and I am currently pursuing a Bachelor’s in Computer Science at the University of Texas at Dallas.
                                                                                        I am a first-generation Latina whose goal is to inspire other people within my community to continue onto higher education and to never stop learning. 
                                                                                        I chose UTD because of its rigorous Computer Science program and because commuting makes it possible for me to not only grow professionally, but help my family back home. 
                                                                                        Furthermore, I specifically chose computer science because of my love for learning, which is what computer science is all about – continuous learning and innovation. 
                                                                                        With my passion for learning I hope to expand my horizons not only professionally, but give back that passion to younger generations.
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:kvr160030@utdallas.edu" target="_blank">kvr160030@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
                                                                <section>
									<img src="images/officers/emily.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Emily Lomas</h3>
												<h4>Career Liaison</h4>
											</header>
											<p>Emily Lomas is the Career Liaison for SHPE UTD. Doing research in high school led her to continue it at UTD with UT Southwestern where she was finding how collagen formed in the eye and the Texas Biomedical Device Center where she constructed devices for PTSD research. 
                                                                                        She was a 2016 NASA High School Aerospace Scholar and is now a Terry Scholar Sophomore studying Information Technology Systems. She recently interned with Interconnect Wiring where she dealt with engineering drawings and did market research.
                                                                                        She likes interacting with others and continuously looks for networking opportunities for our members.
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:exl170030@utdallas.edu" target="_blank">exl170030@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/arath.png" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Arath Paneet</h3>
												<h4>Recruitment and Retention</h4>
											</header>
											<p>Hey y’all, my name is Arath and I’m the new Recruitment and Membership Retainment chair for SHPE this school year. 
                                                                                        I am a senior mechanical engineering student and finance minor.
                                                                                        I want to personally invite everyone to come on out to our events to get to meet new people, have a good time, and make lasting connections.
                                                                                        I’m looking forward to having a fun year, and getting to know a lot of new faces.
                                                                                        <br>
                                                                                        <p>Whoosh 19’
											<br><br>
                                                                                        <b>Email:</b> <a href="mailto:axp155830@utdallas.edu" target="_blank">axp155830@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/diego.png" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Diego Narvaez</h3>
												<h4>SHPE Jr. Chair</h4>
											</header>
											<p>Hello all, my name is Diego Narvaez and I am a junior in biomedical engineering. 
                                                                                        In SHPE I am one of the SHPE Jr. Chairs along with Carlos. SHPE Jr. Is a volunteer program where we go to a highschool where we have a SHPE Jr. 
                                                                                        Chapter and help the students with anything from tutoring to college applications. The main purpose is to help them get motivated to go and get accepted to college. 
                                                                                        Besides SHPE, I am also the Vice President of Lambda Theta Phi Latin Fraternity Inc. and I work in the Multicultural Center as a Student Success Assistant. 
                                                                                        If you have any questions, feel free to reach out, I am here to help!
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:Diego.Narvaez@utdallas.edu" target="_blank">Diego.Narvaez@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/magaly.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Magaly Narvaez</h3>
												<h4>Alumni Liaison</h4>
											</header>
											<p>
                                                                                        <br><br>
                                                                                        <b>Email:</b> <a href="mailto:Magaly.Narvaez@utdallas.edu" target="_blank">Magaly.Narvaez@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/tony.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Tony Gutierrez</h3>
												<h4>School Affairs</h4>
											</header>
											<p>My name is Anthony (Tony) Matthew Gutierrez. I was former secretary and now School Affair for SHPE. 
                                                                                        I’m majoring in Mechanical engineering with a minor in Computer Science. I currently work in HBS lab underneath professor Tadesse.
                                                                                        Please don’t be shy to speak with me if you have any question.
											<br><br>
                                                                                        <b>Email:</b> <a href="mailto:amg160230@utdallas.edu" target="_blank">amg160230@utdallas.edu</a>
                                                                                        </p>
										</div>
									</div>
								</section>
								<section>
									<img src="images/officers/maria.jpg" alt="" data-position="center center" height=30% width=30%/>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>Maria Munoz</h3>
												<h4>Public Relations</h4>
											</header>
											<p>
											<br><br>
                                                                                        <b>Email:</b> <a href="mailto:mcm150230@utdallas.edu" target="_blank">mcm150230@utdallas.edu</a>
                                                                                        </p>
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
										<li><a href="mailto:hepson.sanchez@utdallas.edu?Subject=I%20would%20like%20to%20join%20the%20Freshmen%20RoundTable" class="button" target="_blank">Contact Hepson Sanchez</a></li>
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