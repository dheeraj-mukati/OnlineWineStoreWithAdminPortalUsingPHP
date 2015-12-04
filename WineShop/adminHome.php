<?php
session_start ();

$username = $_SESSION ['admin_user'];
if (! isset ( $username )) {
	header ( 'Location: index.php' );
}
?>

<html>
<head>
<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="css/adminHome.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!-- Autocomplete Resource jQuery -->
<script src="js/main.js"></script> <!-- Resource jQuery -->

<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<script type="text/javascript">
	var wineToBeRemoved = 0;
	$(document).ready(function() {

		$( "#searchByType" ).autocomplete({		
		    source: function( request, response ) {
		      $.ajax({
		        url: "getSearchMenuData.php",
		        dataType: "json",
		        data: {
		        	searchByTypeVal: $( "#searchByType" ).val(),
		        	selectSearchByVal :$( "#selectSearchBy" ).val()
		        	
		        },
		        success: function( data ) {
		          response( data );
		        }
		      });
		    },
		    minLength: 1,
		    select: function( event, ui ) {
		    	$( "#searchByType" ).val(this.value);
		    },
		    open: function() {
		      $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		    },
		    close: function() {
		      $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		    }
		  });

		$( "#selectSearchBy" ).change(function() {
			$( "#searchByType" ).val("");
		});
		
		$('#wineTypeCheckBoxesDiv, #regionCheckBoxesDiv input[type=checkbox]').click(function(){
			submitForm();
		});

		$('#wineStatusRadioDiv input[type=radio]').click(function(){
			submitForm();
		});
	});
	
	function submitForm(){
		$("#refineForm").submit();
	}

	function paginationClicked(paginationButtonClickValue){
		
		$("#pagingButtonClick").val(paginationButtonClickValue);
		$("#refineForm").submit();
	}

	function searchByMenu(){

		var searchByTypeVal = $( "#searchByType" ).val();
		var selectSearchByVal =  $( "#selectSearchBy" ).val();
	
		if(selectSearchByVal == "By_Wine_Name"){

			$("#wineTypeCheckBoxesDiv input:checkbox").attr("checked", false);
			$("#selectWinery option:selected").removeAttr("selected");

			emptyFormFieldValue();
			submitForm();
		}else if(selectSearchByVal == "By_Wine_Type"){
			
			$("#wineTypeCheckBoxesDiv input:checkbox[value="+searchByTypeVal+"]").attr("checked", true);
			$("#selectWinery option:selected").removeAttr("selected");
			
			emptyFormFieldValue();
			submitForm();						
		}else if(selectSearchByVal == "By_Winery"){

			$("#wineTypeCheckBoxesDiv input:checkbox").attr("checked", false);
			
			$("#selectWinery").val(searchByTypeVal);
			emptyFormFieldValue();
			submitForm();
		}else{

			$("#wineTypeCheckBoxesDiv input:checkbox").attr("checked", false);
			$("#selectWinery option:selected").removeAttr("selected");
			emptyFormFieldValue();
		}

		function emptyFormFieldValue(){

			$("#regionCheckBoxesDiv input:checkbox").attr("checked", false);
			$("#costFrom").val("");
			$("#costTo").val("");

			$("#fromYear").val("");
			$("#toYear").val("");
		}
	}
</script>
</head>

