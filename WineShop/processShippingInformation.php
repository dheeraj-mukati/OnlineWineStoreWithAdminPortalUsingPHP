<?php
session_start ();

$username = $_SESSION ['login_user'];
if (! isset ( $username )) {
	header ( 'Location: index.php' );
}

$shipping_information = array(

		"first_name" => $_POST['firstName'],
		"last_name" => $_POST['lastName'],
		"address" => $_POST['address'],
		"city" => $_POST['city'],
		"state" => $_POST['state'],
		"zip" => $_POST['zip'],
		"country" => $_POST['country'],
		"phone" => $_POST['phone'],
		"dob" => $_POST['dob'],
		"title" => $_POST['title']
);

$_SESSION["shipping_information"] = $shipping_information;

header ( "location: finalReview.php" );
?>