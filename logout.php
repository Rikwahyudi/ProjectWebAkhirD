<?php 

require_once 'proses/core.php';

// hapus all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header('location: http://localhost/projekAkhir/ProjectWebAkhirD/index.php');

?>