<?php 	

require_once 'core.php';

$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1";
$hasil = $connect->query($sql);

$output = array('data' => array());

if($hasil->num_rows > 0) { 

 // $row = $hasil->fetch_array();
 $activeBrands = ""; 

 while($row = $hasil->fetch_array()) {
 	$brandId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeBrands = "<label class='label label-success'>Tersedia</label>";
 	} else {
 		// deactivate member
 		$activeBrands = "<label class='label label-danger'>Tidak Tersedia</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Tindakan <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Hapus</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeBrands,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);