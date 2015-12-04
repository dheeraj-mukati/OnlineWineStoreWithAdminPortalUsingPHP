<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
		
	require 'dbConnect.php';
	
	$table_name = mysql_real_escape_string($_GET["tableName"]);

	if($table_name == "wine_type"){
		
		$query = mysql_query("select * from $table_name");
		
		$display_html = "<select id='selectWineType' multiple>";
		
		while ($row = mysql_fetch_array($query)) {
		
			$display_html.= "<option value='$row[wine_type]'>$row[wine_type]</option>";
		}
		$display_html.= "</select>";
		
		echo $display_html;
	}
	
	else if($table_name == "winery"){
	
		$query = mysql_query("select * from $table_name");
	
		$display_html = "<select id='selectWinery'>";
		$display_html.= "<option value='-1'>Select Winery</option>";
	
		while ($row = mysql_fetch_array($query)) {
	
			$display_html.= "<option value='$row[winery_name]'>$row[winery_name]</option>";
		}
		$display_html.= "</select>";
	
		echo $display_html;
	}
	
	else if($table_name == "region"){
	
		$query = mysql_query("select * from $table_name");
	
		$display_html = "<select id='selectRegion'>";
		$display_html.= "<option value='-1'>Select Region</option>";
	
		while ($row = mysql_fetch_array($query)) {
	
			$display_html.= "<option value='$row[region_name]'>$row[region_name]</option>";
		}
		$display_html.= "</select>";
	
		echo $display_html;
	}
	
	else if($table_name == "grape_variety"){
	
		$query = mysql_query("select * from $table_name");
	
		$display_html = "<select id='selectGrape'>";
		$display_html.= "<option value='-1'>Select Grape</option>";
	
		while ($row = mysql_fetch_array($query)) {
	
			$display_html.= "<option value='$row[variety]'>$row[variety]</option>";
		}
		$display_html.= "</select>";
	
		echo $display_html;
	}
}


?>