
<?php
session_start();
$isEdit = "";
$first_name = "";
$last_name = "";
$address = "";
$state = "";
$city = "";
$zip = "";
$country = "";
$dob = "";
$phone = "";
$title = "";

if (isset ( $_SESSION ["shipping_information"] )) {
	$isEdit = "k";
	$shipping_information = $_SESSION ["shipping_information"];
	
	$first_name = $shipping_information ["first_name"];
	$last_name = $shipping_information ["last_name"];
	$address = $shipping_information ["address"];
	$state = $shipping_information ["state"];
	$city = $shipping_information ["city"];
	$zip = $shipping_information ["zip"];
	$country = $shipping_information ["country"];
	$dob = $shipping_information ["dob"];
	$phone = $shipping_information ["phone"];
	$title = $shipping_information ["title"];
	
}
?>
<html>
<head>
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

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
	color: #f0ad4e;
}

.activeLink {
	color: white;
}
.finalReview {
    display: block;
    width: 100%;
    padding: 0;
    margin-bottom: 20px;
    font-size: 21px;
    line-height: inherit;
    color: #333;
    border: 0;
    border-bottom: 1px solid #e5e5e5;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $("#shippingInformationLink").addClass("activeLink");

    if('<?php echo $isEdit?>' != ""){

    	$("#firstName").val('<?php echo $first_name?>');
        $("#lastName").val('<?php echo $last_name?>');
        $("#address").val('<?php echo $address?>');
        $("#state").val('<?php echo $state?>');
        $("#city").val('<?php echo $city?>');
        $("#zip").val('<?php echo $zip?>');
        $("#country").val('<?php echo $country?>');
        $("#dob").val('<?php echo $dob?>');
        $("#phone").val('<?php echo $phone?>');
        $("#title").val('<?php echo $title?>');
        
        
     }
    
});
function submitForm(){

	$('#processShippingInformForm').submit();
}
</script>
</head>
<body>

	<div class="container">
	
		<div class="menu2">
		<div>
			<a href="home.php"><img class="logo2" alt="" src="images/logo.jpg"></a>
		</div>
		<div class="sub_menu">

			<a id="billingInformationLink" class="menuLabel" href="billingInformation.php">Billing Information</a>&nbsp; |
			&nbsp; <a id="shippingInformationLink" class="menuLabel" href="shipingInformation.php">Shipping Information</a>&nbsp; | &nbsp; <a id="finalReviewLink"
				class="menuLabel">Final Review</a>

		</div>
	</div>
		<br> <br>
		<form class="form-horizontal" method="post" action="processShippingInformation.php" id="processShippingInformForm">
			<fieldset>
				<legend>Shipping Information</legend>
				<br>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Title</label>
					<div class="col-md-2">
						<select class="form-control" name="title" id="title">
						<option value="-1">Select Title</option>
						<?php 
						require 'dbConnect.php';
						$result = mysql_query ( "select * from titles" );
							
						while ( $row = mysql_fetch_array ( $result ) ) {
						
							print "<option value='$row[title_id]'>$row[title]</option>";							
						}
						?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">First Name</label>
					<div class="col-md-4">
					<input type="text" required="required" name="firstName" class="form-control" id="firstName"
							placeholder="Enter First Name">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Last Name</label>
					<div class="col-md-4">
					<input type="text" required="required" name="lastName" class="form-control" id="lastName"
							placeholder="Enter Last Name">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Date Of Birth</label>
					<div class="col-md-2">
					<input type="date" required="required" name="dob" class="form-control" id="dob"
							placeholder="Enter Last Name">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Address</label>
					<div class="col-md-4">
					<input type="text" required="required" name="address" class="form-control" id="address"
							placeholder="Enter Address">
					</div>
				</div>				
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">City</label>
					<div class="col-md-4">
					<input type="text" required="required" name="city" class="form-control" id="city"
							placeholder="Enter City">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">State and Zip</label>
					<div class="col-md-2">
					<input type="text" required="required" name="state" class="form-control" id="state"
							placeholder="Enter State">
					</div>
					<div class="col-md-2">
					<input type="text" required="required" name="zip" class="form-control" id="zip"
							placeholder="Enter zip">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Country</label>
					<div class="col-md-4">
						<select class="form-control" name="country" id="country">
						<option value="-1">Select Country</option>
						<?php 
						require 'dbConnect.php';
						$result = mysql_query ( "select * from countries" );
							
						while ( $row = mysql_fetch_array ( $result ) ) {
						
							print "<option value='$row[country_id]'>$row[country]</option>";							
						}
						?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Phone</label>
					<div class="col-md-4">
					<input type="text" required="required" name="phone" class="form-control" id="phone"
							placeholder="Enter Phone">
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="col-md-4 control-label" for="singlebutton">
						</label>
						
					<div class="col-md-4">
						<input onclick="submitForm();" type="image" height="50" width="165" src="images/continue.png" alt="submit">
					</div>
				</div>
		</fieldset>
	</form>
	</div>
</body>
</html>