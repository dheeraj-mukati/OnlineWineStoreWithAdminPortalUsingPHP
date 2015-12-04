<?php
session_start ();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	
	$shopping_cart = array();
	$wine_count_and_total_price = array();
	
	$wine_to_purchase_id = $_GET["wine_to_purchase_id"];
	$wine_to_purchase_quantity = $_GET["wine_to_purchase_quantity"];
	
	if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
		
		$shopping_cart = $_SESSION ['shopping_cart'];
	}
	
	if(isset($shopping_cart[$wine_to_purchase_id]) && $_GET["requestType"] == "addWine"){
		$shopping_cart[$wine_to_purchase_id] += $wine_to_purchase_quantity;
	}else{
		$shopping_cart[$wine_to_purchase_id] = $wine_to_purchase_quantity;
	}
	
	$_SESSION ['shopping_cart'] = $shopping_cart;
	
	$item_count = 0;
	$shipping_and_handling_cost = 0;
	$item_subtotal = 0;
	$grand_total = 0;
	
	if(isset($_GET["requestType"]) && $_GET["requestType"] == "changeWineQuantity"){
		
		require 'dbConnect.php';
			
		foreach (array_keys($shopping_cart) as $wine_id){
		
			$final_query = "SELECT inventory.cost FROM wine, inventory  where wine.wine_id=inventory.wine_id and wine.wine_id = $wine_id";
			$result = mysql_query ( $final_query );
			$row = mysql_fetch_row($result);
			
			$total_Cost_of_wine = $row[0] * $shopping_cart[$wine_id];
			
			$item_subtotal += $total_Cost_of_wine;
			$item_count += $shopping_cart[$wine_id];
		}
	}else{
		foreach ($shopping_cart as $wine_item){
			$item_count += $wine_item;
		}
	}

	if($item_subtotal < 100){
		$shipping_and_handling_cost = 10;
	}
	
	$grand_total =  $item_subtotal + $shipping_and_handling_cost;
	
	$wine_count_and_total_price[1] = $item_count;
	$wine_count_and_total_price[2] = $shipping_and_handling_cost;
	$wine_count_and_total_price[3] = $item_subtotal;
	$wine_count_and_total_price[4] = $grand_total;
	
	$_SESSION ['item_subtotal'] = $item_subtotal;
	echo json_encode($wine_count_and_total_price);
}
?>