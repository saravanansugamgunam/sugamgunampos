	<?php

	session_cache_limiter(FALSE);
	session_start();

	//insert.php
	if (isset($_POST["SupplierCode"])) {

		// echo "1"; 
		include("../../../connect.php");

		$currentdate = date("Y-m-d H:i:s");
 
		$SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
		$ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
		$MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);
		$BatchNo = mysqli_real_escape_string($connection, $_POST["BatchNo"]);
		$Expiry = mysqli_real_escape_string($connection, $_POST["Expiry"]);

		$PurchaseQty = mysqli_real_escape_string($connection, $_POST["PurchaseQty"]);
		$FreeQty = mysqli_real_escape_string($connection, $_POST["FreeQty"]);
		$BilledQty = mysqli_real_escape_string($connection, $_POST["BilledQty"]);

		$LineTotalAmount = mysqli_real_escape_string($connection, $_POST["LineTotalAmount"]);
		$GSTPercent = mysqli_real_escape_string($connection, $_POST["GSTPercent"]);
		$GSTAmount = mysqli_real_escape_string($connection, $_POST["GSTAmount"]);
		$DiscountPercentage = mysqli_real_escape_string($connection, $_POST["DiscountPercentage"]);
		$DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]);
		$GrossAmount = mysqli_real_escape_string($connection, $_POST["GrossAmount"]);
		$BilledQty = mysqli_real_escape_string($connection, $_POST["BilledQty"]);
  
		$BillStatus = mysqli_real_escape_string($connection, $_POST["BillStatus"]);


		$Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);
		$LineNettAmount = mysqli_real_escape_string($connection, $_POST["LineNettAmount"]);
		$Profit = mysqli_real_escape_string($connection, $_POST["Profit"]);
		$PurchaseDate = mysqli_real_escape_string($connection, $_POST["InvoiceDate"]);
		$Shortcode = mysqli_real_escape_string($connection, $_POST["Shortcode"]);
		$Category = mysqli_real_escape_string($connection, $_POST["Category"]);
		$ProductName = mysqli_real_escape_string($connection, $_POST["ProductName"]);
		$ManufactureDate = mysqli_real_escape_string($connection, $_POST["ManufactureDate"]);
		$SupplierInvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
		$ReceiptDate = mysqli_real_escape_string($connection, $_POST["ReceiptDate"]);
		$Location = mysqli_real_escape_string($connection, $_POST["Location"]);
		$GRNNo = mysqli_real_escape_string($connection, $_POST["GRNNo"]);
 

		$LocationCode =  $Location; 
		$userid = $_SESSION['SESS_MEMBER_ID'];
		$ClientID = 4; 

		$date = new DateTime();
		$PurchaseUniqueNo = $date->format('U');
		try {
 
			$sql = '';
			$sql .= "insert into purchaseitemsnew (clientid,suppliercode,invoicedate,productcode,batchno,expirydate,
			qty,billedqty,freeqty,rate,mrp,profit,totalamount,addedby,
			manufacturedate,supplierinvoice,receiptdate,grnnumber,barcode,barcodeno,gstpercent,
			gstamount,discount,withgst,discountpercent,grossamount,nettamount) values 
			('$LocationCode','$SupplierCode','$PurchaseDate','$ProductCode','$BatchNo','$Expiry',
			'$PurchaseQty','$BilledQty','$FreeQty','$Rate','$MRP','$Profit','$LineTotalAmount','$userid',
			'$ManufactureDate','$SupplierInvoiceNo','$ReceiptDate','$GRNNo',
			(select uniquebarcode from productmaster where productid ='$ProductCode'),'0','$GSTPercent',
			'$GSTAmount','$DiscountAmount','$BillStatus','$DiscountPercentage','$GrossAmount','$LineNettAmount')";
 

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