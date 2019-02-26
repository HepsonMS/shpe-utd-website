<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Register</title>
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
						<a href="index.html" class="logo"><strong>SHPE</strong> <span>at UT Dallas</span></a>
						<nav>
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
					</nav>

				<!-- Main -->
					<div id="main" class="alt">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<header class="major">
										<h1>Account Registration</h1>
									</header>
									<div class="content">
										<p>Use your account to keep track of your points from being an active SHPE member at UT Dallas!
										</p>
									</div>
									<span class="image main"><img src="images/register.jpg" alt="" /></span>
									<p>
									<strong>Note: </strong>An online account is only available to our registered members. If you would like to join, please view our <a href="membership.html">Membership Page</a> and become a member! If you already are a member and are having trouble registering for your online account, please contact Hepson Sanchez on our <a href="officers.html">Officers Page</a>.
									</p>
                                                                        <?php
                                                                        if(!empty($_POST['username']) && !empty($_POST['password']))
                                                                        {
                                                                                $username = mysqli_real_escape_string($dbcon, $_POST['username']);
                                                                                $password = md5(mysqli_real_escape_string($dbcon, $_POST['password']));
                                                                                $cpassword = md5(mysqli_real_escape_string($dbcon, $_POST['cpassword']));
                                                                                $email = mysqli_real_escape_string($dbcon, $_POST['email']);
			 
                                                                                $checkusername = mysqli_query($dbcon, "SELECT * FROM users WHERE Username = '".$username."'");
                                                                                $checkemail = mysqli_query($dbcon, "SELECT * FROM users WHERE EmailAddress = '".$email."'");
                                                                                
                                                                                $selfLink = "register.php";
                                                                                
                                                                                if((mysqli_num_rows($checkusername) == 1) && (mysqli_num_rows($checkemail) == 1))
                                                                                {
                                                                                        $userRow = mysqli_query($dbcon, "SELECT * FROM users WHERE Username = '".$username."'");
                                                                                        $row = mysqli_fetch_array($userRow);
                                                                                        if(empty($row['Password']))
                                                                                        {
                                                                                                if($password == $cpassword)
                                                                                                {
                                                                                                        $updatename = mysqli_query($dbcon, "UPDATE users SET Password='".$password."' WHERE Username='".$username."'");
                                                                                                        if($updatename)
                                                                                                        {
                                                                                                                echo "<h1>Success!</h1>";
                                                                                                                echo "<p>Your account was successfully created. Please try to login through the <b>menu on the top right corner</b> of any page or <a href=\"index.html\">click here to return to return to the homepage</a>.</p>";
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                                echo "<h1>Error</h1>";
                                                                                                                echo "<p>Sorry, your registration failed. Please go back or <a href='".$selfLink."'>click here</a> try again.</p>";    
                                                                                                        }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                        echo "<h1>Error</h1>";
                                                                                                        echo "<p>Sorry, your passwords don't match. Please go back or <a href='".$selfLink."'>click here</a> try again.</p>";
                                                                                                }
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                echo "<h1>Error</h1>";
                                                                                                echo "<p>Sorry, that username is already active in the system. Please go back or <a href='".$selfLink."'>click here</a> try again.</p>";
                                                                                        }
                                                                                        
                                                                                }
                                                                                elseif(mysqli_num_rows($checkusername) != 1)
                                                                                {
                                                                                        echo "<h2>Error</h2>";
                                                                                        echo "<p>Sorry, that username isn't in the system. Please</a> go back or <a href='".$selfLink."'>click here</a> to try again.</p>";     
                                                                                }
                                                                                elseif(mysqli_num_rows($checkemail) != 1)
                                                                                {
                                                                                        echo "<h2>Error</h2>";
                                                                                        echo "<p>Sorry, that email isn't in the system. Please go back or <a href='".$selfLink."'>click here</a> try again.</p>";
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo "<h2>Error</h2>";
                                                                                        echo "<p>Sorry. Please go back or <a href='".$selfLink."'>click here</a> try again.</p>";
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                ?>
                                                                                <p>
                                                                                <h3>Please enter your details below</h3>
                                                                                </p>
                                                                                <form method="post" action="signup.php" name="signupform" id="signupform">
                                                                                        <div>
                                                                                                <div class="6u 12u$(xsmall)">
                                                                                                        <input type="text" name="username" id="username" value="" placeholder="Username" />
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="6u 12u$(xsmall)">
                                                                                                        <input type="password" name="password" id="password" value="" placeholder="Password" />
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="6u 12u$(xsmall)">
                                                                                                        <input type="password" name="cpassword" id="cpassword" value="" placeholder="Confirm Password" />
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="6u$ 12u$(xsmall)">
                                                                                                        <input type="email" name="email" id="email" value="" placeholder="Email" />
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="12u$">
                                                                                                        <ul class="actions">
                                                                                                                <li><input type="submit" value="Register" class="special" /></li>
                                                                                                        </ul>
                                                                                                </div>
                                                                                        </div>
                                                                                </form>
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