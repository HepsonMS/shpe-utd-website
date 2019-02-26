<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Change Password</title>
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

						<!-- One -->
                                                <section id="one">
                                                        <div class="inner">
                                                                <header class="major">
                                                                        <h1>Change Your Password</h1>
                                                                </header>
                                                                <?php
                                                                if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
                                                                {
                                                                        ?>
                                                                        <p>Please fill out the following short form</p>
                                                                        <?php
                                                                        if(!empty($_POST['currentpass']) && !empty($_POST['newpass']) && !empty($_POST['confirmpass']))
                                                                        {
                                                                                $currentpass = md5(mysqli_real_escape_string($dbcon, $_POST['currentpass']));
                                                                                
                                                                                $sessionemail = $_SESSION['EmailAddress'];
                                                                                $findemail = mysqli_query($dbcon, "SELECT * FROM users WHERE EmailAddress = '".$sessionemail."'");
                                                                                $userrow = mysqli_fetch_array($findemail);
                 
                                                                                if($userrow['Password'] == $currentpass)
                                                                                {
                                                                                        $password = md5(mysqli_real_escape_string($dbcon, $_POST['newpass']));
                                                                                        $cpassword = md5(mysqli_real_escape_string($dbcon, $_POST['confirmpass']));
                                                                                        
                                                                                        if($password == $cpassword)
                                                                                        {
                                                                                                $updatename = mysqli_query($dbcon, "UPDATE users SET Password='".$password."' WHERE EmailAddress='".$sessionemail."'");
                                                                                                echo "<h1>Success!</h1>";
                                                                                                echo "<p>Your password has been changed. You can return to your dashboard by <a href='points.php'>clicking here</a>.</p>";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                echo "<h3>Error</h3>";
                                                                                                echo "<p>Sorry, the new passwords do not match. Please go back or <a href='changepassword.php'>click here</a> to try again.</p>";
                                                                                        }
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo "<h3>Error</h3>";
                                                                                        echo "<p>Sorry, the \"current password\" you entered does not match your active password. Please go back or <a href='changepassword.php'>click here</a> to try again.</p>";
                                                                                }
                                                                        }
                                                                        elseif(!(empty($_POST['currentpass']) && empty($_POST['newpass']) && empty($_POST['confirmpass'])))
                                                                        {
                                                                                echo "<h3>Error</h3>";
                                                                                echo "<p>Sorry, the form is incomplete. Please go back or <a href='changepassword.php'>click here</a> to try again.</p>";
                                                                        }
                                                                        else
                                                                        {
                                                                                ?>
                                                                                <form method="post" action="changepassword.php" name="passwordform" id="passwordform">
                                                                                        <div>
                                                                                                <div class="6u$ 12u$(xsmall)">
                                                                                                        <input type="password" name="currentpass" id="currentpass" value="" placeholder="Current Password"/>
                                                                                                        <br>
                                                                                                        <input type="password" name="newpass" id="newpass" value="" placeholder="New Password"/>
                                                                                                        <br>
                                                                                                        <input type="password" name="confirmpass" id="confirmpass" value="" placeholder="Confirm Password"/>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="12u$">
                                                                                                        <input type="submit" value="Change Password" class="special" />
                                                                                                </div>
                                                                                        </div>
                                                                                </form>
                                                                                <?php
                                                                        }
                                                                }
                                                                else
                                                                {
                                                                        echo "<h3>Error</h3>";
                                                                        echo "<p>Sorry, you must be logged in. Please go back or <a href='login.php'>click here</a> to log in.</p>";
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