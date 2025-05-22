<?php

// Replace this with your own email address
$siteOwnersEmail = 'dubeyaadarsh221305@gmail.com';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

   // Check Name
	if (strlen($name) < 2) {
		$error['name'] = "Please enter your name.";
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address.";
	}
	// Check Message
	if (strlen($contact_message) < 15) {
		$error['message'] = "Please enter your message. It should have at least 15 characters.";
	}
   // Subject
	if ($subject == '') { $subject = "Contact Form Submission"; }

   // Set Message
   $message = "Email from: " . $name . "<br />";
	$message .= "Email address: " . $email . "<br />";
   $message .= "Message: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

   // Set From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   if (!$error) {
      // Set the sender email for Windows server
      ini_set("sendmail_from", $siteOwnersEmail);
      
      // Try to send the email
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

      if ($mail) { 
         echo "OK"; 
      } else {
         // Get the last error
         $error = error_get_last();
         echo "Something went wrong. Error: " . ($error ? $error['message'] : 'Unknown error');
      }
   } else {
      $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
      $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
      $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
      
      echo $response;
   }
}
?>