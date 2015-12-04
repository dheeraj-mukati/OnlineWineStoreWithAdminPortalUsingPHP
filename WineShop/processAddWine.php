<?php 
require 'dbConnect.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	$wine_id_to_update = mysql_real_escape_string ( $_POST ["wineID"] );
	$wine_Name = mysql_real_escape_string ( $_POST ["wineName"] );
	$wine_type = mysql_real_escape_string ( $_POST ["wineType"] );
	$year = mysql_real_escape_string ( $_POST ["year"] );
	$winery = mysql_real_escape_string ( $_POST ["winery"] );
	$description = mysql_real_escape_string ( $_POST ["description"] );
	$cost = mysql_real_escape_string ( $_POST ["cost"] );
	$winestatus = mysql_real_escape_string ( $_POST ["winestatus"] );
	
	if($wine_id_to_update != -1){
		
		$sql = "update wine set wine_name = '$wine_Name', wine_type=$wine_type,year=$year,winery_id=$winery,description='$description',status='$winestatus' where wine_id=$wine_id_to_update";
		$result = mysql_query ( $sql);
		
		$sql = "update inventory set cost=$cost where wine_id=$wine_id_to_update";
		$result = mysql_query ( $sql);
		header ( "location: adminHome.php" );
	}else{
		
		$sql = "SELECT wine_id FROM wine order by wine_id DESC limit 1";
		$result = mysql_query ( $sql);
		$row = mysql_fetch_row($result);
		$wine_id = $row[0] +1;
		$sql = "INSERT INTO `wine`(`wine_id`, `wine_name`, `wine_type`, `year`, `winery_id`, `description`, `status`) VALUES ('$wine_id','$wine_Name','$wine_type','$year','$winery','$description','$winestatus')";
		$retval = mysql_query ( $sql);
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
		$sql = "SELECT inventory_id FROM inventory order by inventory_id DESC limit 1";
		$result = mysql_query ( $sql);
		$row = mysql_fetch_row($result);
		$inventory_id = $row[0] +1;
		$sql = "INSERT INTO `inventory`(`inventory_id`, `wine_id`, `on_hand`, `cost`, `date_added`) VALUES ('$inventory_id','$wine_id','00','$cost',null)";
		$retval = mysql_query ( $sql);
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
		header ( "location: addWine.php?wineAdded=true" );
	}
}

?> 