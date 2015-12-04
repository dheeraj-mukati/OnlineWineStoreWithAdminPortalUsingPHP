<?php 
require 'dbConnect.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
		$wine_type = mysql_real_escape_string ( $_POST ["wineType"] );
	
		$sql = "SELECT wine_type_id FROM wine_type order by wine_type_id DESC limit 1";
		$result = mysql_query ( $sql);
		$row = mysql_fetch_row($result);
		$wine_type_id = $row[0] +1;
		$sql = "INSERT INTO `wine_type`(`wine_type_id`, `wine_type`) VALUES ('$wine_type_id','$wine_type')";
		$retval = mysql_query ( $sql);
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
		header ( "location: addWineType.php?wineTypeAdded=true" );
}

?> 