<?php 
require 'dbConnect.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
		$region_name = mysql_real_escape_string ( $_POST ["regionName"] );
	
		$sql = "SELECT region_id FROM region order by region_id DESC limit 1";
		$result = mysql_query ( $sql);
		$row = mysql_fetch_row($result);
		$region_id = $row[0] +1;
		$sql = "INSERT INTO `region`(`region_id`, `region_name`) VALUES ('$region_id','$region_name')";
		$retval = mysql_query ( $sql);
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
		header ( "location: addRegion.php?regionAdded=true" );
}

?> 