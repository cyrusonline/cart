<?php

$currency = '$HK';
$db_username = 'root';
$db_password = '';
$db_name='cart';
$db_host = 'localhost';

$shipping_cost = 1.50;
$taxex = array(
		
		'VAT'=>12,
		'Service Tax'=>5
		
		
);


$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($mysqli->connect_errno){
	die('Error:('.$mysqli->connect_errno.')'.$mysqli->connect_errno);
	
}