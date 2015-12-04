<?php
session_start ();

$username = $_SESSION ['login_user'];
if (! isset ( $username )) {
	header ( 'Location: index.php' );
}


$credit_card_information = array(
		
		"credit_card_type" => $_POST['cardType'],
		"credit_card_number" => $_POST['cardNo'],
		"expiration_month" => $_POST['expirMonth'],
		"expiration_year" => $_POST['expirYear'],
		"card_id" => $_POST['cardID']
);

$_SESSION["credit_card_information"] = $credit_card_information;

header ( "location: shipingInformation.php" );
?>