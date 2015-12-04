<?php 
session_start();
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
td, th {
    padding: 0;
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
    $("#finalReviewLink").addClass("activeLink");
});

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
		<p class="finalReview">Final Review</p>
		<br> <br>
		<div class="row" style="display: flex;">
			<div class="col-xs-6 col-sm-4" style="font-size: 18;font-family: arial, sans-serif;margin-left: 16px;">Billing Information&nbsp;&nbsp;<a href="billingInformation.php">Edit</a></div>
			<div class="col-xs-6 col-sm-4" style="font-size: 18;font-family: arial, sans-serif;margin-left: 16px;">Shipping Information&nbsp;&nbsp;<a href="shipingInformation.php">Edit</a></div>
			<!-- Optional: clear the XS cols if their content doesn't match in height -->
			<div class="clearfix visible-xs-block"></div>
			<div class="col-xs-6 col-sm-4" style="font-size: 18;font-family: arial, sans-serif;margin-left: 16px;">Order Summary</div>
		</div>
		<div class="row" style="display: flex;">
			<div class="col-xs-6 col-sm-4" style="border: 3px solid #ddd;margin-right: 8px;margin-left: 15px;">
				<?php 
				
				if(isset($_SESSION["credit_card_information"])){
					
					$credit_card_information = $_SESSION["credit_card_information"];
					echo "<br>";
					echo "<b>".$credit_card_information["credit_card_type"]." Last 4 Digits ".substr($credit_card_information['credit_card_number'], -4)."</b><br>";
					echo "Expiration ".$credit_card_information["expiration_month"]." /".$credit_card_information['expiration_year']."<br>";;
					echo "Card ID# ".$credit_card_information["card_id"]."<br>";
					echo "<br>";
				}
				?>
			</div>
			<div class="col-xs-6 col-sm-4" style="border: 3px solid #ddd;margin-right: 8px;margin-left: 15px;">				
				<?php 					
				if(isset($_SESSION["shipping_information"])){
						
					$shipping_information = $_SESSION["shipping_information"];
					
					echo "<br>";
					echo "<b>".$shipping_information['first_name'] ." " .$shipping_information['last_name']."</b></br>";
					echo $shipping_information['address']."</br>";
					echo $shipping_information['city'] .",".$shipping_information['state'] . " ".  $shipping_information['zip'];
					echo "<br>";
				}
				?>				
			</div>
			<!-- Optional: clear the XS cols if their content doesn't match in height -->
			<div class="clearfix visible-xs-block"></div>
			<div class="col-xs-6 col-sm-4" style="border: 3px solid #ddd;margin-right: 8px;margin-left: 15px;background-color: #f5f5f5;">
			<br>
				<table style="margin-left: 95px;font-size: 14px;border-collapse:separate;border-spacing:5px;">
					<tr align="right">
						<td><strong>Items</strong></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><strong>$<?php echo $_SESSION ['item_subtotal'];?></strong></td>
					</tr>
					<tr align="right">
						<td><strong>Shiping & Handling</strong></td>
						<td></td>
						<td><strong>$<?php $shipping_and_handling_cost = ($_SESSION ['item_subtotal'] < 100)? 10.00 : 0.00; echo $shipping_and_handling_cost .".00";?></strong></td>
					</tr>
					<tr align="right">
						<td><strong>Subtoal</strong></td>
						<td></td>
						<td><strong>$<?php echo $shipping_and_handling_cost + $_SESSION ['item_subtotal'];?></strong></td>
					</tr>
					<tr align="right">
						<td><strong>Tax</strong></td>
						<td></td>
						<td><strong>$<?php $tax = round(($shipping_and_handling_cost + $_SESSION ['item_subtotal']) * 10/100,2); echo $tax;?></strong></td>
					</tr>
				</table>
				<hr style="border: 1px solid;">				
				<table style="margin-bottom: 10px;margin-left: 181px;font-size: 14px;border-collapse:separate;border-spacing:5px;">
					<tr align="right">
						<td><strong style="font-size: 16px;">TOTAL</strong></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><strong style="font-size: 16px;">$<?php echo round($shipping_and_handling_cost + $_SESSION ['item_subtotal'] + $tax , 2);?></strong></td>
					</tr>
				</table>
			</div>
		</div>
		<input style="margin-top: 23px;position: absolute;right: 380px;" onclick="window.location='placeOrder.php'" type="image" height="50" width="165" src="images/place_order.jpg" alt="submit">
	</div>
</body>
</html>