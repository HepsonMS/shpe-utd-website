<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Reward Points</title>
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
										<h1>Reward Points to a Member</h1>
									</header>
									<div class="content">
										<p>Reward Members with Points for Being Active in SHPE!
										</p>
									</div>
									<span class="image main"><img src="images/rewardpoints.jpg" alt="" /></span>
									<p>
									<strong>Note: </strong>
                                                                                If you do not see your event listed, please register a new event by <a href="registerEvent.php">CLICKING HERE</a>.
                                                                                If you are having trouble rewarding points, please contact Hepson Sanchez on our <a href="officers.php">Officers Page</a>.
									</p>
                                                                        <?php
                                                                        date_default_timezone_set('america/chicago');
                                                                        if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Officer']))
                                                                        {
                                                                                $selfLink = "rewardPoints.php";
                                                                                if(!empty($_POST['event']))
                                                                                {
                                                                                        if(!empty($_POST['memberemail']) && !empty($_POST['memberpassword']))
                                                                                        {
                                                                                                $memberemail = mysqli_real_escape_string($dbcon, $_POST['memberemail']);
                                                                                                $memberpassword = md5(mysqli_real_escape_string($dbcon, $_POST['memberpassword']));
                                                                                                
                                                                                                $checklogin = mysqli_query($dbcon, "SELECT * FROM users WHERE UTDEmail = '".$memberemail."' AND Password = '".$memberpassword."'");
                                                                                                
                                                                                                if(mysqli_num_rows($checklogin) == 1)
                                                                                                {
                                                                                                        if($memberemail != $_SESSION['EmailAddress'])
                                                                                                        {
                                                                                                                $rowIndex = mysqli_real_escape_string($dbcon, $_POST['event']);
                                                                                                                $query = "SELECT EventID, Name, OnCampus, Location, Type, PointsWorth, PerHour, RegisteredDateTime, RegisteredByID 
                                                                                                                        FROM events 
                                                                                                                        WHERE RegisteredDateTime > '".$currentdate."'
                                                                                                                        ORDER BY RegisteredDateTime DESC";
                                                                                                                $result = $dbcon->query($query);
                                                                                                                $rowCounter = 0;
                                                                                                                while($rowIndex != $rowCounter)
                                                                                                                {
                                                                                                                        $rowCounter++;
                                                                                                                        $event = $result->fetch_assoc();
                                                                                                                }
                                                                                                                if(($event['PerHour'] == 0) || !empty($_POST['hours']))
                                                                                                                {
                                                                                                                        $rewardee = $checklogin->fetch_assoc();
                                                                                                                        $rewardeeid = $rewardee['UserID'];
                                                                                                                        $officerid = $_SESSION['UserID'];
                                                                                                                        $eventid = $event['EventID'];
                                                                                                                        if($event['OnCampus'] == 0)
                                                                                                                        {
                                                                                                                                $carpooled = $_POST['carpooled'];
                                                                                                                                if($carpooled == 1)
                                                                                                                                {
                                                                                                                                        $points = 5;
                                                                                                                                }
                                                                                                                                else
                                                                                                                                {
                                                                                                                                        $points = 0;
                                                                                                                                }
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                                $carpooled = 0;
                                                                                                                        }
                                                                                                                        if($event['PerHour'] == 1)
                                                                                                                        {
                                                                                                                                $hours = $_POST['hours'];
                                                                                                                                $points = $points + ($hours * $event['PointsWorth']);
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                                $hours = 0;
                                                                                                                                $points = $points + $event['PointsWorth'];
                                                                                                                        }
                                                                                                                        $rewarddatetime = date("Y\-m\-d H\:i\:s");
                                                                                                                        $reward = mysqli_query($dbcon, "INSERT INTO rewards (RecipientID, OfficerID, EventID, Carpooled, Hours, Points, RewardDateTime) 
                                                                                                                                VALUES('".$rewardeeid."', '".$officerid."', '".$eventid."', '".$carpooled."', '".$hours."', '".$points."', '".$rewarddatetime."')");
                                                                                                                        if($reward)
                                                                                                                        {
                                                                                                                                echo "<h2>Success</h2>";
                                                                                                                                echo "<h3>".$points." points were rewarded to ".$rewardee['FirstName']." ".$rewardee['LastName']."</h3>
                                                                                                                                <p>Please <a href='".$selfLink."'>click here</a> to reward more points.
                                                                                                                                <br>
                                                                                                                                Otherwise, please <a href='dashboard.php'>click here</a> to return to your dashboard.</p>";
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                                echo "<h2>Error</h2>";
                                                                                                                                echo "<p>Sorry, points could not be rewarded for an unknown reason. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                                        }
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                        echo "<h1>Error</h1>";
                                                                                                                        echo "<p>Sorry, you selected an event with points based on hours but did not specify a number of hours. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                                }
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                                echo "<h2>Error</h2>";
                                                                                                                echo "<p>Sorry, officers are not allowed to reward points to themselves. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                        }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                        echo "<h2>Error</h2>";
                                                                                                        echo "<p>Sorry, the member account could not be found. Either it does not exists or the login credentials were wrong.
                                                                                                        <br>
                                                                                                        If the SHPE member does not have an account, please <a href='registerMember.php'>click here</a> to register a new account.
                                                                                                        <br>
                                                                                                        Otherwise, please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                }
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                echo "<h2>Error</h2>";
                                                                                                echo "<p>Sorry, the member login form is incomplete. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                        }
                                                                                }
                                                                                else
                                                                                {
                                                                                        ?>
                                                                                        <form method="post" action="rewardPoints.php" name="rewardForm" id="rewardForm">
                                                                                                <h3>1) Select the event(s) the member attended</h3>
                                                                                                <?php
                                                                                                date_default_timezone_set('america/chicago');
                                                                                                $currentdate = date("Y\-m\-d");
                                                                                                $query = "SELECT Name, OnCampus, Location, Type, PointsWorth, PerHour, RegisteredDateTime, RegisteredByID 
                                                                                                        FROM events 
                                                                                                        WHERE RegisteredDateTime > '".$currentdate."'
                                                                                                        ORDER BY RegisteredDateTime DESC";
                                                                                                $result = $dbcon->query($query);
                                                                                                ?>
                                                                                                <?php
                                                                                                if($result->num_rows > 0)
                                                                                                {
                                                                                                        echo "<h5>Displaying Active Events for Today</h5>";
                                                                                                        echo "<div class='table-wrapper'>";
                                                                                                        echo "<table>
                                                                                                                <thead>
                                                                                                                        <tr>
                                                                                                                                <th>Select</th>
                                                                                                                                <th>Name</th>
                                                                                                                                <th>Type</th>
                                                                                                                                <th>Location</th>
                                                                                                                                <th>Date</th>
                                                                                                                                <th>Points Worth</th>
                                                                                                                                <th>Registered By</th>
                                                                                                                        </tr>
                                                                                                                </thead>
                                                                                                                <tbody>";
                                                                                                        $rowcounter = 1;
                                                                                                        while($row = $result->fetch_assoc())
                                                                                                        {
                                                                                                                $queryEventCreator = "SELECT FirstName, LastName
                                                                                                                        FROM users
                                                                                                                        WHERE UserID = '".$row["RegisteredByID"]."'";
                                                                                                                $resultEventCreator = $dbcon->query($queryEventCreator);
                                                                                                                $rowEventCreator = $resultEventCreator->fetch_assoc();
                                                                                                                $formatedRegisteredBy = $rowEventCreator["FirstName"]." ".$rowEventCreator["LastName"];
                                                                                                                
                                                                                                                if($row['OnCampus'] == 1)
                                                                                                                {
                                                                                                                        $formatedloc = "UTD: ".$row["Location"];
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                        $formatedloc = $row["Location"];
                                                                                                                }
                                                                                                                $formateddate = date("M jS\, Y", strtotime($row["RegisteredDateTime"]));
                                                                                                                echo "<tr>
                                                                                                                        <td><input type='radio' id='radio[".$rowcounter."]' name='event' value='".$rowcounter."'>
                                                                                                                                <label for='radio[".$rowcounter."]'></label></td>
                                                                                                                        <td>".$row["Name"]."</td>
                                                                                                                        <td>".$row["Type"]."</td>
                                                                                                                        <td>".$formatedloc."</td>
                                                                                                                        <td>".$formateddate."</td>
                                                                                                                        <td>".$row["PointsWorth"]."";
                                                                                                                        if($row["PerHour"] == 1)
                                                                                                                        {
                                                                                                                                echo " per hour";
                                                                                                                        }
                                                                                                                                        echo "</td>
                                                                                                                        <td>".$formatedRegisteredBy."</td>
                                                                                                                </tr>";
                                                                                                                $rowcounter++;
                                                                                                        }
                                                                                                        echo "</tbody>";
                                                                                                        echo "</table>";
                                                                                                        echo "</div>";
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                        echo "No events to display";
                                                                                                }
                                                                                                ?>
                                                                                                <p>
                                                                                                <h3>2) Please enter the details of the member below</h3>
                                                                                                <?php
                                                                                                        $currenttime = date("g\:i\ a");;
                                                                                                        echo "<h5>Time of Reward: ".$currenttime."</h5>";
                                                                                                        echo "<h5>Rewarded By: ".$_SESSION['FirstName']." ".$_SESSION['LastName']."</h5>";
                                                                                                ?>
                                                                                                </p>
                                                                                                
                                                                                                <div class="6u 12u$(xsmall)">
                                                                                                        Hours Attended (if per-hour event): 
                                                                                                        <input type="number" name="hours" id="hours" value="" placeholder="Hours"
                                                                                                                min="1" max="8" step="0.5" style="background-color: rgb(42,47,74)"/>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                        Did you carpool other members? (if off-campus event): 
                                                                                                        <input type="checkbox" id="carpooled" name="carpooled" value=1>
                                                                                                        <label for="carpooled"></label>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                        <input type="email" name="memberemail" id="memberemail" value="" placeholder="Email of Member" />
                                                                                                        <br>                                                                                                      
                                                                                                        <input type="password" name="memberpassword" id="memberpassword" value="" placeholder="Password of Member" />
                                                                                                        <br>
                                                                                                        <div class="12u$">
                                                                                                                <ul class="actions">
                                                                                                                        <li><input type="submit" value="Reward Points" class="special" /></li>
                                                                                                                </ul>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </form>
                                                                                        <?php
                                                                                }
                                                                        }
                                                                        elseif(!empty($_SESSION['LoggedIn']) && ($_SESSIONS['Officer'] == 0))
                                                                        {
                                                                                echo "<h2>Error</h2>";
                                                                                echo "<p>Sorry, this page is only available to officers. Please go back or <a href='points.php'>click here</a> to return to your dashboard.</p>";
                                                                        }
                                                                        else
                                                                        {
                                                                                echo "<h2>Error</h2>";
                                                                                echo "<p>Sorry, you are not logged in. Please go back or <a href='login.php'>click here</a> to log in.</p>";
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