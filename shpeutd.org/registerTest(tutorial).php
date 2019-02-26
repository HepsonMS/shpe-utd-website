<?php
	include "base.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
		<title>User Management System (Tom Cameron for NetTuts)</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>  
		<div id="main">
		<?php
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{
			$username = mysqli_real_escape_string($dbcon, $_POST['username']);
			$password = mysqli_real_escape_string($dbcon, $_POST['password']);
			$email = mysqli_real_escape_string($dbcon, $_POST['email']);
			 
			 $checkusername = mysqli_query($dbcon, "SELECT * FROM users WHERE Username = '".$username."'");
			  
			 if(mysqli_num_rows($checkusername) == 1)
			 {
				echo "<h1>Error</h1>";
				echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
			 }
			 else
			 {
				$registerquery = mysqli_query($dbcon, "INSERT INTO users (Username, Password, EmailAddress) VALUES('".$username."', '".$password."', '".$email."')");
				if($registerquery)
				{
					echo "<h1>Success</h1>";
					echo "<p>Your account was successfully created. Please <a href=\"login.php\">click here to login</a>.</p>";
				}
				else
				{
					echo "<h1>Error</h1>";
					echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
				}       
			 }
		}
		else
		{
			?>
			 
		   <h1>Register</h1>
			 
		   <p>Please enter your details below to register.</p>
			 
			<form method="post" action="register.php" name="registerform" id="registerform">
			<fieldset>
				<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
				<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
				<label for="email">Email Address:</label><input type="text" name="email" id="email" /><br />
				<input type="submit" name="register" id="register" value="Register" />
			</fieldset>
			</form>
			 
			<?php
		}
		?>
		 
		</div>
	</body>
</html>