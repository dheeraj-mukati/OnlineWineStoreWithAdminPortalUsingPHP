<?php
session_start ();

$username = $_SESSION ['login_user'];
if (! isset ( $username )) {
	header ( 'Location: index.php' );
}

$isEdit = "";
$credit_card_type = "";
$credit_card_number = "";
$expiration_month = "";
$expiration_year = "";
$card_id = "";

if (isset ( $_SESSION ["credit_card_information"] )) {
	$isEdit = "k";
	$credit_card_information = $_SESSION ["credit_card_information"];
	
	$credit_card_type = $credit_card_information ["credit_card_type"];
	$credit_card_number = $credit_card_information ["credit_card_number"];
	$expiration_month = $credit_card_information ["expiration_month"];
	$expiration_year = $credit_card_information ["expiration_year"];
	$card_id = $credit_card_information ["card_id"];
}
?>
				
<html>
<head>
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
<title>Billing Information</title>
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
    $("#billingInformationLink").addClass("activeLink");

    if('<?php echo $isEdit?>' != ""){

    	$("#cardType").val('<?php echo $credit_card_type?>');
        $("#cardNumber").val('<?php echo $credit_card_number?>');
        $("#expirMonth").val('<?php echo $expiration_month?>');
        $("#expirYear").val('<?php echo $expiration_year?>');
        $("#cardID").val('<?php echo $card_id?>');
        
     }
    
});

function submitForm(){

	$('#processBillInformForm').submit();
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
		<form class="form-horizontal" method="post" action="processBillingInformation.php" id="processBillInformForm">
			<fieldset>
				<legend>Billing Information</legend>
				<br>
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Type Of
						Card</label>
					<div class="col-md-4">
						<select required="required" id="cardType" name="cardType" class="form-control">
							<option value="-1">Select</option>
							<option value="Visa">Visa</option>
							<option value="Mastercard">Mastercard</option>
							<option value="American Express">American Express</option>
							<option value="JCB">JCB</option>
							<option value="Discover">Discover</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">Card Number</label>
					<div class="col-md-4">
						<input id="cardNumber" name="cardNo" type="text"
							placeholder="Enter Card Number" class="form-control input-md" required="required">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Expiration
						Date</label>
					<div class="col-md-2">
						<select id="expirMonth" name="expirMonth" class="form-control" required="required">
							<option value="-1">Month</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
					</div>
					<div class="col-md-2">
						<select id="expirYear" name="expirYear" class="form-control" required="required">
							<option value="-1">Year</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>

						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">Card ID#</label>
					<div class="col-md-2">
						<input id="cardID" name="cardID" type="text"
							placeholder="Enter Card ID#" class="form-control input-md" required="required">
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