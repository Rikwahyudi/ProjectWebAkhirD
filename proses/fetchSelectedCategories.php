<?php 	

require_once 'core.php';

$categoriesId = $_POST['categoriesId'];

$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_id = $categoriesId";
$hasil = $connect->query($sql);

if($hasil->num_rows > 0) { 
 $row = $hasil->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);