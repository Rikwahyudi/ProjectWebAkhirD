<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_id = $brandId";
$hasil = $connect->query($sql);

if($hasil->num_rows > 0) { 
 $row = $hasil->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);