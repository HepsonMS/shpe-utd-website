<?php
/*
	This file is called by an ajax POST call in "manageOfficers.php".
	This file updates rows in the "officer"
*/

// Database connector code
include "base.php";
// Helper functions for getting officer information
include "officer_helper.php";

if(!empty($_SESSION['LoggedIn']))
{
	if(isOfficer($dbcon, $_SESSION['EmailAddress']) &&
		((getOfficerPosition($dbcon, $_SESSION['EmailAddress']) == 'President') ||
			(getOfficerPosition($dbcon, $_SESSION['EmailAddress']) == 'Vice-President') ||
			(getOfficerPosition($dbcon, $_SESSION['EmailAddress']) == 'Recruitment and Retention Chair')))
	{
		if(isset($_POST['hidden_position']))
		{
			$utdemail = $_POST['utdemail'];
			$startdate = $_POST['startdate'];
			$enddate = $_POST['enddate'];
			$strikes = $_POST['strikes'];
			$position = $_POST['hidden_position'];
			
			for($count = 0; $count < count($position); $count++)
			{
				$missing_fields = [];
				// Need to verify all the fields for each position, making sure none are empty ---------------
				if($utdemail[$count] == "")
				{
					$missing_fields[] = "UTD Email";
				}
				// Check whether a start date was provided
				if($startdate[$count] == "")
				{
					$missing_fields[] = "Start Date";
				}
				// Check whether ONLY an end date was provided
				if($enddate[$count] == "")
				{
					$missing_fields[] = "End Date";
				}
				// Check whether a number of strikes was provided
				if($strikes[$count] == "")
				{
					$missing_fields[] = "Strikes";					
				}
				// Report all missing fields and skip the execution of the sql statement by calling "continue;"
				// This continues the for-loop to the next iteration.
				if($missing_fields != [])
				{
					echo $position[$count].": Update Failed (Missing: ".implode(", ",$missing_fields).")\n";
					continue;
				}
				// End of field verification ------------------------------------------------

				// Make sure the given email actually belongs to a real user in the database
				$safe_email_string = mysqli_real_escape_string($dbcon, $utdemail[$count]);
				$user_exists_query = mysqli_query($dbcon, "SELECT UserID
														   FROM users
														   WHERE UTDEmail = '".$safe_email_string."'") or die(mysqli_error($dbcon));
				if($user_exists_query && mysqli_num_rows($user_exists_query) == 1)
				{
					$row = mysqli_fetch_array($user_exists_query);
					$new_officer_id = $row['UserID'];
					
					// Make sure the given email does not belong to another officer. Tthis check is already done by the database, but
					// we want to do this check here in order to give a more informative error message to the user.
					$duplicate_officer_query = mysqli_query($dbcon, "SELECT Position
																	 FROM officers
																	 WHERE UserID = '".$new_officer_id."'") or die(mysqli_error($dbcon));
					if($duplicate_officer_query && mysqli_num_rows($duplicate_officer_query) == 1)
					{
						$row = mysqli_fetch_array($duplicate_officer_query);
						$existing_officer_position = $row['Position'];
						file_put_contents("temp.txt", $existing_officer_position." ".$position[$count]);
						if($existing_officer_position != $position[$count])
						{
							echo $position[$count].": Update Failed (User ".$utdemail[$count]." is already an officer)\n";
							continue;
						}
					}
					
					$query_sql = "
					UPDATE officers
					SET StartDate = '".$startdate[$count]."', EndDate = '".$enddate[$count]."', Strikes = '".$strikes[$count]."', 
					UserID = '".$new_officer_id."'
					WHERE Position = '".$position[$count]."'
					";
					$update_officer_query = mysqli_query($dbcon, $query_sql) or die(mysqli_error($dbcon));
					echo $position[$count].": Updated\n";
				}
				else
				{
					echo $position[$count].": Update Failed (User ".$utdemail[$count]." does not exist)\n";
					continue;
				}
			}
		}
		else
		{
			echo "<h3>Nothing to Update</h3>";
		}
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