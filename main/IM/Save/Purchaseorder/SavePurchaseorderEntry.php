	<?php

	session_cache_limiter(FALSE);
	session_start();

	//insert.php
	if (isset($_POST["SupplierCode"])) {

		// echo "1"; 
		include("../../../connect.php");

		$currentdate = date("Y-m-d H:i:s");
 
		$Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);
		$MRP = mysqli_real_escape_string($connection, $_POST["MRP"]); 
		$SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
		$PODate = mysqli_real_escape_string($connection, $_POST["PODate"]);
		$PONumber = mysqli_real_escape_string($connection, $_POST["PONumber"]);
		$ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
		$Shortcode = mysqli_real_escape_string($connection, $_POST["Shortcode"]);
		$Category = mysqli_real_escape_string($connection, $_POST["Category"]);
		$ProductName = mysqli_real_escape_string($connection, $_POST["ProductName"]); 
		$Location = mysqli_real_escape_string($connection, $_POST["Location"]);
		$PurchaseQty = mysqli_real_escape_string($connection, $_POST["PurchaseQty"]); 
		$GrossAmount = mysqli_real_escape_string($connection, $_POST["GrossAmount"]); 
		$LineNettAmount = mysqli_real_escape_string($connection, $_POST["LineNettAmount"]);  
		$GSTPercent = mysqli_real_escape_string($connection, $_POST["GSTPercent"]);
		$GSTAmount = mysqli_real_escape_string($connection, $_POST["GSTAmount"]); 
		$BillStatus = mysqli_real_escape_string($connection, $_POST["BillStatus"]); 
		$PurchaseOrderUniqueNo = mysqli_real_escape_string($connection, $_POST["PurchaseOrderUniqueNo"]); 
		$UOM = mysqli_real_escape_string($connection, $_POST["UOM"]); 
		$LocationCode =  $Location; 
		$userid = $_SESSION['SESS_MEMBER_ID'];
		$ClientID = 4; 
 
		try {
 
			$sql = '';
			$sql .= "insert into purchaseorderitems (purchaseorderuniqueid,podate,clientid,suppliercode,productcode,barcode,
			qty,rate,mrp,grossamount,gstpercent,gstamount,withgst,nettamount,addedby,uom) values 
			('$PurchaseOrderUniqueNo','$PODate','$ClientID','$SupplierCode','$ProductCode',
			(select uniquebarcode from productmaster where productid ='$ProductCode'),
			'$PurchaseQty','$Rate','$MRP','$GrossAmount','$GSTPercent','$GSTAmount','$BillStatus','$LineNettAmount',
			'$userid','$UOM')";
 

	// 		$sql .= "insert into purchaseitemsnew (clientid,suppliercode,invoicedate,productcode,batchno,expirydate,qty,rate,
	// mrp,profit,totalamount,addedby,addedon,manufacturedate,supplierinvoice,receiptdate,grnnumber,barcode,barcodeno,
	// gstpercent,gstamount,discount,withgst) VALUES 
	// ('$LocationCode','$SupplierCode','$PurchaseDate','$ProductCode','$BatchNo','$Expiry','$Qty','$Rate','$MRP',
	// '$Profit','$LineNettAmount','$userid','$currentdate','$ManufactureDate','$SupplierInvoiceNo','$ReceiptDate','$GRNNo',
	// (select uniquebarcode from productmaster where productid ='$ProductCode'),'0','$GSTPercent','$GSTAmount',
	// '$Discount','$BillStatus') ";  

			if (mysqli_multi_query($connection, $sql)) {

				// echo "Service Requese has been registered, Request ID is " . $last_id;
				echo  1;
				// echo $SaveSaleMaster;
			} else {
				echo "Error: " . $sql . "" . mysqli_error($connection);
			}
		} catch (Exception $e) {
			echo 'Message: ' . $e->getMessage();
		}
	} else {
		echo "Error";
	}

	?>