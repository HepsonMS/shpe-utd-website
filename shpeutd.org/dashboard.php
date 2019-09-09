<?php
// Database connector code
include "base.php";
// Helper functions for getting officer information
include "officer_helper.php"
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Dashboard</title>
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
					<div class="greeting">
						<?php
						if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
						{
							echo "<i>Hello, </i>";
							if(isOfficer($dbcon, $_SESSION['EmailAddress']))
							{
								echo "<i>".getOfficerPosition($dbcon, $_SESSION['EmailAddress'])."</i>";
							}
							else
							{
								echo "<i>".$_SESSION['FirstName']."</i>";
							}
						}
						?>
					</div>
					&nbsp;
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
						<li><a href="login.php" class="button">Log In</a></li>
						<li><a href="registerMember.php" class="button special">Register</a></li>
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
							<h1>Points Dashboard</h1>
						</header>
						<div class="content">
							<p>
							</p>
						</div>
						<span class="image main"><img src="images/dashboard.jpg" alt="" /></span>
						<?php
						date_default_timezone_set('america/chicago');
						if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
						{
							// Special tools are granted to officers (i.e. Award Points, Register Events
							if($_SESSION['Officer'] == true)
							{
								// Special tools are granted to the President, Vice-President, and Recruitment/Retention Chair
								// (i.e. Change officers)
								if(($_SESSION['Position'] == 'President') ||
									($_SESSION['Position'] == 'Vice-President') ||
									($_SESSION['Position'] == 'Recruitment and Retention Chair'))
								{
									echo "<h2>Special ".getOfficerPosition($dbcon, $_SESSION['EmailAddress'])." Tools</h2>";
									?>
									<ul class="actions">
											<li><a href="manageOfficers.php" class="button special fit">Manage Officers</a></li>
									</ul>
									<?php
								}
								?>
									<h2>Officer Tools</h2>
									<ul class="actions">
											<li><a href="acceptDues.php" class="button special fit">Accept Dues</a></li>
											<li><a href="rewardPoints.php" class="button special fit">Reward Points</a></li>
											<li><a href="registerEvent.php" class="button special fit">Register Event</a></li>
									</ul>
								<?php
							}
							else
							{
								?>
									<h2>Member Dashboard</h2>
								<?php
							}
							?>
							<a href="changepassword.php" class="button">Change Password</a>
							<br>
							<br>
							<?php
								echo "<h2>Your Total Points: ";
								$queryforpoints = "SELECT RecipientID, Points
												FROM rewards
												WHERE RecipientID = '".$_SESSION['UserID']."'";
								$resultForPoints = $dbcon->query($queryforpoints) or die($dbcon->error);
								$totalpoints = 0;
								while($rowforPoints = $resultForPoints->fetch_assoc())
								{
									$totalpoints = $totalpoints + $rowforPoints['Points'];
								}
								echo $totalpoints."</h2>";
								echo "<h2>Events You've Attended</h2>";
								echo "<div class='table-wrapper'>";
									echo "<table>
										<thead>
											<tr>
												<th>Event Name</th>
												<th>Type</th>
												<th>Location</th>
												<th>Date</th>
												<th>Points Worth</th>
												<th>Hours</th>
												<th>Carpooled</th>
												<th>Total Points Earned</th>
											</tr>
										</thead>
										<tbody>";
								if($totalpoints != 0)
								{
									$queryPersonalRewards = "SELECT RecipientID, EventID, Carpooled, Hours, Points, RewardDateTime
													FROM rewards
													WHERE RecipientID = '".$_SESSION['UserID']."'
													ORDER BY RewardDateTime DESC";
									$resultPersonalRewards = $dbcon->query($queryPersonalRewards) or die($dbcon->error);
									while($rowPersonalRewards = $resultPersonalRewards->fetch_assoc())
									{
										$queryPersonalEvents = "SELECT EventID, Name, OnCampus, Location, RegisteredDateTime, Type, PointsWorth, PerHour
																FROM events
																WHERE EventID = '".$rowPersonalRewards['EventID']."'";
										$resultPersonalEvents = $dbcon->query($queryPersonalEvents) or die($dbcon->error);
										$rowPersonalEvents = $resultPersonalEvents->fetch_assoc();
										echo "<tr>
											<td>".$rowPersonalEvents['Name']."</td>
											<td>".$rowPersonalEvents['Type']."</td>";
											if($rowPersonalEvents['OnCampus'] == 1)
											{
												echo "<td>UTD: ".$rowPersonalEvents['Location']."</td>";
											}
											else
											{
												echo "<td>".$rowPersonalEvents['Location']."</td>";
											}
											echo "<td>".date("M jS\, Y", strtotime($rowPersonalRewards["RewardDateTime"]))."</td>";
											if($rowPersonalEvents['PerHour'] == 1)
											{
												echo "<td>".$rowPersonalEvents['PointsWorth']." per hour</td>";
											}
											else
											{
												echo "<td>".$rowPersonalEvents['PointsWorth']."</td>";
											}
											if($rowPersonalEvents['PerHour'] == 1)
											{
												echo "<td>".$rowPersonalRewards['Hours']."</td>";
											}
											else
											{
												echo "<td>-</td>";
											}
											if($rowPersonalEvents['OnCampus'] == 1)
											{
												echo "<td>-</td>";
											}
											else
											{
												if($rowPersonalRewards['Carpooled'] == 1)
												{
													echo "<td>Yes</td>";
												}
												else
												{
													echo "<td>No</td>";
												}
											}
											echo "<td>".$rowPersonalRewards['Points']."</td>";
									}
								}
								echo "</tbody>";
								echo "</table>";
								echo "</div>";
							echo "<h2>All Member Points (Highest Points on Top)</h2>";
							$currentdate = date("Y\-m\-d");
							$queryUsers = "SELECT UserID, FirstName, LastName, Officer, Position
											FROM users";
							$resultUsers = $dbcon->query($queryUsers) or die($dbcon->error);
							echo "<div class='table-wrapper'>";
								echo "<table>
									<thead>
											<tr>
													<th>Name</th>
													<th>Title</th>
													<th>Total Points</th>
											</tr>
									</thead>
									<tbody>";
							while($rowUsers = $resultUsers->fetch_assoc())
							{
								$queryRewards = "SELECT RecipientID, Points, RewardDateTime
												FROM rewards
												WHERE RecipientID = '".$rowUsers['UserID']."'";
								$resultRewards = $dbcon->query($queryRewards) or die($dbcon->error);
								$totalpoints = 0;
								if($resultRewards->num_rows > 0)
								{
									while($rowRewards = $resultRewards->fetch_assoc())
									{
										$totalpoints = $totalpoints + $rowRewards['Points'];
									}
									if($rowUsers['Officer'] == 1)
									{
										$title = $rowUsers["Position"];
									}
									else
									{
										$title = "Member";
									}
									$membername =  $rowUsers['FirstName']." ".$rowUsers['LastName'];
									echo "<tr>
										<td>".$membername."</td>
										<td>".$title."</td>
										<td>".$totalpoints."</td>
										</tr>";
								}
							}
							echo "</tbody>";
							echo "</table>";
							echo "</div>";
						}
						else
						{
							echo "<h3>You are not logged in</h3>";
							echo "<p>Please log in by <a href=\"login.php\">clicking here</a>.</p>";
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