<?php
// set the time-zone to Central Time (for database to track what time this user registered)
date_default_timezone_set('america/chicago');

session_start();
 
// Database connection
$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "test_database"; // the name of the database that you are going to use for this project
$dbuser = "root"; // the username that you created, or were given, to access your database
$dbpass = ""; // the password that you created, or were given, to access your database
 
$dbcon = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306) or die("MySQL Error: " . mysqli_error($dbcon));
mysqli_select_db($dbcon, $dbname) or die("MySQL Error: " . mysqli_error($dbcon));

// Delete all rows in account_activations older than 1 hour
function delete_old_unverified_records($con)
{
	$current_datetime = date("Y\-m\-d H\:i\:s");
	$remove_old_unverified_records = mysqli_query($con, "DELETE U, A
									FROM account_activations AS A
									INNER JOIN users AS U
									ON A.user_id = U.UserID
									WHERE A.created <= ('$current_datetime' - INTERVAL 60 MINUTE)") or die(mysqli_error($con)); 
}
?>