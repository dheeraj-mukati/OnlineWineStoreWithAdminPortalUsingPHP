<?php 
require 'dbConnect.php';
$winery_id = "";
$winery_name = "";
$region_id = "";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
		
	$winery_id = $_POST["wineryIdToBeEdited"];
	$sql = "select * from winery where winery_id = $winery_id";
	$result = mysql_query ( $sql);
	$row = mysql_fetch_row($result);
		
	$winery_name = $row[1];
	$region_id = $row[2];
}
?>
<html>
<head>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs-3.3.5/dt-1.10.10/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/s/bs-3.3.5/dt-1.10.10/datatables.min.js"></script>

<title>Insert title here</title>
<style type="text/css">

.menu2 {
	background-color: #232f3e;
	height: 150px;
	border: 2px ridge silver;
	width: 100%;
	margin: 0;
	padding: 0;
	background-color: #000 top: 0;
	left: 0;
}
.logo2 {
	position: relative;
	height: 146px;
}
.sub_menu {
    left: 646px;
    top: -29px;
    position: relative;
    font-size: 18px;
    font-family: arial, sans-serif;
    color: white;
}
.menuLabel {
	font-size: 18px;
	font-family: arial, sans-serif;
	color: white;
}
th {
	background-color: #232f3e;
	color: white;
}
</style>
<script type="text/javascript">

var wineryIdToBeEdited = 0;
$(document).ready(function(){

	$('#myTable').DataTable();

	if('<?php echo $winery_id?>' != ""){

		$("#wineryLegend").text("Edit Winery");
        $("#submitButton").attr("value","Update Winery");
    	$("#wineryID").val('<?php echo $winery_id?>');
        $("#wineryName").val('<?php echo $winery_name?>');
        $("#region").val('<?php echo $region_id?>');
     }
	
});
function submitForm(){

	$('#processShippingInformForm').submit();
}

function editWinery(wineryId){
	
	wineryIdToBeEdited = wineryId;
	$("#wineryIdToBeEdited").val(wineryIdToBeEdited);
	$("#editWineryForm").submit();
}
</script>
</head>
<body>
	<form action="addWinery.php" method="post" id="editWineryForm">
		<input type="hidden" name="wineryIdToBeEdited" id="wineryIdToBeEdited">
	</form>
	<div class="container">
	
		<?php require 'adminMenu.php';
		?>
		<br> <br>
		
		<form class="form-horizontal" method="post" action="processAddWinery.php" id="processShippingInformForm">
			<input type="hidden" name="wineryID" id="wineryID" value="-1">
				<legend id="wineryLegend">Add Winery</legend>
				<br>
				<?php 
					if(isset($_GET["wineryAdded"])){
						
						print '<div class="alert alert-info"><strong>Winery Has been added Successfully.</strong></div>';
					}
					if(isset($_GET["wineryEdited"])){
					
						print '<div class="alert alert-info"><strong>Winery Has been edited Successfully.</strong></div>';
					}
				?>
			
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Winery Name</label>
					<div class="col-md-4">
					<input type="text" required="required" name="wineryName" class="form-control" id="wineryName"
							placeholder="Enter Winery Name">
					</div>
				</div>	
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Region </label>
					<div class="col-md-4">
						<select class="form-control" name="region" id="region">
						<option value="-1">Select Region</option>
						<?php 
						
						$result = mysql_query ( "select * from region" );
							
						while ( $row = mysql_fetch_array ( $result ) ) {
						
							print "<option value='$row[region_id]'>$row[region_name]</option>";							
						}
						?>
						</select>
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="col-md-4 control-label" for="singlebutton">
						</label>
						
					<div class="col-md-4">
						<input type="submit" id="submitButton" class="btn btn-warning" value="Add Winery"/>
					</div>
				</div>
	</form>
	
	<br>
	<table id="myTable" class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Winery Name</th>
					<th>action</th>
					<th>Region</th>
				</tr>	
		</thead>
		<tbody>
		<?php 
		$result = mysql_query ( "select * from winery order by winery_name" );
			
		while ( $row = mysql_fetch_array ( $result ) ) {
		
			$region_result = mysql_query ( "select * from region where region_id=$row[region_id]" );
			$region_row = mysql_fetch_row($region_result);
			print "<tr>";
			print "<td>$row[winery_name]</td>";
			print "<td>$region_row[1]</td>";
			print "<td>";
			print "<a href='#0' onclick='editWinery($row[winery_id]);'><img alt='' height='30' width='30' src='images/editWine.png'></a>&nbsp;&nbsp;";
			//print "<a href='#0' onclick='askConfirmationRemove($row[winery_id]);'><img alt='' height='30' width='30' src='images/deleteWine.png'></a>";
			print "</td>";
			print "</tr>";
			
		}
		
		?>	
		</tbody>
	</table>
	<hr>
	<br><br>
	</div>
</body>
</html>