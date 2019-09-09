<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';

function sendPaymentConfirmationEmail($email, $payment_id, $amount, $method, $receiver_id, $timedate) {
// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);
	try
	{
		//Server settings
		$mail->isSMTP();									// Set mailer to use SMTP
		$mail->Host       = 'smtp.gmail.com';  				// Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                           // Enable SMTP authentication
		$mail->Username   = 'utdshpe@gmail.com';            // SMTP username, our shpe gmail account
		$mail->Password   = 'fpexxcenjhhzlbsd';           	// SMTP password (automatic password created by Google for SMTP to your gmail)
		$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted. TLS required with port 587.
		$mail->Port       = 587;                           	// TCP port to connect to. 587 for Gmail

		//Recipients
		$mail->setFrom('utdshpe@gmail.com');
		$mail->addCC('utdshpe@gmail.com');
		$mail->addAddress($email);

		// Content
		$mail->Subject = 'SHPE UTD | Due Payment Confirmation';
		$mail->Body    = '
Thank you for paying your SHPE UTD dues!
Your membership has been updated and is now reflected on your dashboard at shpeutd.org.

Details of your payment:
------------------------
Time/Date: '.$timedate.'
Payment ID: '.$payment_id.'

Amount: '.$amount.'
Method: '.$method.'
Receiving Officer: '.$email.'
------------------------

With Gratitude,
SHPE at UTD';

		$mail->send();
		
		echo "Confirmation email sent to ".$email."\n";
	}
	catch (Exception $e)
	{
		// Show error message
		echo "ERROR: Failed to send confirmation email to ".$email."\n";
		echo "Mailer Error: {$mail->ErrorInfo}\n\n";
	}
}
?>