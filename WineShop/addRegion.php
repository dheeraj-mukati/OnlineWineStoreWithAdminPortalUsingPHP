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
		
		<form class="form-horizontal" method="post" action="processAddRegion.php" id="processShippingInformForm">
			<input type="hidden" name="wineID" id="wineID" value="-1">
				<legend>Add Region</legend>
				<br>
				<?php 
					if(isset($_GET["regionAdded"])){
						
						print '<div class="alert alert-info"><strong>Region Has been added Successfully.</strong></div>';
					}
				?>
			
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Region Name</label>
					<div class="col-md-4">
					<input type="text" required="required" name="regionName" class="form-control" id="regionName"
							placeholder="Enter Region Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="singlebutton">
						</label>
						
					<div class="col-md-4">
						<input type="submit" id="submitButton" class="btn btn-warning" value="Add Region"/>
					</div>
				</div>	
	</form>
	</div>
</body>
</html>