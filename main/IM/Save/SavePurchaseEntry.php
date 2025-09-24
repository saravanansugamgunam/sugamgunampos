	<?php

	session_cache_limiter(FALSE);
	session_start();

	//insert.php
	if(isset($_POST["SupplierCode"]))
	{

	// echo "1";
	include("../../../connect.php"); 

	$currentdate =date("Y-m-d H:i:s");  


	$SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);  
	$ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);  
	$MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);   
	$BatchNo = mysqli_real_escape_string($connection, $_POST["BatchNo"]);   
	$Expiry = mysqli_real_escape_string($connection, $_POST["Expiry"]);   
	$Qty = mysqli_real_escape_string($connection, $_POST["PurchaseQty"]);   
	$Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);   
	$TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);   
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

	$GSTPercent = mysqli_real_escape_string($connection, $_POST["GSTPercent"]);   
	$GSTAmount = mysqli_real_escape_string($connection, $_POST["GSTAmount"]);
	$BillStatus = mysqli_real_escape_string($connection, $_POST["BillStatus"]);
	$Discount = 0; 
	$GSTAmountPerPeice=$GSTAmount/$Qty;
 
	$LocationCode =  $Location; //$_SESSION['SESS_LOCATION'];
	// $ClientID = $_SESSION["CMS_CompanyID"];
	// $userid = $_SESSION["CMS_EmployeeID"];
	$ClientID = 1;
	$userid = 1;	


	$date = new DateTime();
	$PurchaseUniqueNo = $date->format('U'); 
	try { 
 

	$mysql_qry ="SELECT 
	(SELECT barcodeprifix  FROM monthmaster WHERE yearname =  YEAR(CURRENT_DATE) AND
	MONTHNAME =MONTH(CURRENT_DATE)) AS Prefix,
	(SELECT  IFNULL(MAX(barcodeno),0)+1  FROM purchaseitemsnew WHERE barcode LIKE (SELECT CONCAT(barcodeprifix,'%') 
	FROM monthmaster WHERE yearname =  YEAR(CURRENT_DATE) AND
	MONTHNAME =MONTH(CURRENT_DATE))) AS BarcodeNo";

	$res = mysqli_query($connection,$mysql_qry); 

	while($row = mysqli_fetch_array($res)){

	$BarcodePrefix = $row['Prefix'];
	$BarcodeNo = $row['BarcodeNo'];

	}; 

	$sql='';
	 
	$values = array();
	for ($x=0; $x<$Qty; $x++){
	$values[] = "('$LocationCode','$SupplierCode','$PurchaseDate','$ProductCode','$BatchNo','$Expiry','1','$Rate','$MRP',
	'$Profit','$Rate','$userid','$currentdate','$ManufactureDate','$SupplierInvoiceNo','$ReceiptDate','$GRNNo',
	concat('$BarcodePrefix',$BarcodeNo),'$BarcodeNo','$GSTPercent','$GSTAmountPerPeice','$Discount','$BillStatus')";
	$BarcodeNo=$BarcodeNo+1;
	}

	$sql .= "insert into purchaseitemsnew (clientid,suppliercode,invoicedate,productcode,batchno,expirydate,qty,rate,
	mrp,profit,totalamount,addedby,addedon,manufacturedate,supplierinvoice,receiptdate,grnnumber,barcode,barcodeno,
	gstpercent,gstamount,discount,withgst) VALUES";
	$sql .= implode(",",$values);



	if (mysqli_multi_query($connection, $sql)) {

	// echo "Service Requese has been registered, Request ID is " . $last_id;
	echo  1;
	// echo $SaveSaleMaster;
	} else {
	echo "Error: " . $sql . "" . mysqli_error($connection);
	} 
 

	} catch (Exception $e) {
	echo 'Message: ' .$e->getMessage();
	}    

	}
	else
	{
	echo "Error";

	}

	?>