<?php
include "base.php";

// Check flag set by login.php to prevent unauthorized users from using this page.
if(isset($_SESSION['EmailAddress']) && !empty($_SESSION['EmailAddress']) AND (isset($_SESSION['Verified']) && ($_SESSION['Verified'] == 0)))
{
	$email = $_SESSION['EmailAddress'];
	$get_key = mysqli_query($dbcon, "SELECT activation_key FROM account_activations WHERE email = '$email'") or die(mysqli_error($dbcon));
	$key_row = mysqli_fetch_array($get_key);
	$key = $key_row['activation_key'];
	// compose email
	$headers = "From: noreply-accountverify@shpeutd.org" . "\r\n" . "CC: utdshpe@gmail.com";
	$to      = $email; // Send email to our user
	$subject = 'SHPE UTD Signup | Verification';
	$message = '
	Thank you for signing up to become a SHPE UTD member!
	Your account has been created with the following credentials.
	Please finish activating your account by clicking the url below.

	------------------------
	First Name: '.$_SESSION['FirstName'].'
	Last Name: '.$_SESSION['LastName'].'
	Username: '.$email.'
	------------------------

	Please click this link to activate your account:
	http://localhost/shpe-utd-website/shpeutd.org/verifyAccount.php?email='.$email.'&key='.$key.'
	';
	// send email and check whether it worked
	if(mail($to, $subject, $message, $headers)) // send verification email
	{
		?>
		<h1 style="display: flex;justify-content: center">Success!</h1>
		<p style="display: flex;justify-content: center; text-align:center">
			A verification email has been sent to <?php echo $email; ?>
			<br>
			Please check your UT Dallas inbox and spam folders.
		</p>
		<div class="12u$" style="display: flex;justify-content: center">
			<a href="https://webmail.utdallas.edu/owa/" class="button small" target="_blank" >Take me to my UTD email</a>
		</div>
		<?php
	}
	else
	{
		echo "<b>ERROR: </b> Sorry, failed to send your verification email to <b>".$email."</b>.<br>";
	}
}
else
{
	echo "<b>ERROR: </b> Not authorized to use this feature.";
}
?>