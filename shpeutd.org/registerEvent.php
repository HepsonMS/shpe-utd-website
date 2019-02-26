<?php
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Register New Event</title>
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
										<h1>New Event Registration</h1>
									</header>
									<div class="content">
										<p>Create a new event in order to reward members with points for attending!
										</p>
									</div>
									<span class="image main"><img src="images/newevent.jpg" alt="" /></span>
									<p>
									<strong>Note: </strong>Please check the list of events below, and make sure another officer did not already create the event you had in mind. 
                                                                                There can only be <strong>ONE</strong> instance of every event.
                                                                                <br>
                                                                                Furthermore, dates can not be changed, so events should be <strong>registered on the same day they take place</strong>.
                                                                                <br>
                                                                                If you are having trouble registering your event, please contact Hepson Sanchez on our <a href="officers.php">Officers Page</a>.
									</p>
                                                                        <?php
                                                                        date_default_timezone_set('america/chicago');
                                                                        if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Officer']))
                                                                        {
                                                                                $currentdate = date("Y\-m\-d H\:i\:s");
                                                                                $monthago = date("Y\-m\-d", strtotime("-1 month"));
                                                                                $query = "SELECT Name, OnCampus, Location, Type, PointsWorth, PerHour, RegisteredDateTime, RegisteredByID 
                                                                                        FROM events 
                                                                                        WHERE RegisteredDateTime BETWEEN '".$monthago."' AND '".$currentdate."'
                                                                                        ORDER BY RegisteredDateTime DESC";
                                                                                $result = $dbcon->query($query);
                                                                                ?>
                                                                                <h4>Displaying Last 3 Events within Past Month (Newest at the Top)</h4>
                                                                                <?php
                                                                                $eventcounter = 0;
                                                                                if($result->num_rows > 0)
                                                                                {
                                                                                        echo "<div class='table-wrapper'>";
                                                                                        echo "<table>
                                                                                                <thead>
                                                                                                        <tr>
                                                                                                                <th>Name</th>
                                                                                                                <th>Type</th>
                                                                                                                <th>Location</th>
                                                                                                                <th>Date</th>
                                                                                                                <th>Points Worth</th>
                                                                                                                <th>Registered By</th>
                                                                                                        </tr>
                                                                                                </thead>
                                                                                                <tbody>";
                                                                                        while(($row = $result->fetch_assoc()) && ($eventcounter < 3))
                                                                                        {
                                                                                                if($row['OnCampus'] == 1)
                                                                                                {
                                                                                                        $formatedloc = "UTD: ".$row["Location"];
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                        $formatedloc = $row["Location"];
                                                                                                }
                                                                                                $formateddate = date("M jS\, Y", strtotime($row["RegisteredDateTime"]));
                                                                                                $queryUsers = "SELECT UserID, FirstName, LastName
                                                                                                                FROM users
                                                                                                                WHERE UserID = '".$row["RegisteredByID"]."'";
                                                                                                $resultUsers = $dbcon->query($queryUsers);
                                                                                                $rowUsers = $resultUsers->fetch_assoc();
                                                                                                $registeredByName = $rowUsers['FirstName']." ".$rowUsers['LastName'];
                                                                                                echo "<tr>
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
                                                                                                        <td>".$registeredByName."</td>
                                                                                                        </tr>";
                                                                                                $eventcounter++;
                                                                                        }
                                                                                        echo "</tbody>";
                                                                                        echo "</table>";
                                                                                        echo "</div>";
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo "No events to display";
                                                                                }
                                                                                $selfLink = "registerEvent.php";
                                                                                if(!empty($_POST['eventname']) && (!empty($_POST['oncampusloc']) || !empty($_POST['offcampusloc'])) &&
                                                                                        !empty($_POST['eventtype']))
                                                                                {
                                                                                        if((($_POST['eventtype'] == 'other') && (!empty($_POST['typeother'])) && (!empty($_POST['pointsother']))) || 
                                                                                                ($_POST['eventtype'] != 'other'))
                                                                                        {
                                                                                                $eventname = mysqli_real_escape_string($dbcon, $_POST['eventname']);
                                                                                                $eventtype = mysqli_real_escape_string($dbcon, $_POST['eventtype']);
                                                                                                $registereddatetime = date("Y\-m\-d H\:i\:s");
                                                                                                $registeredbyuserid = $_SESSION['UserID'];
                                                                                                
                                                                                                if($_POST['eventtype'] == 'generalmeeting')
                                                                                                {
                                                                                                        $eventtype = "General Meeting";
                                                                                                        $pointsworth = 5;
                                                                                                        $perhour = 0;
                                                                                                }
                                                                                                
                                                                                                elseif($_POST['eventtype'] == 'officermeeting')
                                                                                                {
                                                                                                        $eventtype = "Officer Meeting";
                                                                                                        $pointsworth = 5;
                                                                                                        $perhour = 0;
                                                                                                }
                                                                                                elseif($_POST['eventtype'] == 'social')
                                                                                                {
                                                                                                        $eventtype = "Social";
                                                                                                        $pointsworth = 5;
                                                                                                        $perhour = 0;
                                                                                                }
                                                                                                elseif($_POST['eventtype'] == 'jrmeeting')
                                                                                                {
                                                                                                        $eventtype = "SHPE Jr. Committee Meeting";
                                                                                                        $pointsworth = 5;
                                                                                                        $perhour = 0;
                                                                                                }
                                                                                                elseif($_POST['eventtype'] == 'jrevent')
                                                                                                {
                                                                                                        $eventtype = "SHPE Jr. Event";
                                                                                                        $pointsworth = 15;
                                                                                                        $perhour = 0;
                                                                                                }
                                                                                                elseif($_POST['eventtype'] == 'profworkshop')
                                                                                                {
                                                                                                        $eventtype = "Professional Workshop";
                                                                                                        $pointsworth = 20;
                                                                                                        $perhour = 0;
                                                                                                }
                                                                                                elseif($_POST['eventtype'] == 'other')
                                                                                                {
                                                                                                        $eventtype = "Other";
                                                                                                        $pointsworth = mysqli_real_escape_string($dbcon, $_POST['pointsother']);
                                                                                                        if($_POST['perhour'] == 'yes')
                                                                                                        {
                                                                                                                $perhour = 1;
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                                $perhour = 0;
                                                                                                        }
                                                                                                }
                                                                                                
                                                                                                if($_POST['location'] == "oncampus")
                                                                                                {
                                                                                                        if(!empty($_POST['oncampusloc']))
                                                                                                        {
                                                                                                                if($_POST['eventtype'] == 'volunteering')
                                                                                                                {
                                                                                                                        $eventtype = "Volunteering";
                                                                                                                        $pointsworth = 5;
                                                                                                                        $perhour = 1;
                                                                                                                }
                                                                                                                $location = mysqli_real_escape_string($dbcon, $_POST['oncampusloc']);
                                                                                                                
                                                                                                                $registerevent = mysqli_query($dbcon, "INSERT INTO events (Name, OnCampus, Location, Type, PointsWorth, PerHour, RegisteredDateTime, RegisteredByID) 
                                                                                                                        VALUES('".$eventname."', '1', '".$location."', '".$eventtype."', '".$pointsworth."', '".$perhour."', '".$registereddatetime."', '".$registeredbyuserid."')");
                                                                                                                
                                                                                                                if($registerevent)
                                                                                                                {
                                                                                                                        echo "<h1>Success</h1>";
                                                                                                                        echo "<h4>New Event:</h4>";
                                                                                                                        $formateddatenew = date("F jS\, Y", strtotime($registereddatetime));
                                                                                                                        $registeredbyname = $_SESSION['FirstName']." ".$_SESSION['LastName'];
                                                                                                                        echo "<div class='table-wrapper'>";
                                                                                                                        echo "<table>
                                                                                                                                <thead>
                                                                                                                                        <tr>
                                                                                                                                                <th>Name</th>
                                                                                                                                                <th>Type</th>
                                                                                                                                                <th>Location</th>
                                                                                                                                                <th>Date</th>
                                                                                                                                                <th>Points Worth</th>
                                                                                                                                                <th>Registered By</th>
                                                                                                                                        </tr>
                                                                                                                                </thead>
                                                                                                                                <tbody>";
                                                                                                                        if($perhour)
                                                                                                                        {
                                                                                                                                echo "<tr>
                                                                                                                                        <td>".$eventname."</td>
                                                                                                                                        <td>".$eventtype."</td>
                                                                                                                                        <td>UTD: ".$location."</td>
                                                                                                                                        <td>".$formateddatenew."</td>
                                                                                                                                        <td>".$pointsworth." per hour</td>
                                                                                                                                        <td>".$registeredbyname."</td>
                                                                                                                                </tr>";
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                                echo "<tr>
                                                                                                                                        <td>".$eventname."</td>
                                                                                                                                        <td>".$eventtype."</td>
                                                                                                                                        <td>UTD: ".$location."</td>
                                                                                                                                        <td>".$formateddatenew."</td>
                                                                                                                                        <td>".$pointsworth."</td>
                                                                                                                                        <td>".$registeredbyname."</td>
                                                                                                                                </tr>";
                                                                                                                        }
                                                                                                                        echo "</tbody>
                                                                                                                        </table>
                                                                                                                        </div>";
                                                                                                                        echo "<p>Your event was registered. Please go back or <a href='dashboard.php'>click here</a> to return to your dashboard.</p>";
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                        echo "<h3>Unexpected Error</h3>";
                                                                                                                        echo "<p>Sorry, your event could not be registered. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                                }
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                                echo "<h3>Error</h3>";
                                                                                                                echo "<p>Sorry, you selected \"On Campus\", but did not specify a location. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                        }
                                                                                                        
                                                                                                }
                                                                                                elseif($_POST['location'] == "offcampus")
                                                                                                {
                                                                                                        if(!empty($_POST['offcampusloc']))
                                                                                                        {
                                                                                                                if($_POST['eventtype'] == 'volunteering')
                                                                                                                {
                                                                                                                        $eventtype = "Volunteering";
                                                                                                                        $pointsworth = 10;
                                                                                                                        $perhour = 1;
                                                                                                                }
                                                                                                                $location = mysqli_real_escape_string($dbcon, $_POST['offcampusloc']);
                                                                                                                
                                                                                                                $registerevent = mysqli_query($dbcon, "INSERT INTO events (Name, OnCampus, Location, Type, PointsWorth, PerHour, RegisteredDateTime, RegisteredByID) 
                                                                                                                        VALUES('".$eventname."', '0', '".$location."', '".$eventtype."', '".$pointsworth."', '".$perhour."', '".$registereddatetime."', '".$registeredbyuserid."')");
                                                                                                                
                                                                                                                if($registerevent)
                                                                                                                {
                                                                                                                        echo "<h1>Success</h1>";
                                                                                                                        echo "<h4>New Event:</h4>";
                                                                                                                        $formateddatenew = date("M jS\, Y", strtotime($registereddatetime));
                                                                                                                        $registeredbyname = $_SESSION['FirstName']." ".$_SESSION['LastName'];
                                                                                                                        echo "<div class='table-wrapper'>";
                                                                                                                        echo "<table>
                                                                                                                                <thead>
                                                                                                                                        <tr>
                                                                                                                                                <th>Name</th>
                                                                                                                                                <th>Type</th>
                                                                                                                                                <th>Location</th>
                                                                                                                                                <th>Date</th>
                                                                                                                                                <th>Points Worth</th>
                                                                                                                                                <th>Registered By</th>
                                                                                                                                        </tr>
                                                                                                                                </thead>
                                                                                                                                <tbody>";
                                                                                                                        if($perhour)
                                                                                                                        {
                                                                                                                                echo "<tr>
                                                                                                                                        <td>".$eventname."</td>
                                                                                                                                        <td>".$eventtype."</td>
                                                                                                                                        <td>".$location."</td>
                                                                                                                                        <td>".$formateddatenew."</td>
                                                                                                                                        <td>".$pointsworth." per hour</td>
                                                                                                                                        <td>".$registeredbyname."</td>
                                                                                                                                </tr>";
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                                echo "<tr>
                                                                                                                                        <td>".$eventname."</td>
                                                                                                                                        <td>".$eventtype."</td>
                                                                                                                                        <td>".$location."</td>
                                                                                                                                        <td>".$formateddatenew."</td>
                                                                                                                                        <td>".$pointsworth."</td>
                                                                                                                                        <td>".$registeredbyname."</td>
                                                                                                                                </tr>";
                                                                                                                        }
                                                                                                                        echo "</tbody>
                                                                                                                        </table>
                                                                                                                        </div>";
                                                                                                                        echo "<p>Your event was registered. Please go back or <a href='dashboard.php'>click here</a> to return to your dashboard.</p>";
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                        echo "<h3>Unexpected Error</h3>";
                                                                                                                        echo "<p>Sorry, your event could not be registered. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                                }
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                                echo "<h3>Error</h3>";
                                                                                                                echo "<p>Sorry, you selected \"Off Campus\", but did not specify a location. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                        }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                        echo "<h3>Error</h3>";
                                                                                                        echo "<p>Sorry, did not select a location type. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                                }
                                                                                        }
                                                                                        elseif(($_POST['eventtype'] == 'other') && (empty($_POST['typeother']) || empty($_POST['pointsother'])))
                                                                                        {
                                                                                                echo "<h3>Error</h3>";
                                                                                                echo "<p>Sorry, you selected \"OTHER\" for Event Type, but did not specify all the details. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                echo "<h3>Unexpected Error</h3>";
                                                                                                echo "<p>Sorry, your event could not be registered. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                        }
                                                                                        
                                                                                }
                                                                                elseif(!(empty($_POST['eventname']) && empty($_POST['pointsworth']) && 
                                                                                        empty($_POST['oncampusloc']) && empty($_POST['offcampusloc'])))
                                                                                {
                                                                                        echo "<h3>Error</h3>";
                                                                                        echo "<p>Sorry, the form is incomplete. Please go back or <a href='".$selfLink."'>click here</a> to try again.</p>";
                                                                                }
                                                                                else
                                                                                {
                                                                                        ?>
                                                                                        <p>
                                                                                        <h3>Please enter the details of the event below</h3>
                                                                                        <?php
                                                                                                $currentdate = date("Y\-m\-d");
                                                                                                echo "<h5>Event Date: ".$currentdate."</h5>";
                                                                                                echo "<h5>Registered By: ".$_SESSION['FirstName']." ".$_SESSION['LastName']."</h5>";
                                                                                        ?>
                                                                                        </p>
                                                                                        <form method="post" action="registerEvent.php" name="eventform" id="eventform">
                                                                                                <div class="6u 12u$(xsmall)">
                                                                                                        <label for="eventname">Event Name</label>
                                                                                                        <input type="text" name="eventname" id="eventname" value="" placeholder="Name of Event" />
                                                                                                        <br>
                                                                                                        <input type="radio" id="oncampus" name="location" value="oncampus" checked>
                                                                                                                <label for="oncampus">On Campus?</label>
                                                                                                        <input type="text" name="oncampusloc" id="campusroom" value="" placeholder="Please Enter the Room Number" />
                                                                                                        <br>
                                                                                                        <input type="radio" id="offcampus" name="location" value="offcampus">
                                                                                                                <label for="offcampus">Off Campus?</label>                                                                                                        
                                                                                                        <input type="text" name="offcampusloc" id="offcampusloc" value="" placeholder="Please Enter the Location Name" />
                                                                                                        <br>
                                                                                                        <label>Type of Event</label>
                                                                                                        <div class="select-wrapper">
                                                                                                                <select name="eventtype" id="eventtype">
                                                                                                                        <option value="" style="background-color: rgb(42,47,74)">- Select -</option>
                                                                                                                        <option value="generalmeeting" style="background-color: rgb(42,47,74)">General Meeting [5 points]</option>
                                                                                                                        <option value="volunteering" style="background-color: rgb(42,47,74)">Volunteering (including booths) [5 or 10 points per hr]</option>
                                                                                                                        <option value="officermeeting" style="background-color: rgb(42,47,74)">Officer Meeting [5 points for non-officers]</option>
                                                                                                                        <option value="social" style="background-color: rgb(42,47,74)">Social [5 points]</option>
                                                                                                                        <option value="jrmeeting" style="background-color: rgb(42,47,74)">SHPE Jr. Committee Meeting [5 points]</option>
                                                                                                                        <option value="jrevent" style="background-color: rgb(42,47,74)">SHPE Jr. Event [15 points]</option>
                                                                                                                        <option value="profworkshop" style="background-color: rgb(42,47,74)">Professional Workshop [20 points]</option>
                                                                                                                        <option value="other" style="background-color: rgb(42,47,74)">OTHER</option>
                                                                                                                </select>
                                                                                                        </div>
                                                                                                        <br>
                                                                                                        <label for="typeother">If OTHER, Please Fill in the Details Below</label>
                                                                                                        <?php
                                                                                                        echo "Event Name"
                                                                                                        ?>
                                                                                                        <input style="width: 50%" type="text" name="typeother" id="typeother" value="" placeholder="Event Name" />
                                                                                                        <!--<label for="pointsworth">Number of Points Worth</label>-->
                                                                                                        <?php
                                                                                                        echo "Points Worth"
                                                                                                        ?>
                                                                                                        <br>
                                                                                                        <input type="number" name="pointsother" id="pointsother" value="" placeholder="Points"
                                                                                                                min="1" max="40" style="background-color: rgb(42,47,74)"/>
                                                                                                        <br>
                                                                                                        <?php
                                                                                                        echo "Rewarded by Hour: "
                                                                                                        ?>
                                                                                                        <input type="checkbox" id="perhour" name="perhour" value="yes">
                                                                                                        <label for="perhour"></label>
                                                                                                        <br>
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