<?php 
require 'dbConnect.php';
$wine_id = "";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
		
	$wine_id = $_POST["wineToBeEditedID"];
	$sql = "SELECT wine.wine_id, wine_name, wine_type, year, winery_id, description, cost, status FROM wine, inventory where wine.wine_id=inventory.wine_id and wine.wine_id = $wine_id";
	$result = mysql_query ( $sql);
	$row = mysql_fetch_row($result);
		
	$wine_name = $row[1];
	$wine_type = $row[2];
	$year = $row[3];
	$winery = $row[4];
	$description = $row[5];
	$cost = $row[6];
	$winestatus = $row[7];
}
?>
<html>
<head>


<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
</style>
<script type="text/javascript">
$(document).ready(function(){
    $("#shippingInformationLink").addClass("activeLink");

    if('<?php echo $wine_id?>' != ""){

    	$("#wineLegend").text("Edit Wine");
        $("#submitButton").attr("value","Update Wine");
    	$("#wineID").val('<?php echo $wine_id?>');
        $("#wineName").val('<?php echo $wine_name?>');
        $("#wineType").val('<?php echo $wine_type?>');
        $("#year").val('<?php echo $year?>');
        $("#winery").val('<?php echo $winery?>');
        $("#wineName").val('<?php echo $wine_name?>');
        $("#description").val('<?php echo $description?>');
        $("#cost").val('<?php echo $cost?>');
        $("#winestatus").val('<?php echo $winestatus?>');
     }
});
function submitForm(){

	$('#processShippingInformForm').submit();
}
</script>
</head>
<body>

	<div class="container">
	
		<?php require 'adminMenu.php';
		?>
		<br> <br>
		
		<form class="form-horizontal" method="post" action="processAddWine.php" id="processShippingInformForm">
			<input type="hidden" name="wineID" id="wineID" value="-1">
				<legend id="wineLegend">Add Wine</legend>
				<br>
				<?php 
					if(isset($_GET["wineAdded"])){
						
						print '<div class="alert alert-info"><strong>Wine Has been added Successfully.</strong></div>';
					}
				?>
			
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Wine Name</label>
					<div class="col-md-4">
					<input type="text" required="required" name="wineName" class="form-control" id="wineName"
							placeholder="Enter Wine Name">
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Wine Type</label>
					<div class="col-md-2">
						<select class="form-control" name="wineType" id="wineType">
						<option value="-1">Select Wine Type</option>
						<?php 
						$result = mysql_query ( "select * from wine_type order by wine_type" );
							
						while ( $row = mysql_fetch_array ( $result ) ) {
						
							print "<option value='$row[wine_type_id]'>$row[wine_type]</option>";							
						}
						?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Year and Cost</label>
					<div class="col-md-2">
					<input type="number" required="required" name="year" class="form-control" id="year"
							placeholder="Enter Year">
							
					</div>
					<div class="col-md-2"><div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" required="required" name="cost" class="form-control" id="cost"
							placeholder="Enter Cost">
							
							</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Winery </label>
					<div class="col-md-4">
						<select class="form-control" name="winery" id="winery">
						<option value="-1">Select Winery</option>
						<?php 
						
						$result = mysql_query ( "select * from winery order by winery_name" );
							
						while ( $row = mysql_fetch_array ( $result ) ) {
						
							print "<option value='$row[winery_id]'>$row[winery_name]</option>";							
						}
						?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Wine Status</label>
					<div class="col-md-4">
					<select class="form-control" name="winestatus" id="winestatus">
						<option value="-1">Select Status</option>
						<option value="Available">Available</option>
						<option value="Not Available">Not Available</option>
					</select>
					</div>
				</div>
				
								<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Description</label>
					<div class="col-md-4">
					<textarea class="form-control" rows="4" id="description" name="description" placeholder="Enter Description"></textarea>
					</div>
				</div>	
				<br>
				<div class="form-group">
					<label class="col-md-4 control-label" for="singlebutton">
						</label>
						
					<div class="col-md-4">
						<input type="submit" id="submitButton" class="btn btn-warning" value="Add Wine"/>
					</div>
				</div>
	</form>
	</div>
</body>
</html>