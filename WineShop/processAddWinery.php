<?php 
require 'dbConnect.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	$winery_id_to_be_edited = mysql_real_escape_string ( $_POST ["wineryID"] );
	$winery_name = mysql_real_escape_string ( $_POST ["wineryName"] );
	$region_id = mysql_real_escape_string ( $_POST ["region"] );
	
	if($winery_id_to_be_edited != -1){
		
		$sql = "update winery set winery_name = '$winery_name', region_id=$region_id where winery_id=$winery_id_to_be_edited";
		$result = mysql_query ( $sql);
		
		header ( "location: addWinery.php?wineryEdited=true" );
		
	}else{
		$sql = "SELECT winery_id FROM winery order by winery_id DESC limit 1";
		$result = mysql_query ( $sql);
		$row = mysql_fetch_row($result);
		$winery_id = $row[0] +1;
		$sql = "INSERT INTO `winery`(`winery_id`, `winery_name`, `region_id`) VALUES ('$winery_id','$winery_name','$region_id')";
		$retval = mysql_query ( $sql);
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
		header ( "location: addWinery.php?wineryAdded=true" );
	}
}

?> 