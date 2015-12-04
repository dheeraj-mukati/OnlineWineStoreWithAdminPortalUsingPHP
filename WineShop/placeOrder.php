<?php
$mail_message = "";

$mail_message .= "\n";
$mail_message .= "<html>\n";
$mail_message .= "<head>\n";
$mail_message .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">\n";
$mail_message .= "<title>Insert title here</title>\n";


$mail_message .= "</head>\n";
$mail_message .= "<body>\n";
$mail_message .= "	<div style=\"width: 1170px;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;\" class=\"container\">\n";
$mail_message .= "		<div class=\"menu2\" style=\"background-color: #232f3e;height: 100px;border: 2px ridge silver;width: 100%;margin: 0;padding: 0;background-color: #000 top: 0;left: 0;\">\n";
$mail_message .= "			\n";
$mail_message .= "				<a href=\"http://cs99.bradley.edu/~dmukati/WineShop/home.php\"><img class=\"logo2\" alt=\"\" src=\"http://cs99.bradley.edu/~dmukati/WineShop/images/logo.jpg\" style=\"position: relative;
    height: 100px;\"></a>\n";
$mail_message .= "			\n";
$mail_message .= "			<div class=\"sub_menu\" style=\"left: 933px;
    top: -33px;
    position: relative;
    font-size: 21px;
    font-family: arial, sans-serif;
    color: #f0ad4e;\">Order Confirmation</div>\n";
$mail_message .= "		</div>\n";
$mail_message .= "\n";
$mail_message .= "		<br> <br>\n";
$mail_message .= "		";

?>
	
		<?php
		session_start ();
		$mail_message .= "<div style='color:#f0ad4e;font-family: arial, sans-serif;font-size: 18px;'>Hello, " . $_SESSION ['login_user'] . "<br><br></div>";
		
		$mail_message .= "<div>Thank you for shopping with us.</div>\n";
		$mail_message .= "		<div>We’ll send a confirmation when your item ships.</div>\n";
		$mail_message .= "		<hr style=\"margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #eee;\">\n";
		$mail_message .= "		\n";
		$mail_message .= "		<div class=\"menuLabel\" style=\"font-size: 18px;
    font-family: arial, sans-serif;
    color: #f0ad4e;\">Order Details</div>\n";
		$mail_message .= "		<hr style=\"margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #eee;\">\n";
		$mail_message .= "		<div class=\"row\" style=\"display: flex;\">\n";
		$mail_message .= "			<div class=\"col-xs-6 col-sm-4\" style=\"font-size: 18;font-family: arial, sans-serif;margin-left: 16px;width: 33.33333333%\">Shipping Information</div>\n";
		$mail_message .= "			<!-- Optional: clear the XS cols if their content doesn't match in height -->\n";
		$mail_message .= "			<div class=\"clearfix visible-xs-block\"></div>\n";
		$mail_message .= "			<div class=\"col-xs-6 col-sm-4\" style=\"font-size: 18;font-family: arial, sans-serif;margin-left: 16px;\">Order Summary</div>\n";
		$mail_message .= "		</div>\n";
		$mail_message .= "		<div class=\"row\" style=\"display: flex;\">\n";
		$mail_message .= "			<div class=\"col-xs-6 col-sm-4\" style=\"    border: 3px solid #ddd;
    margin-right: 204px;
    margin-left: 15px;
    width: 179px;
    height: 169px;\">	";
		
		?>
					
				<?php
				if (isset ( $_SESSION ["shipping_information"] )) {
					
					$shipping_information = $_SESSION ["shipping_information"];
					
					$mail_message .= "<br><table><tr>";
					$mail_message .= "<td><b>" . $shipping_information ['first_name'] . " " . $shipping_information ['last_name'] . "</b></td></tr>";
					$mail_message .= "<tr><td>".$shipping_information ['address'] . "</td></tr>";
					$mail_message .= "<tr><td>".$shipping_information ['city'] . "," . $shipping_information ['state'] . " " . $shipping_information ['zip']. "</td>";
					$mail_message .= "</tr></table><br>";
				}
				
				$mail_message .= "</div>\n";
				$mail_message .= "			<!-- Optional: clear the XS cols if their content doesn't match in height -->\n";
				$mail_message .= "			<div class=\"clearfix visible-xs-block\"></div>\n";
				$mail_message .= "			<div class=\"col-xs-6 col-sm-4\" style=\"border: 3px solid #ddd;margin-right: 8px;margin-left: 15px;background-color: #f5f5f5;width: 30%;\">\n";
				$mail_message .= "			<br>\n";
				$mail_message .= "				<table style=\"margin-left: 95px;font-size: 14px;border-collapse:separate;border-spacing:5px;\">\n";
				$mail_message .= "					<tr align=\"right\">\n";
				$mail_message .= "						<td><strong>Items</strong></td>\n";
				$mail_message .= "						<td>          </td>\n";
				$mail_message .= "						<td><strong>$";
				
				?>
						<?php
						
$mail_message .= $_SESSION ['item_subtotal'];
						
						$mail_message .= "</strong></td>\n";
						$mail_message .= "					</tr>\n";
						$mail_message .= "					<tr align=\"right\">\n";
						$mail_message .= "						<td><strong>Shiping & Handling</strong></td>\n";
						$mail_message .= "						<td></td>\n";
						$mail_message .= "						<td><strong>$\n";
						$mail_message .= "						";
						?>
						
						<?php
						
