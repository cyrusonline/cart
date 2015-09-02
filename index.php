<?php
session_start();
include_once 'config.php';

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>shopping title here</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1 align="center">Products</h1>

<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)

	echo 'Hello';
	
	echo '<div class="cart-view-table-front" id="view-cart">';
	echo '<h3>Your Shopping Cart</h3>';
	echo '<form method="post" action="cart_update.php">';
	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<tbody>';

	$total =0;
	$b = 0;
// 	foreach ($_SESSION["cart_products"] as $cart_itm)
// 	{
// 		$product_name = $cart_itm["product_name"];
// 		$product_qty = $cart_itm["product_qty"];
// 		$product_price = $cart_itm["product_price"];
// 		$product_code = $cart_itm["product_code"];
// 		$product_color = $cart_itm["product_color"];
// 		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
// 		echo '<tr class="'.$bg_color.'">';
// 		echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
// 		echo '<td>'.$product_name.'</td>';
// 		echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
// 		echo '</tr>';
// 		$subtotal = ($product_price * $product_qty);
// 		$total = ($total + $subtotal);
// 	}
	echo '<td colspan="4">';
	echo '<button type="submit">Update</button><a href="view_cart.php" class="button">Checkout</a>';
	echo '</td>';
	echo '</tbody>';
	echo '</table>';
	
	$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
	echo '</form>';
	echo '</div>';


?>

<?php 

if (isset($_SESSION["cart_product"])&& count($_SESSION["cart_product"])>0)


echo "yes";







?>


<?php 
$results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<ul class = "products">
<?php while($row = $results->fetch_assoc()):?>

<li class="product">
	<form method="post" action="cart_update.php">
	<div class="product-content"><h3><?php echo $row['product_name']?></h3>
	<div class="product-thumb"><img src="images/<?php echo $row['product_img_name']?>"></div>
	<div class="product-desc"><?php echo $row['product_desc']?></div>
	<div class="product-info">
	Price <?php echo $currency; echo $row['price'];?> 
	
	<fieldset>
	
	<label>
		<span>Color</span>
		<select name="product_color">
		<option value="Black">Black</option>
		<option value="Silver">Silver</option>
		</select>
	</label>
	
	<label>
		<span>Quantity</span>
		<input type="text" size="2" maxlength="2" name="product_qty" value="1" />
	</label>
	
	</fieldset>
	<input type="hidden" name="product_code" value="<?php echo $row['product_code'];?>" />
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="<?php echo $current_url;?>" />
	<div align="center"><button type="submit" class="add_to_cart">Add</button></div>
	</div></div>
	</form>
	</li>



<?php endwhile;?>



</ul>




</body>
</html>