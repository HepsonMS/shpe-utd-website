<?php
function isOfficer($dbcon, $email) {
	if(getOfficerId($dbcon, $email) != -1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function getOfficerId($dbcon, $email) {
    $email_query_result = mysqli_query($dbcon, "SELECT UserID FROM users WHERE UTDEmail = '".$email."'") or die(mysqli_error($dbcon));
	if($email_query_result && mysqli_num_rows($email_query_result) == 1)
	{
		// User exists in the database. Now check whether they're an officer using the user id
		// Get user id from previous query
		$row = mysqli_fetch_array($email_query_result);
		$user_id = $row['UserID'];
		// Use this user id to query the officers table
		$officer_query_result = mysqli_query($dbcon, "SELECT UserID FROM officers WHERE UserID = '".$user_id."'") or die(mysqli_error($dbcon));
		if($officer_query_result && mysqli_num_rows($officer_query_result) == 1)
		{
			// User is an officer
			return $user_id;
		}
		else
		{
			// User is not an officer
			return -1;
		}
	}
	else
	{
		// User does not even exist in the database
		return -1;
	}
}

function getOfficerFullName($dbcon, $position) {
    $officer_id_query_result = mysqli_query($dbcon, "SELECT UserID FROM officers WHERE Position = '".$position."'") or die(mysqli_error($dbcon));
	$row = mysqli_fetch_array($officer_id_query_result);
	$officer_id = $row['UserID'];
	if($officer_id_query_result && mysqli_num_rows($officer_id_query_result) == 1)
	{
		// Position exists and someone is assigned to it. Now Get their full name
		$user_name_query_result = mysqli_query($dbcon, "SELECT FirstName, LastName FROM users WHERE UserID = '".$officer_id."'") or die(mysqli_error($dbcon));
		if($user_name_query_result && mysqli_num_rows($user_name_query_result) == 1)
		{
			$row = mysqli_fetch_array($user_name_query_result);
			$officer_first_name = $row['FirstName'];
			$officer_last_name = $row['LastName'];
			return $officer_first_name." ".$officer_last_name;
		}
		else
		{
			// unexpected error
			return -1;
		}
	}
	else
	{
		// There is no officer with that position
		return -1;
	}
}

function getOfficerEmail($dbcon, $id) {
    $officer_id_query_result = mysqli_query($dbcon, "SELECT UserID FROM officers WHERE UserID = '".$id."'") or die(mysqli_error($dbcon));
	if($officer_id_query_result && mysqli_num_rows($officer_id_query_result) == 1)
	{
		// User is an officer. Now Get their email
		$user_id_query_result = mysqli_query($dbcon, "SELECT UTDEmail FROM users WHERE UserID = '".$id."'") or die(mysqli_error($dbcon));
		if($user_id_query_result && mysqli_num_rows($user_id_query_result) == 1)
		{
			$row = mysqli_fetch_array($user_id_query_result);
			$user_email = $row['UTDEmail'];
			return $user_email;
		}
		else
		{
			// unexpected error
			return -1;
		}
	}
	else
	{
		// Id does not even belong to an officer
		return -1;
	}
}

function getOfficerPosition($dbcon, $email)
{
    $officer_id = getOfficerId($dbcon, $email);
	if($officer_id == -1)
	{
		return "";
	}
	else
	{
		$officer_query_result = mysqli_query($dbcon, "SELECT Position FROM officers WHERE UserID = '".$officer_id."'") or die(mysqli_error($dbcon));
		if($officer_query_result && mysqli_num_rows($officer_query_result) == 1)
		{
			$row = mysqli_fetch_array($officer_query_result);
			$officer_position = $row['Position'];
			return $officer_position;
		}
		else
		{
			return "";
		}
	}
}

function getOfficerStartDate($dbcon, $email)
{
	$officer_id = getOfficerId($dbcon, $email);
	if($officer_id == -1)
	{
		return "";
	}
	else
	{
		$officer_query_result = mysqli_query($dbcon, "SELECT 'StartDate' FROM officers WHERE UserID = '".$officer_id."'") or die(mysqli_error($dbcon));
		if($officer_query_result && mysqli_num_rows($officer_query_result) == 1)
		{
			$row = mysqli_fetch_array($officer_query_result);
			$officer_start_date = $row['StartDate'];
			return $officer_start_date;
		}
	}
}

function getOfficerEndDate($dbcon, $email) {
    	$officer_id = getOfficerId($dbcon, $email);
	if($officer_id == -1)
	{
		return "";
	}
	else
	{
		$officer_query_result = mysqli_query($dbcon, "SELECT 'EndDate' FROM officers WHERE UserID = '".$officer_id."'") or die(mysqli_error($dbcon));
		if($officer_query_result && mysqli_num_rows($officer_query_result) == 1)
		{
			$row = mysqli_fetch_array($officer_query_result);
			$officer_end_date = $row['EndDate'];
			return $officer_end_date;
		}
	}
}

function getOfficerStrikes($dbcon, $email) {
    	$officer_id = getOfficerId($dbcon, $email);
	if($officer_id == -1)
	{
		return "";
	}
	else
	{
		$officer_query_result = mysqli_query($dbcon, "SELECT 'Strikes' FROM officers WHERE UserID = '".$officer_id."'") or die(mysqli_error($dbcon));
		if($officer_query_result && mysqli_num_rows($officer_query_result) == 1)
		{
			$row = mysqli_fetch_array($officer_query_result);
			$officer_strikes = $row['Strikes'];
			return $officer_strikes;
		}
	}
}
?>