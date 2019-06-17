<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';
include "base.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	</body>
		<?php
		// Check flag set by login.php to prevent unauthorized users from using this page.
		if(isset($_SESSION['EmailAddress']) && !empty($_SESSION['EmailAddress']) AND (isset($_SESSION['Verified']) && ($_SESSION['Verified'] == 0)))
		{
			// Get user information from $_SESSION, which was previously set in login.php
			
			$email = $_SESSION['EmailAddress'];
			$firstname = $_SESSION['FirstName'];
			$lastname = $_SESSION['LastName'];
			// Get key of user from database
			$get_row = mysqli_query($dbcon, "SELECT * FROM account_activations WHERE user_id = '".$_SESSION['UserID']."'") or die($dbcon);
			$row = mysqli_fetch_array($get_row);
			$key = $row['activation_key'];
			// Begin forming email
			// Instantiation and passing `true` enables exceptions
			$mail_resend = new PHPMailer(true);
			try
			{
				
				//Server settings
				$mail_resend->isSMTP();									// Set mailer to use SMTP
				$mail_resend->Host       = 'smtp.gmail.com';  				// Specify main and backup SMTP servers
				$mail_resend->SMTPAuth   = true;                           // Enable SMTP authentication
				$mail_resend->Username   = 'utdshpe@gmail.com';            // SMTP username, our shpe gmail account
				$mail_resend->Password   = 'fpexxcenjhhzlbsd';           	// SMTP password (automatic password created by Google for SMTP to your gmail)
				$mail_resend->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted. TLS required with port 587.
				$mail_resend->Port       = 587;                           	// TCP port to connect to. 587 for Gmail
				
				//Recipients
				$mail_resend->setFrom('utdshpe@gmail.com');
				$mail_resend->addCC('utdshpe@gmail.com');
				$mail_resend->addAddress($email);

				// Content
				$mail_resend->Subject = 'SHPE UTD Signup | Verification';
				$mail_resend->Body    = '
Thank you for signing up to become a SHPE UTD member!
Your account has been created with the following credentials.
Please finish activating your account by clicking the url below.

------------------------
First Name: '.$firstname.'
Last Name: '.$lastname.'
Username: '.$email.'
------------------------

Please click this link to activate your account:
http://shpeutd.org/verifyAccount.php?email='.$email.'&key='.$key.'
				';

				$mail_resend->send();
				
				?>
				<p style="justify-content: center; text-align:center">
					A verification email has been sent to <b><?php echo $email; ?></b>
					<br>
					Please check your UT Dallas inbox and spam folders.
				</p>
				<div class="12u$" style="display: flex;justify-content: center">
					<a href="https://webmail.utdallas.edu/owa/" class="button" target="_blank" >Take me to my UTD email</a>
				</div>
				<?php
			}
			catch (Exception $e)
			{
				// Show error message
				echo "<b>ERROR: </b> Sorry, failed to send your verification email to <b>".$email."</b>.<br>";
				echo "Mailer Error: {$mail_resend->ErrorInfo}<br>";
				// Return message
				echo "<br>Try loging in again to resend another email.";
			}
		}
		else
		{
			echo "<b>ERROR: </b> Not authorized to use this feature.";
		}
		?>
	</body>
</html>