$shipping_and_handling_cost = ($_SESSION ['item_subtotal'] < 100) ? 10.00 : 0.00;
						$mail_message .= $shipping_and_handling_cost . ".00";
						
						$mail_message .= "</strong></td>\n";
						$mail_message .= "					</tr>\n";
						$mail_message .= "					<tr align=\"right\">\n";
						$mail_message .= "						<td><strong>Subtoal</strong></td>\n";
						$mail_message .= "						<td></td>\n";
						$mail_message .= "						<td><strong>$\n";
						$mail_message .= "						";
						
						?>
						<?php
						
$mail_message .= $shipping_and_handling_cost + $_SESSION ['item_subtotal'];
						
						$mail_message .= "</strong></td>\n";
						$mail_message .= "					</tr>\n";
						$mail_message .= "					<tr align=\"right\">\n";
						$mail_message .= "						<td><strong>Subtoal</strong></td>\n";
						$mail_message .= "						<td></td>\n";
						$mail_message .= "						<td><strong>$\n";
						$mail_message .= "						";
						
						?>
						
						
						<?php
						
$tax = round ( ($shipping_and_handling_cost + $_SESSION ['item_subtotal']) * 10 / 100, 2 );
						$mail_message .= $tax;
						
						$mail_message .= "</strong></td>\n";
						$mail_message .= "					</tr>\n";
						$mail_message .= "				</table>\n";
						$mail_message .= "				<hr style=\"border: 1px solid;\">				\n";
						$mail_message .= "				<table style=\"margin-bottom: 10px;margin-left: 181px;font-size: 14px;border-collapse:separate;border-spacing:5px;\">\n";
						$mail_message .= "					<tr align=\"right\">\n";
						$mail_message .= "						<td><strong style=\"font-size: 16px;\">TOTAL</strong></td>\n";
						$mail_message .= "						<td>        </td>\n";
						$mail_message .= "						<td><strong style=\"font-size: 16px;\">$";
						
						?>
						
						<?php
						
$mail_message .= round ( $shipping_and_handling_cost + $_SESSION ['item_subtotal'] + $tax, 2 );
						
						$mail_message .= "</strong></td>\n";
						$mail_message .= "					</tr>\n";
						$mail_message .= "				</table>\n";
						$mail_message .= "			</div>\n";
						$mail_message .= "		</div>\n";
						$mail_message .= "		<br><br>\n";
						$mail_message .= "		<table id=\"itemsTable\" class=\"table table-striped table-hover\" style=\"    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;white-space: normal;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-variant: normal;
    font-style: normal;
    color: -webkit-text;
    text-align: start;\">\n";
						$mail_message .= "			<thead>\n";
						$mail_message .= "				<tr>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Wine Name</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Wine Type</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Winery Name</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Year</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Region</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Cost</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Qunitity</th>\n";
						$mail_message .= "					<th style=\"background-color: #232f3e;
    color: white;\">Total Cost</th>\n";
						$mail_message .= "				</tr>\n";
						$mail_message .= "			</thead>\n";
						$mail_message .= "			<tbody>";
						?>
		<?php
		
		if (isset ( $_SESSION ['shopping_cart'] )) {
			
			$shopping_cart = $_SESSION ['shopping_cart'];
			
			require 'dbConnect.php';
			
			$select_clasue = "SELECT wine.wine_id, wine.wine_name, wine_type.wine_type, winery.winery_name,wine.year, region.region_name, inventory.cost";
			$from_clasue = " FROM wine, winery, wine_type, inventory,region";
			$where_clasue = " where wine.winery_id=winery.winery_id and wine.wine_type=wine_type.wine_type_id and wine.wine_id=inventory.wine_id and winery.region_id=region.region_id ";
			
			$filter_query = $select_clasue . $from_clasue . $where_clasue;
			
			foreach ( array_keys ( $shopping_cart ) as $wine_id ) {
				
				$final_query = $filter_query . "and wine.wine_id = $wine_id";
				
				$result = mysql_query ( $final_query );
				$row = mysql_fetch_row ( $result );
				
				$total_Cost = $row [6] * $shopping_cart [$wine_id];
				
				$mail_message .= "<tr>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$row[1]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$row[2]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$row[3]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$row[4]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$row[5]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$row[6]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">$shopping_cart[$wine_id]</td>";
				$mail_message .= "<td style=\"padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;\">" . $row [6] * $shopping_cart [$wine_id] . "</td>";
				$mail_message .= "</tr>";
			}
		}
		
		$mail_message .= "</tbody>\n";
		$mail_message .= "		</table>\n";
		$mail_message .= "		<br>\n";
		$mail_message .= "		<div>We hope to see you again soon.</div>\n";
		$mail_message .= "		\n";
		$mail_message .= "	</div>\n";
		$mail_message .= "</body>\n";
		$mail_message .= "</html>";
		
		//print $mail_message;
		
		
		
		//error_reporting(-1);
		//ini_set('display_errors', 'On');
		//et_error_handler("var_dump");
		
		$to = $_SESSION ['login_user'];
		$subject = "Your Wine Shop Order";
		$from = "dmukati@mail.bradley.edu";
		$headers = "From:" . $from;
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		mail ( $to, $subject, $mail_message, $headers );
		
		$username = $_SESSION ['login_user'];
		session_destroy();
		session_start();
		$_SESSION ['login_user'] = $username;
		header ( "location: home.php?orderPlaced=true" );
		
		
		?>