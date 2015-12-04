<?php

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$to = "dheeraj.mukati91@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "dmukati@mail.bradley.edu";
$headers = "From:" . $from;


if (mail ( $to, $subject, $message, $headers )) {
	
	print "send";
} else
	print "not send";

?>