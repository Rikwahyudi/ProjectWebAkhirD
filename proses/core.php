<?php 

session_start();

require_once 'koneksi.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location: http://localhost/stock/index.php');	
} 



?>