<body>
	<form id="refineForm" action="adminHome.php" method="post">
		<div class="menu2">
			<div>
				<a href="adminHome.php"><img class="logo2" alt=""
					src="images/logo.jpg"></a>
			</div>
			<div class="wrapper">
				<select class="selectSearchType" id="selectSearchBy"
					name="selectSearchBy">
					<option value="By_Search_By">Select Search By</option>
					<option value="By_Wine_Name">By Wine Name</option>
					<option value="By_Wine_Type">By Wine Type</option>
					<option value="By_Winery">By Winery</option>

				</select> <input class="textF" id="searchByType" name="searchByType"
					placeholder="Search Wine..." />
				<button class="btn btn-warning" onclick="searchByMenu();">Search</button>
			</div>

			<div class="sub_menu">

				<ul class="nav navbar-nav">
					<li class="active"><a class="fontColor" href="#">Hello, <?php echo $_SESSION ['admin_user'];?> <span class="sr-only">(current)</span></a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle fontColor"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">Action <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="addWine.php">Add Wine</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="addWinery.php">Add Winery</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="addWineType.php">Add Wine Type</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="addRegion.php">Add Region</a></li>
							<!-- <li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">One more separated link</a></li> -->
						</ul></li>
						<li><a class="fontColor" href="index.php?logOutUser=true">Sign Out</a></li>
				</ul>
			</div>
		</div>

		<div class="left">

			<div>
				<h3>Refine By :</h3>

			</div>
			<hr>
			<div id="wineStatusRadioDiv">
				<label>By Wine Status:</label><br>
				<input type="radio" name="wineStatusRadio" checked="checked">Both&nbsp;&nbsp;
				<input type="radio" name="wineStatusRadio" value="Available">Available&nbsp;&nbsp;
				<input type="radio" name="wineStatusRadio" value="Not Available">Not Available
			</div>
			<hr>
			<div id="wineTypeCheckBoxesDiv">
				<label>By Wine Type:</label><br>
			
			<?php
			
			require 'dbConnect.php';
			$query = mysql_query ( "select * from wine_type" );
			
			while ( $row = mysql_fetch_array ( $query ) ) {
				
				print "<input name='wineTpeCheckBox[]' type='checkbox' value='$row[wine_type]' />$row[wine_type]";
				
				$sub_query = mysql_query ( "select count(wine.wine_id) as count from wine, wine_type where wine.wine_type=wine_type.wine_type_id and wine_type.wine_type='$row[wine_type]'" );
				
				$wine_count = mysql_fetch_row ( $sub_query );
				print "&nbsp;($wine_count[0])<br>";
			}
			
			?>
		</div>
			<hr>
			
			<div>
				<label>By Winery: </label><br><select id="selectWinery"
					name="selectWinery[]" multiple="multiple"
					style="height: 200px; width: 250px">
			<?php
			
			$query = mysql_query ( "select * from winery" );
			
			while ( $row = mysql_fetch_array ( $query ) ) {
				
				$value_for_html = htmlspecialchars ( $row [1] );
				
				print '<option value="' . htmlspecialchars ( $row [1] ) . '">';
				
				print "$row[winery_name]";
				$winery_name2 = addslashes ( $row [1] );
				$sub_query = mysql_query ( "select count(wine.wine_id) as count from wine, winery where wine.winery_id=winery.winery_id and winery.winery_name='$winery_name2'" );
				
				$wine_count = mysql_fetch_row ( $sub_query );
				print "&nbsp;($wine_count[0])</option>";
			}
			?>
			</select> <input name="button" onclick="submitForm();" type="button"
					value="Go">
			</div>
			<hr>
			
			<div>
				<label>By Cost:</label><br> &nbsp;&nbsp;$ &nbsp;<input
					type="text" id="costFrom" name="costFrom" size="10" maxlength="10">
				&nbsp;to $ <input id="costTo" name="costTo" type="text" size="10"
					maxlength="10"> <input type="button" value="Go"
					onclick="submitForm();">
			</div>
			<hr>
			
			<div id="regionCheckBoxesDiv">
				<label>By Region:</label><br> 
			
			<?php
			
			$query = mysql_query ( "select * from region" );
			
			while ( $row = mysql_fetch_array ( $query ) ) {
				
				print "<input name='regionCheckBox[]' type='checkbox' value='$row[region_name]' />$row[region_name]";
				
				$sub_query = mysql_query ( "select count(wine.wine_id) as count from wine, winery,region where wine.winery_id=winery.winery_id and winery.region_id=region.region_id and region.region_name='$row[region_name]'" );
				
				$wine_count = mysql_fetch_row ( $sub_query );
				print "&nbsp;($wine_count[0])<br>";
			}
			?>	
		</div>
			<hr>
			
			<div>
				<label>By Year:</label><br> &nbsp;&nbsp; From &nbsp;<input
					type="text" name="fromYear" id="fromYear" size="10" maxlength="10">
				&nbsp;To <input name="toYear" id="toYear" type="text" size="10"
					maxlength="10"> <input type="button" value="Go"
					onclick="submitForm();">
			</div>
			<hr>
			<br> <input type="hidden" name="fromLimit" id="fromLimit"> <input
				type="hidden" name="toLimit" id="toLimit"> <input type="hidden"
				name="pagingButtonClick" id="pagingButtonClick">

		</div>

		<div class="right">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Wine Name</th>
						<th>Wine Type</th>
						<th>Winery Name</th>
						<th>Year</th>
						<th>Region</th>
						<th>Cost</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		<?php
		
		$query_limit = 15;
		$from_limit = 0;
		$to_limit = $query_limit;
		
		$select_clasue = "SELECT wine.status, wine.wine_id, wine.wine_name, wine_type.wine_type, winery.winery_name,wine.year, region.region_name, inventory.cost";
		$from_clasue = " FROM wine, winery, wine_type, inventory,region";
		$where_clasue = " where wine.winery_id=winery.winery_id and wine.wine_type=wine_type.wine_type_id and wine.wine_id=inventory.wine_id and winery.region_id=region.region_id ";
		
		$wine_type_checkbox_selected_json = json_encode ( array () );
		$winery_select_selected_json = json_encode ( array () );
		$region_checkbox_selected_json = json_encode ( array () );
		
		$from_cost_value = 0;
		$to_cost_value = 0;
		
		$from_year_value = 0;
		$to_year_value = 0;
		
		$search_by_type_value = "";
		$select_search_by_value = "";
		
		$wine_status_value = "";
		
		if ($_SERVER ["REQUEST_METHOD"] == "POST") {
			
			$search_by_type_value = $_POST ['searchByType'];
			$select_search_by_value = $_POST ['selectSearchBy'];
			
			if (! empty ( $search_by_type_value ) && ! empty ( $select_search_by_value ) && $select_search_by_value == "By_Wine_Name") {
				
				$where_clasue .= " and wine.wine_name = " . "'$search_by_type_value'";
			}
			
			$wine_status_value = $_POST ['wineStatusRadio'];
				
			if (! empty ( $wine_status_value ) && ($wine_status_value == "Available" || $wine_status_value == "Not Available")) {
			
				$where_clasue .= " and wine.status = " . "'$wine_status_value'";
			}
			
			if (! empty ( $_POST ['selectWinery'] )) {
				
				$winery_select_selected_array;
				$i = 0;
				
				$where_clasue .= " and winery.winery_name IN (";
				foreach ( $_POST ['selectWinery'] as $names ) {
					
					$winery_select_selected_array [$i] = $names;
					$names = addslashes ( $names );
					
					$where_clasue .= "'$names'" . ",";
					$i ++;
				}
				$where_clasue = trim ( $where_clasue, "," );
				$where_clasue .= ")";
				
				$winery_select_selected_json = json_encode ( $winery_select_selected_array );
			}
			
			if (! empty ( $_POST ['wineTpeCheckBox'] )) {
				
				$wine_type_checkbox_selected_array;
				$i = 0;
				
				$where_clasue .= " and wine_type.wine_type IN (";
				
				foreach ( $_POST ['wineTpeCheckBox'] as $check ) {
					
					$wine_type_checkbox_selected_array [$i] = $check;
					$i ++;
					
					$where_clasue .= "'$check'" . ",";
				}
				
				$where_clasue = trim ( $where_clasue, "," );
				$where_clasue .= ")";
				
				$wine_type_checkbox_selected_json = json_encode ( $wine_type_checkbox_selected_array );
			}
			// for region wise search
			if (! empty ( $_POST ['regionCheckBox'] )) {
				
				$region_checkbox_selected_array;
				$i = 0;
				
				$where_clasue .= " and region.region_name IN (";
				
				foreach ( $_POST ['regionCheckBox'] as $check ) {
					
					$region_checkbox_selected_array [$i] = $check;
					$i ++;
					
					$where_clasue .= "'$check'" . ",";
				}
				
				$where_clasue = trim ( $where_clasue, "," );
				$where_clasue .= ")";
				
				$region_checkbox_selected_json = json_encode ( $region_checkbox_selected_array );
			}
			
			if (! empty ( $_POST ['costFrom'] ) && ! empty ( $_POST ['costTo'] )) {
				
				$from_cost_value = $_POST ['costFrom'];
				$to_cost_value = $_POST ['costTo'];
				
				$where_clasue .= " and inventory.cost between $_POST[costFrom] and $_POST[costTo]";
			}
			
			if (! empty ( $_POST ['fromYear'] ) && ! empty ( $_POST ['toYear'] )) {
				
				$from_year_value = $_POST ['fromYear'];
				$to_year_value = $_POST ['toYear'];
				
				$where_clasue .= " and wine.year between $_POST[fromYear] and $_POST[toYear]";
			}
			
			if (! empty ( $_POST ['pagingButtonClick'] ) && $_POST ['pagingButtonClick'] == "next") {
				
				$from_limit = $_POST ['fromLimit'];
				$to_limit = $_POST ['toLimit'];
				
				$from_limit += $query_limit;
				$to_limit += $query_limit;
			} else if (! empty ( $_POST ['pagingButtonClick'] ) && $_POST ['pagingButtonClick'] == "prev") {
				
				$from_limit = $_POST ['fromLimit'];
				$to_limit = $_POST ['toLimit'];
				
				if (! ($from_limit == 0)) {
					$from_limit -= $query_limit;
					$to_limit -= $query_limit;
				}
			}
		}
		
		// print "$where_clasue";
		
		// for filter count
		$select_clasue_for_count = "SELECT count(wine.wine_id) ";
		$filter_query = $select_clasue_for_count . $from_clasue . $where_clasue;
		
		$query = mysql_query ( $filter_query );
		$row = mysql_fetch_array ( $query );
		$result_count = $row [0];
		
		if ($to_limit > $result_count) {
			$to_limit = $result_count;
		}
		// for filter data
		$where_clasue .= " limit $from_limit , $query_limit";
		$filter_query = $select_clasue . $from_clasue . $where_clasue;
		
		$query = mysql_query ( $filter_query );
		
		while ( $row = mysql_fetch_array ( $query ) ) {
			
			print "<tr>";
			print "<td>$row[wine_name]</td>";
			print "<td>$row[wine_type]</td>";
			print "<td>$row[winery_name]</td>";
			print "<td>$row[year]</td>";
			print "<td>$row[region_name]</td>";
			print "<td>$$row[cost]</td>";
			print "<td>$row[status]</td>";
			print "<td>";
			print "<a href='#0' onclick='editWine($row[wine_id]);'><img alt='' height='30' width='30' src='images/editWine.png'></a>&nbsp;&nbsp;";
			//print "<a href='#0' onclick='askConfirmationRemove($row[wine_id]);'><img alt='' height='30' width='30' src='images/deleteWine.png'></a>";
			print "</td>";
			print "</tr>";
		}
		?>
			</tbody>
			</table>
			<div style="width: 1299px; height: 37px">
				<div class="resultCount">Showing <?php print "$from_limit"; print " to "; print "$to_limit"; print" out of "; print"$result_count"; ?> Wines </div>
				<div align="right" id="paginationDiv" class="pager1">
					<ul class="pager">
						<li id="paginationPrev"><a href="#"
							onclick="paginationClicked('prev');">Previous</a></li>
						<li id="paginationNext"><a href="#"
							onclick="paginationClicked('next');">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
	
	<!-- Delete wine popup -->
	<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p>Are you sure you want to delete this wine?</p>
		<ul class="cd-buttons">
			<li><a href="#0" onclick="removeWine()">Yes</a></li>
			<li><a href="#0" onclick="cancleRemove()">No</a></li>
		</ul>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<form action="adminHome.php" id="deleteWineForm" method="post">
	<input type="hidden" name="wineTobeDeletedID" id="wineTobeDeletedID">
