<?php
include "base.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Sponsors</title>
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
						<a href="index.html" class="logo"><strong>SHPE</strong> <span>at UT Dallas</span></a>
						<nav>
                                                        <div class="greeting">
                                                                <?php
                                                                        if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
                                                                        {
                                                                                echo "<i>Hello, </i>";
                                                                                echo "<i>".$_SESSION['Username']."</i>";
                                                                        }
                                                                ?>
                                                        </div>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<ul class="links">
							<li><a href="index.html">Home</a></li>
                                                        <li><a href="newsletter.html">Newsletter</a></li>
							<li><a href="calendar.html">Calendar</a></li>
							<li><a href="#contact">Contact</a></li>
						</ul>
                                                
                                                <?php
                                                if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
                                                {
                                                        ?>
                                                        <h3>Logged In</h3>
                                                        <a href="logout.php">Logout</a>
                                                        <?php
                                                }
                                                elseif(!empty($_POST['username']) && !empty($_POST['password']))
                                                {
                                                        $username = mysqli_real_escape_string($dbcon, $_POST['username']);
                                                        $password = md5(mysqli_real_escape_string($dbcon, $_POST['password']));
                                         
                                                        $checklogin = mysqli_query($dbcon, "SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
                                        
                                                        if(mysqli_num_rows($checklogin) == 1)
                                                        {
                                                                $row = mysqli_fetch_array($checklogin);
                                                                $email = $row['EmailAddress'];
                                                                 
                                                                $_SESSION['Username'] = $username;
                                                                $_SESSION['EmailAddress'] = $email;
                                                                $_SESSION['LoggedIn'] = 1;
                                                                 
                                                                echo "<h1>Success</h1>";
                                                                echo "<p>We are now redirecting you to the member area.</p>";
                                                                echo "<meta http-equiv='refresh' content='0' />";
                                                        }
                                                        else
                                                        {
                                                                echo "<h1>Error</h1>";
                                                                echo "<p>Sorry, your account could not be found. Please <a href=\"sponsors(loginTest).php\">click here to try again</a>.</p>";
                                                        }
                                                }
                                                else
                                                {
                                                        ?>
                                                        <ul class="actions vertical">
                                                                <li><h4>Log In</h4></li>
                                                                <form method="post" action="sponsors(loginTest).php" name="loginform" id="loginform">
                                                                        <li><input type="text" name="username" id="username" value="" placeholder="Username"/></li>
                                                                        <input type="password" name="password" id="password" value="" placeholder="Password"/>
                                                                        <li><input type="submit" name="login" id="login" value="Submit"/></li>
                                                                </form>
                                                        </ul>
                                                        <?php
                                                }
                                                ?>
                                                
					</nav>

				<!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" class="style2">
						<div class="inner">
							<span class="image">
								<img src="images/sponsors.jpg" alt="" />
							</span>
							<header class="major">
								<h1>Sponsors</h1>
							</header>
							<div class="content">
								<p>Thank You</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">
                                                <p>Page currently under construction</p>
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