<?php
session_start();
 
$dbhost = "sql103.epizy.com"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "epiz_24039079_database1"; // the name of the database that you are going to use for this project
$dbuser = "epiz_24039079"; // the username that you created, or were given, to access your database
$dbpass = "bcdoI6eqTa"; // the password that you created, or were given, to access your database
 
$dbcon = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306) or die("MySQL Error: " . mysql_error());
mysqli_select_db($dbcon, $dbname) or die("MySQL Error: " . mysql_error());
?>