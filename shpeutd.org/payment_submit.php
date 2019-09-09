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
// Helper functions to send email
include "my_email_helper.php";

if(!empty($_SESSION['LoggedIn']))
{
	if($_SESSION['Officer'] == true)
	{
		// Check whether the login credentials are valid
		$email = mysqli_real_escape_string($dbcon, $_POST['email']);
		$password = md5(mysqli_real_escape_string($dbcon, $_POST['password']));
		$check_login = mysqli_query($dbcon, "SELECT * FROM users WHERE UTDEmail = '".$email."' AND Password = '".$password."'");
		
		if($check_login && mysqli_num_rows($check_login) == 1)
		{
			$row = mysqli_fetch_array($check_login);
			// Check whether the officer is trying to pay their own dues to themselves
			$payer_user_id = $row['UserID'];
			if($_SESSION['UserID'] != $payer_user_id)
			{
				// Prepare payment data to be saved to the database
				
				date_default_timezone_set('america/chicago');
				$current_datetime = date("Y\-m\-d H\:i\:s");
				$receiver_id = $_SESSION['UserID'];
				$confirmation_message = "";
				
				// Check whether a Cash amount was provided
				if(!empty($_POST['cash_amount']))
				{
					$amount = $_POST['cash_amount'];
					$method = "cash";
					$sql_query = "INSERT
							  INTO due_payments (PayerID, Amount, Method, ReceiverID, PaymentDateTime) 
							  VALUES('".$payer_user_id."', '".$amount."', '".$method."', '".$receiver_id."', '".$current_datetime."')";
					$record_payment = mysqli_query($dbcon, $sql_query);
					if($record_payment)
					{
						$payment_id = mysqli_insert_id($dbcon);
						sendPaymentConfirmationEmail($email, $payment_id, $amount, ucfirst($method), $receiver_id, $current_datetime);
						$confirmation_message .= "$".$amount." via ".strtoupper($method)." recorded for:\n".$email."\non ".$current_datetime."\n\n";
					}
					else
					{
						echo strtoupper($method)." payment failed for ".$email;
					}
				}
				// Check whether a Venmo amount was provided
				if(!empty($_POST['venmo_amount']))
				{
					$amount = $_POST['venmo_amount'];
					$method = "venmo";
					$sql_query = "INSERT
							  INTO due_payments (PayerID, Amount, Method, ReceiverID, PaymentDateTime) 
							  VALUES('".$payer_user_id."', '".strtoupper($amount)."', '".$method."', '".$receiver_id."', '".$current_datetime."')";
					$record_payment = mysqli_query($dbcon, $sql_query);
					if($record_payment)
					{
						$payment_id = mysqli_insert_id($dbcon);
						sendPaymentConfirmationEmail($email, $payment_id, $amount, ucfirst($method), $receiver_id, $current_datetime);
						$confirmation_message .= "$".$amount." via ".strtoupper($method)." recorded for:\n".$email."\non ".$current_datetime;
					}
					else
					{
						echo strtoupper($method)." payment failed for ".$email;
					}
				}
				echo $confirmation_message;
			}
			else
			{
				echo "You cannot accept dues from yourself.\nSeek another officer.";
			}
		}
		else
		{
			echo "Invalid login";
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