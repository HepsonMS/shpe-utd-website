<?php
include "base.php";
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
                                                                <div class="content">
                                                                        <p>See your activities, points, and even the point leaderboard!
                                                                        </p>
                                                                </div>
                                                                <span class="image main"><img src="images/login.jpg" alt="" /></span>
                                                                <p>
                                                                <strong>Note: </strong>An online account is only available to our registered members. 
                                                                        If you would like to join, please view our <a href="membership.php">Membership Page</a> and become a SHPE member! 
                                                                        If you already are a member, please ask one of our <a href="officers.php">officers here</a> to help you.
                                                                </p>
                                                                <?php
                                                if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
                                                {
                                                        echo "<meta http-equiv='refresh' content='0;dashboard.php'/>";
                                                        ?>
                                                        <h3>Logged In</h3>
                                                        <a href="logout.php">Logout</a>
                                                        <?php
                                                }
                                                elseif(!empty($_POST['email']) && !empty($_POST['password']))
                                                {
                                                        $email = mysqli_real_escape_string($dbcon, $_POST['email']);
                                                        $password = md5(mysqli_real_escape_string($dbcon, $_POST['password']));
                                         
                                                        $checklogin = mysqli_query($dbcon, "SELECT * FROM users WHERE UTDEmail = '".$email."' AND Password = '".$password."'");
                                        
                                                        if($checklogin && mysqli_num_rows($checklogin) == 1)
                                                        {
                                                                $row = mysqli_fetch_array($checklogin);
                                                                $firstname = $row['FirstName'];
                                                                $lastname = $row['LastName'];
                                                                $isofficer = $row['Officer'];
                                                                $position = $row['Position'];
                                                                $points = $row['Points'];
                                                                $userid = $row['UserID'];
                                                                 
                                                                $_SESSION['FirstName'] = $firstname;
                                                                $_SESSION['LastName'] = $lastname;
                                                                $_SESSION['EmailAddress'] = $email;
                                                                $_SESSION['Officer'] = $isofficer;
                                                                $_SESSION['Position'] = $position;
                                                                $_SESSION['UserID'] = $userid;
                                                                $_SESSION['LoggedIn'] = 1;
                                                                 
                                                                echo "<h1>Success</h1>";
                                                                echo "<p>We are now redirecting you to the member area.</p>";
                                                                echo "<meta http-equiv='refresh' content='0' />";
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