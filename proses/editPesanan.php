<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$pesananId = $_POST['pesananId'];

	$pesananDate 						= date('Y-m-d', strtotime($_POST['pesananDate']));
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 						=	$_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 						= $_POST['discount'];
  $grandTotalValue 			= $_POST['grandTotalValue'];
  $bayar 								= $_POST['bayar'];
  $dueValue 						= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

				
	$sql = "UPDATE pesanans SET pesanan_date = '$pesananDate', client_name = '$clientName', client_contact = '$clientContact', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discount', grand_total = '$grandTotalValue', bayar = '$bayar', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', pesanan_status = 1 WHERE pesanan_id = {$pesananId}";	
	$connect->query($sql);
	
	$readyToUpdatepesananItem = false;
	// add the quantity from the pesanan item to produk table
	for($x = 0; $x < count($_POST['produkName']); $x++) {		
		//  produk table
		$updateprodukQuantitySql = "SELECT produk.quantity FROM produk WHERE produk.produk_id = ".$_POST['produkName'][$x]."";
		$updateprodukQuantityData = $connect->query($updateprodukQuantitySql);			
			
		while ($updateprodukQuantityResult = $updateprodukQuantityData->fetch_row()) {
			// pesanan item table add produk quantity
			$pesananItemTableSql = "SELECT pesanan_item.quantity FROM pesanan_item WHERE pesanan_item.pesanan_id = {$pesananId}";
			$pesananItemResult = $connect->query($pesananItemTableSql);
			$pesananItemData = $pesananItemResult->fetch_row();

			$editQuantity = $updateprodukQuantityResult[0] + $pesananItemData[0];							

			$updateQuantitySql = "UPDATE produk SET quantity = $editQuantity WHERE produk_id = ".$_POST['produkName'][$x]."";
			$connect->query($updateQuantitySql);		
		} // while	
		
		if(count($_POST['produkName']) == count($_POST['produkName'])) {
			$readyToUpdatepesananItem = true;			
		}
	} // /for quantity

	// hapus the pesanan item data from pesanan item table
	for($x = 0; $x < count($_POST['produkName']); $x++) {			
		$hapuspesananSql = "DELETE FROM pesanan_item WHERE pesanan_id = {$pesananId}";
		$connect->query($hapuspesananSql);	
	} // /for quantity

	if($readyToUpdatepesananItem) {
			// insert the pesanan item data 
		for($x = 0; $x < count($_POST['produkName']); $x++) {			
			$updateprodukQuantitySql = "SELECT produk.quantity FROM produk WHERE produk.produk_id = ".$_POST['produkName'][$x]."";
			$updateprodukQuantityData = $connect->query($updateprodukQuantitySql);
			
			while ($updateprodukQuantityResult = $updateprodukQuantityData->fetch_row()) {
				$updateQuantity[$x] = $updateprodukQuantityResult[0] - $_POST['quantity'][$x];							
					// update produk table
					$updateprodukTable = "UPDATE produk SET quantity = '".$updateQuantity[$x]."' WHERE produk_id = ".$_POST['produkName'][$x]."";
					$connect->query($updateprodukTable);

					// add into pesanan_item
				$pesananItemSql = "INSERT INTO pesanan_item (pesanan_id, produk_id, quantity, rate, total, pesanan_item_status) 
				VALUES ({$pesananId}, '".$_POST['produkName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($pesananItemSql);		
			} // while	
		} // /for quantity
	}

	

	$valid['success'] = true;
	$valid['messages'] = "Berhasil Di Update";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);