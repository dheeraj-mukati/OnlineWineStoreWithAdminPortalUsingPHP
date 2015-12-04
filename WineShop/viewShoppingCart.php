<?php 
session_start ();

$username = $_SESSION ['login_user'];
if(!isset($username)){
	header ( 'Location: index.php' );
}
?>

<html>
<head>
<link rel="stylesheet" href="css/jquery-ui.css">


<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/jquery-ui.js"></script> <!-- Autocomplete Resource jQuery -->
<script src="js/main.js"></script> <!-- Resource jQuery -->

<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="css/viewShoppingCart.css">
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<script type="text/javascript">

var wineToBeRemoved = 0;
function changeWineQuantity(wineID, wineUnitPrice){

	var wineQuantity = $("#wineQuntityOfWine"+wineID).val();
	$("#wineQuntityOfWine"+wineID).after("<img id='loadingImage' height='30px' width='40px' src='images/loading.gif'><img>");
	$("#wineQuntityOfWine"+wineID).hide();

	$.ajax({
	    url:"addWineToCart.php?requestType=changeWineQuantity&wine_to_purchase_id="+wineID+"&wine_to_purchase_quantity="+wineQuantity,
	    type:"GET",
	    success:function(wineCountAandTotalPriceJson){

	    	var wineCountAandTotalPriceArray = JSON.parse(wineCountAandTotalPriceJson);
	    	 setTimeout(function(){
		    	 
	    		 $("#loadingImage").remove();
	    		 $("#wineQuntityOfWine"+wineID).show();
	    		 
	    		 $("#lblCartCount").text(wineCountAandTotalPriceArray[1]);
	    		 $("#shipingAndHandling").text("$"+wineCountAandTotalPriceArray[2]);
	    		 $("#itemsSubtotal").text("$"+wineCountAandTotalPriceArray[3]);
	    		 $("#grandTotal").text("$"+wineCountAandTotalPriceArray[4]);
	    		 $("#totalWineCost"+wineID).text("$"+ (wineQuantity * wineUnitPrice).toFixed(2));
	    	    },500);
	    },
	    error: function(xhr, desc, err) {
	        console.log(xhr);
	        console.log("Details: " + desc + "\nError:" + err);
	    }
	});
}
$(document).ready(function() {
//$( "#selectSearchBy" ).val()
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
			Hello, 
			<?php
			
			echo $_SESSION ['login_user'];
			?>
			&nbsp; | &nbsp;
			<a class="signOutLink" href="index.php?logOutUser=true">Sign Out</a> &nbsp; | &nbsp; <a
				class="signOutLink" href="viewShoppingCart.php"><img alt="" class="shoppingCart" src="images/cart.png"><label id="lblCartCount">0</label></a>
		</div>
	</div>
	
	<div style="height: 40px"></div>
	<label class="boldLabel" id="shoppingCartLabel">Shopping Cart </label><br>
	<input style="display: none;" id="continueShopping" onclick="window.location.assign('home.php');" type="image" height="35" width="165" src="images/continueShopping.png" alt="submit">
	<table id="itemsTable" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Item</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total Price</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
				<?php 
				
				if ($_SERVER ["REQUEST_METHOD"] == "POST") {
					
					$wineToBeRemoved = $_POST["wineToBeRemoved"];
					
					if(isset($wineToBeRemoved) && isset($_SESSION ['shopping_cart'])){
						
						$shopping_cart = $_SESSION ['shopping_cart'];
						unset($shopping_cart[$wineToBeRemoved]); 
						$_SESSION ['shopping_cart'] = $shopping_cart;
					}
				}
				
				$item_count = 0;
				$shippingAndHandlingCost = 0;
				$item_subtotal = 0;
				
				if(isset($_SESSION ['shopping_cart'])){
				
					$shopping_cart = $_SESSION ['shopping_cart'];
					
					require 'dbConnect.php';
					
					$select_clasue = "SELECT wine.wine_id, wine.wine_name, wine_type.wine_type, winery.winery_name,wine.year, region.region_name, inventory.cost";
					$from_clasue = " FROM wine, winery, wine_type, inventory,region";
					$where_clasue = " where wine.winery_id=winery.winery_id and wine.wine_type=wine_type.wine_type_id and wine.wine_id=inventory.wine_id and winery.region_id=region.region_id ";
					
					$filter_query = $select_clasue . $from_clasue . $where_clasue;
					
					foreach (array_keys($shopping_cart) as $wine_id){
						
						$final_query = $filter_query .  "and wine.wine_id = $wine_id";
						
						$result = mysql_query ( $final_query );
						$row = mysql_fetch_row($result);
						
						$total_Cost = $row[6] * $shopping_cart[$wine_id];
						
						print "<tr>";
						print "<td>$row[1] $row[2] $row[3] $row[4]</td>";
						print "<td>";
						print "<select onchange='changeWineQuantity($row[0], $row[6] )' id='wineQuntityOfWine$row[0]'>";
						
						for($i=1; $i < 200 ; $i++){							
							print '<option value="'.$i.'"'.($i==$shopping_cart[$wine_id] ? 'selected="selected"' : '').'>'.$i.'</option>';							
						}
						print "<select>";
						print "</td>";
						print "<td>$$row[6]</td>";
						print "<td id='totalWineCost$wine_id'>$$total_Cost</td>";
						
						print "<td><a href='#0' onclick='askConfirmationRemove($row[0]);'><img alt='' height='30' width='30' src='images/delete.png'></a></td>";
						print "</tr>";
						
						$item_subtotal += $total_Cost;
						$item_count += $shopping_cart[$wine_id];
						//print "$wine_id";
						//print "$shopping_cart[$wine_id]";
					}
					if($item_subtotal < 100){
						$shippingAndHandlingCost = 10;
					}
					$_SESSION ['item_subtotal'] = $item_subtotal;
				}
				?>
		</tbody>		
	</table>
	<hr>
	<div class="billInfomrmationDiv">
		<table class="table">
		<tbody>
			<tr>
				<td class="removeBorder boldLabel" align="right">Shipping & Handling:</td>
				<td class="removeBorder"></td>
				<td id="shipingAndHandling" class="removeBorder boldLabel">$<?php echo $shippingAndHandlingCost?></td>
			</tr>
			<tr>
				<td class="removeBorder boldLabel" align="right">Item(s) Subtotal:</td>
				<td class="removeBorder"></td>
				<td id="itemsSubtotal" class="removeBorder boldLabel">$<?php echo $item_subtotal;?></td>
			</tr>
			<tr>
				<td class="removeBorder boldLabel"align="right">Grand Total:</td>
				<td class="removeBorder"></td>
				<td id="grandTotal" class="removeBorder boldLabel">$<?php echo $shippingAndHandlingCost + $item_subtotal?></td>
			</tr>
			<tr>
				<td class="removeBorder boldLabel"align="right"></td>
				<td class="removeBorder"></td>
				<td id="grandTotal" class="removeBorder"></td>
			</tr>
			<tr>
				<td class="removeBorder boldLabel"align="right"><input onclick="window.location.assign('home.php');" type="image" height="35" width="165" src="images/continueShopping.png" alt="submit"></td>
				<td class="removeBorder"></td>
				<td id="grandTotal" class="removeBorder"><input class="checkoutButton" onclick="window.location.assign('billingInformation.php');" type="image" src="images/checkout.png" alt="submit"></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p>Are you sure you want to remove this wine?</p>
		<ul class="cd-buttons">
			<li><a href="#0" onclick="removeWine()">Yes</a></li>
			<li><a href="#0" onclick="cancleRemove()">No</a></li>
		</ul>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

</body>
<form action="viewShoppingCart.php" method="post" id="removeWineForm">
	<input type="hidden" id="wineToBeRemoved" name="wineToBeRemoved">
</form>
</html>

<script type="text/javascript">

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

		if(<?php echo $item_count;?> == 0){
			
			$("#itemsTable").hide();
			$(".billInfomrmationDiv").hide();
			$("#continueShopping").show();
			$("#shoppingCartLabel").text("Your shopping cart is currently empty. To proceed please click 'Continue Shopping'");
		}
		
		$("#lblCartCount").text(<?php echo $item_count;?>);				
	});		
</script>