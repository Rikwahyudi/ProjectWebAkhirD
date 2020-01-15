<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT product_id, product_name, product_image, brand_id, categories_id, quantity, rate, active, status FROM product WHERE product_id = $productId";
$hasil = $connect->query($sql);

if($hasil->num_rows > 0) { 
 $row = $hasil->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);