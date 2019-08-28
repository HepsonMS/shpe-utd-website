<?php
// Database connector code
include "base.php";
// Helper functions for getting officer information
include "officer_helper.php"
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Manage Officers</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="stylesheet" href="yearpicker.css">
		<!--Scripts for 4 fields that ask about Year-->
		<script src="yearpicker.js" async></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous">
		</script>
		<script>
			$(document).ready(function(){
				function fetch_data()
				{	
					// Retrieve rows from "officers" database table using ajax call
					// "select.php" sends back a dictionary of all the rows found in
					// the database table.
					$.ajax({
						url:'select.php',
						method:'POST',
						dataType:'json',
						success:function(data)
						{
							var html = '';
							// Iterate through array returned by "select.php" and create a table row on the website for each element
							for(var count = 0; count < data.length; count++)
							{
								html += '<tr>';
								html += '<td><input value=1 type="checkbox" class="check_box" id="'+data[count].Position+
										'" data-position="'+data[count].Position+
										'" data-firstname="'+data[count].FirstName+
										'" data-lastname="'+data[count].LastName+
										'" data-utdemail="'+data[count].UTDEmail+
										'" data-startdate="'+data[count].StartDate+
										'" data-enddate="'+data[count].EndDate+
										'" data-strikes="'+data[count].Strikes+
										'"/><label for="'+data[count].Position+
										'"></label></td>';
								html += '<td><b>'+data[count].Position+'</b></td>';
								html += '<td>'+data[count].FirstName+'</td>';
								html += '<td>'+data[count].LastName+'</td>';
								html += '<td>'+data[count].UTDEmail+'</td>';
								html += '<td>'+data[count].StartDate+'</td>';
								html += '<td>'+data[count].EndDate+'</td>'
								html += '<td>'+data[count].Strikes+'</td>';
								html += '</tr>';
							}
							// Put these table rows in the html elemented with id="table_body"
							$('#table_body').html(html);
						}
					});
				}

				fetch_data();

				// Functionality to edit fields when the checkbox is marked
				$(document).on('click', '.check_box', function(){
					var html = '';
					if(this.checked)
					{
						html = '<td><input value=1 type="checkbox" checked class="check_box" id="'+$(this).attr("id")+
							'" data-position="'+$(this).data("position")+
							'" data-firstname="'+$(this).data("firstname")+
							'" data-lastname="'+$(this).data("lastname")+
							'" data-utdemail="'+$(this).data("utdemail")+
							'" data-startdate="'+$(this).data("startdate")+
							'" data-enddate="'+$(this).data("enddate")+
							'" data-strikes="'+$(this).data("strikes")+
							'"/><label for="'+$(this).attr("id")+
							'"></label></td>';
						html += '<td><b>'+$(this).data('position')+'</b></td>';
						if($(this).data("firstname") == "-") {
							html += '<td><input type="text" name="firstname[]" class="table-field readonly" value="" readonly/></td>';
						} else {
							html += '<td><input type="text" name="firstname[]" class="table-field readonly" value="'+$(this).data("firstname")+'" readonly/></td>';
						}
						if($(this).data("lastname") == "-") {
							html += '<td><input type="text" name="lastname[]" class="table-field readonly" value="" readonly/></td>';
						} else {
							html += '<td><input type="text" name="lastname[]" class="table-field readonly" value="'+$(this).data("lastname")+'" readonly/></td>';
						}
						if($(this).data("utdemail") == "-") {
							html += '<td><input type="email" name="utdemail[]" class="table-field" value=""/></td>';
						} else {
							html += '<td><input type="email" name="utdemail[]" class="table-field" value="'+$(this).data("utdemail")+'"/></td>';
						}
						if($(this).data("startdate") == "-") {
							html += '<td><input type="date" name="startdate[]" class="table-field" value=""/></td>';
						} else {
							html += '<td><input type="date" name="startdate[]" class="table-field" value="'+$(this).data("startdate")+'"/></td>';
						}
						if($(this).data("enddate") == "-") {
							html += '<td><input type="date" name="enddate[]" class="table-field" value=""/></td>';
						} else {
							html += '<td><input type="date" name="enddate[]" class="table-field" value="'+$(this).data("enddate")+'"/></td>';
						}
						if($(this).data("strikes") == "-") {
							html += '<td><input type="number" min="0" step="1" name="strikes[]" class="table-field" value=""/>';
						} else {
							html += '<td><input type="number" min="0" step="1" name="strikes[]" class="table-field" value="'+$(this).data("strikes")+'"/>';
						}
						html += '<input type="hidden" name="hidden_position[]" value="'+$(this).data('position')+'"/></td>';
					}
					else
					{
						html = '<td><input value=1 type="checkbox" class="check_box" id="'+$(this).attr("id")+
							'" data-position="'+$(this).data("position")+
							'" data-firstname="'+$(this).data("firstname")+
							'" data-lastname="'+$(this).data("lastname")+
							'" data-utdemail="'+$(this).data("utdemail")+
							'" data-startdate="'+$(this).data("startdate")+
							'" data-enddate="'+$(this).data("enddate")+
							'" data-strikes="'+$(this).data("strikes")+
							'"/><label for="'+$(this).attr("id")+
							'"></label></td>';
						html += '<td><b>'+$(this).data('position')+'</b></td>';
						html += '<td>'+$(this).data("firstname")+'</td>';
						html += '<td>'+$(this).data("lastname")+'</td>';
						html += '<td>'+$(this).data("utdemail")+'</td>';
						html += '<td>'+$(this).data("startdate")+'</td>';
						html += '<td>'+$(this).data("enddate")+'</td>'
						html += '<td>'+$(this).data("strikes")+'</td>';           
					}
					$(this).closest('tr').html(html);
				});

				// Functionality to update "officers" database table with new input values
				$('#update_form').on('submit', function(event){
					event.preventDefault();
					if($('.check_box:checked').length > 0)
					{
						$.ajax({
							url:"multiple_update.php",
							method:"POST",
							data:$(this).serialize(),
							success:function(data)
							{
								window.alert(data);
								fetch_data();
							}
						})
					}
				});
			});
		</script>
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
							<h2 id="name1">Manage Officers</h2>
						</header>
						<div class="content">
							<p>Change officer information and set new officers</p>
						</div>
						<?php
						$selfLink = "registerMember.php";	// for user to retry during errors
						// set the time-zone to Central Time (for database to track what time this user registered)
						date_default_timezone_set('america/chicago');
						// check whether the form was completely filled out
						if(!empty($_SESSION['LoggedIn']))
						{
							if(isOfficer($dbcon, $_SESSION['EmailAddress']) &&
								((getOfficerPosition($dbcon, $_SESSION['EmailAddress']) == 'President') ||
									(getOfficerPosition($dbcon, $_SESSION['EmailAddress']) == 'Vice-President') ||
									(getOfficerPosition($dbcon, $_SESSION['EmailAddress']) == 'Recruitment and Retention Chair')))
							{
								?>
								<form method="post" id="update_form">
									<div class='table-wrapper'>
										<table class="table-field">
											<thead>
												<th width="6%">Select</th>
												<th width="16%">Position</th>
												<th width="13%">First Name</th>
												<th width="13%">Last Name</th>
												<th width="19%">UTD Email</th>
												<th width="13%">Start Date</th>
												<th width="13%">End Date</th>
												<th width="7%">Strikes</th>
											</thead>
											<tbody id="table_body"></tbody>
										</table>
									</div>
									<br>
									<div align="left">
										<input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Update Officers" />
									</div>
								</form>
								
								<?php
							}
							else
							{
								echo "<h3>Restricted Access Page</h3>";
								echo "<p>Please return to your dashboard by <a href=\"dashboard.php\">clicking here</a>.</p>";
							}
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