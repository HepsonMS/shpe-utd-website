<?php
session_start();
 
$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "test_database"; // the name of the database that you are going to use for this project
$dbuser = "root"; // the username that you created, or were given, to access your database
$dbpass = ""; // the password that you created, or were given, to access your database
 
$dbcon = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306) or die("MySQL Error: " . mysqli_error($dbcon));
mysqli_select_db($dbcon, $dbname) or die("MySQL Error: " . mysqli_error($dbcon));
?>