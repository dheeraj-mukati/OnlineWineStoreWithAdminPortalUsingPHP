<?php 
require 'dbConnect.php';

$select_search_by_val = $_GET["selectSearchByVal"];
$search_by_type_val = $_GET["searchByTypeVal"];

if($select_search_by_val == "By_Wine_Name"){
	
	$query = mysql_query("select distinct wine_name from wine where wine.status='Available' and wine_name like '%$search_by_type_val%'");
	
}else if($select_search_by_val == "By_Wine_Type"){
	
	$query = mysql_query("select distinct wine_type from wine_type where wine_type like '%$search_by_type_val%'");
	
}else if($select_search_by_val == "By_Winery"){
	
	$query = mysql_query("select distinct winery_name from winery where winery_name like '%$search_by_type_val%'");
}

$response_array = array();
while ($row = mysql_fetch_array($query)) {

	$response_array[] = $row[0];
}
echo json_encode($response_array);
?>