</form>

<form action="addWine.php" id="editWineForm" method="post">
	<input type="hidden" name="wineToBeEditedID" id="wineToBeEditedID">
</form>

</body>
</html>

<script type="text/javascript">

	function editWine(wineToBeEditedID){
		$("#wineToBeEditedID").val(wineToBeEditedID);
		$("#editWineForm").submit();
	}
	
	function cancleRemove(){
		$('.cd-popup').removeClass("is-visible");
	}
	
	function removeWine(){
		$("#wineToBeRemoved").val(wineToBeRemoved);
		$("#removeWineForm").submit();
	}
	
	function askConfirmationRemove(wineToBeRemovedID){
		wineToBeRemoved = wineToBeRemovedID;
		$('.cd-popup').addClass("is-visible");
	}

	$(document).ready(function() {
		
		var wineTypeCheckedBoxes = <?php echo isset($wine_type_checkbox_selected_json) ? $wine_type_checkbox_selected_json : ""; ?>;
		for(var i = 0; i < wineTypeCheckedBoxes.length; i++){
			$("#wineTypeCheckBoxesDiv input:checkbox[value="+wineTypeCheckedBoxes[i]+"]").attr("checked", true);
		}

		var regionCheckedBoxes = <?php echo isset($region_checkbox_selected_json) ? $region_checkbox_selected_json : ""; ?>;
		
		for(var i = 0; i < regionCheckedBoxes.length; i++){
			$("#regionCheckBoxesDiv input:checkbox[value='"+regionCheckedBoxes[i]+"']").attr("checked", true);
		}
		
		var winerySelectedItems = <?php echo isset($winery_select_selected_json) ? $winery_select_selected_json : ""; ?>;

		$("#selectWinery").val(winerySelectedItems);

		var fromCostValue = <?php echo isset($from_cost_value) ? $from_cost_value : ""; ?>;
		var toCostValue = <?php echo isset($to_cost_value) ? $to_cost_value : ""; ?>;

		if(fromCostValue > 0 && toCostValue > 0 ){
			$("#costFrom").val(fromCostValue);
			$("#costTo").val(toCostValue);
		}

		var fromYearValue = <?php echo isset($from_year_value) ? $from_year_value : ""; ?>;
		var toYearValue = <?php echo isset($to_year_value) ? $to_year_value : ""; ?>;

		if(fromYearValue > 0 && toYearValue > 0 ){
			$("#fromYear").val(fromYearValue);
			$("#toYear").val(toYearValue);
		}

		var queryLimit = <?php echo $query_limit;?>;
		var fromLimit = <?php echo $from_limit;?>;
		var toLimit = <?php echo $to_limit;?>;
		var resultCount = <?php echo $result_count;?>;

		$("#fromLimit").val(fromLimit);
		$("#toLimit").val(toLimit);
		
		if(fromLimit == 0){
			$("#paginationPrev").hide();
		}
		if(toLimit == resultCount){
			$("#paginationNext").hide();
		}	
		if(resultCount <= queryLimit){
			$("#paginationDiv").hide();
		}		

		var selectSearchByValue = '<?php print "$select_search_by_value";?>';
		var searchByTypeValue = '<?php print "$search_by_type_value";?>';
		
		if(searchByTypeValue != "" && selectSearchByValue != ""){
			$("#searchByType").val(searchByTypeValue);
			$( "#selectSearchBy" ).val(selectSearchByValue);	
		}

		var wineStatusValue = '<?php print "$wine_status_value";?>';
		if(wineStatusValue != ""){
			$('[name=wineStatusRadio][value="'+wineStatusValue+'"]').prop('checked',true);
		}
						
	});		
</script>
