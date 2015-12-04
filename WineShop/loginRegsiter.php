<?php
session_start ();
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysql_connect ( $dbhost, $dbuser, $dbpass );
	
	if (! $conn) {
		die ( 'Could not connect: ' . mysql_error () );
	}
	mysql_select_db ( 'webt_assignment' );
	
	$username = mysql_real_escape_string ( $_POST ["email"] );
	$password = mysql_real_escape_string ( $_POST ["password"] );
	
	$form_type = $_POST ["form_type"];
	
	if ($form_type == "login") {
		
		$user_type = $_POST ["user_type"];
		
		if ($user_type == "customer") {
			
			$sql = "SELECT * FROM users where user_name = '$username' and password = '$password'";
			$query = mysql_query ( $sql, $conn );
			$rows = mysql_num_rows ( $query );
			if ($rows == 1) {
				
				$_SESSION ['login_user'] = $username;
				header ( "location: home.php" );
			} else {
				header ( "location: index.php?loginFailed=true" );
				mysql_close ( $conn );
			}
		} else if ($user_type == "admin") {
			
			if ($username == "admin@admin.com" && $password == "admin") {
				$_SESSION ['admin_user'] = "Admin";
				header ( 'Location: adminHome.php' );
			}else{
				header ( "location: index.php?loginFailed=true" );
				mysql_close ( $conn );
			}
		}
	} 

	else if ($form_type == "signUp") {
		
		$sql = "SELECT * FROM users where user_name = '$username'";
		$query = mysql_query ( $sql, $conn );
		$rows = mysql_num_rows ( $query );
		
		if ($rows == 1) {
			header ( "location: index.php?errorMsg=userExist" );
		} else {
			
			$sql = "SELECT cust_id FROM users order by cust_id DESC limit 1";
			$result = mysql_query ( $sql);
			$row = mysql_fetch_row($result);
			$cust_id = $row[0] +1;
			
			$sql = "INSERT INTO `users`(`cust_id`, `user_name`, `password`) VALUES ('$cust_id','$username','$password')";
			$retval = mysql_query ( $sql, $conn );
			if (! $retval) {
				die ( 'Could not enter data: ' . mysql_error () );
			}
			
			header ( "location: index.php?successMsg=userCreated" );
		}
		
		mysql_close ( $conn );
	}
}

?>