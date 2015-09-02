<?php
session_start();
include 'config.php';

if (isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_qty"]>0){
	foreach ($_POST as $key => $value){
		$new_product[$key] = filter_var($value,FILTER_SANITIZE_STRING);
			
	}
	
	unset($new_product['type']);
	unset($new_product['return_url']);
	
	$statement = $mysqli->prepare("SELECT product_name, price FROM products WHERE product_code=? LIMIT 1");
	$statement->bind_param('s', $new_product['product_code']);
	$statement->execute();
	$statement->bind_result($product_name, $price);
	
	while ($statement->fetch()){
		$new_product["product_name"] = $product_name;
		$new_product["product_price"]=$price;
		
		if (isset($_SESSION["cart_products"])){
			if (isset($_SESSION["cart_products"][$new_product['product_code']])){
				unset($_SESSION["cart_products"][$new_product['product_code']]);
			}
		}
		
		$_SESSION["cart_products"][$new_product['product_code']] = $new_product;
		 
	}
}

//back to return url
$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);
