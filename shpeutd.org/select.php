<?php
/*
	This file is called by an ajax POST call in "manageOfficers.php".
	This file retrieves all the rows from the "officers" database table
	and stores them in an array called $officers_array.

	Array Form:
	$officers_array = {{'UserID', 'Position', 'StartDate', 'EndDate', 'FirstName', 'LastName', 'UTDEmail', 'Strikes', 'TableOrder'}, ...}

	This array is returned to "manageOfficers.php".
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
		$get_all_officers_query = mysqli_query($dbcon, "SELECT * FROM officers ORDER BY TableOrder ASC") or die(mysqli_error($dbcon));

		if($get_all_officers_query)
		{
			while($officer_row = $get_all_officers_query->fetch_assoc())
			{
				$officer_profile['UserID'] = $officer_row['UserID'];
				$officer_profile['Position'] = $officer_row['Position'];
				$officer_profile['StartDate'] = $officer_row['StartDate'];
				$officer_profile['EndDate'] = $officer_row['EndDate'];
				$officer_profile['Strikes'] = $officer_row['Strikes'];
				$officer_profile['TableOrder'] = $officer_row['TableOrder'];

				$single_officer_query = mysqli_query($dbcon, "SELECT FirstName, LastName, UTDEmail FROM users WHERE UserID = '".$officer_row['UserID']."'") or die(mysqli_error($dbcon));
				// Check whether officer UserID exists in the "users" database table (It should. This is just a fale-safe)
				if($single_officer_query && mysqli_num_rows($single_officer_query) == 1)
				{
					$user_row = mysqli_fetch_array($single_officer_query);
					$officer_profile['FirstName'] = $user_row['FirstName'];
					$officer_profile['LastName'] = $user_row['LastName'];
					$officer_profile['UTDEmail'] = $user_row['UTDEmail'];
				}
				else
				{
					$officer_profile['FirstName'] = "-";
					$officer_profile['LastName'] = "-";
					$officer_profile['UTDEmail'] = "-";
				}
				// Replace null values retrieved from database with "-"
				foreach($officer_profile as $key=>$value)
				{
					if($officer_profile[$key] == null)
					{
						$officer_profile[$key] = "-";
					}
				}
				// Add array of officer details to array
				$officers_array[] = $officer_profile;
			}
			// Return array to "configureOfficers.php"
			echo json_encode($officers_array);
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