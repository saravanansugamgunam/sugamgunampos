<?php
session_start();
include('../connect.php');
$CurrentPassword = mysqli_real_escape_string($connection, $_POST["CurrentPassword"]);    
$NewPassword = mysqli_real_escape_string($connection, $_POST["NewPassword"]);    
$UserID = mysqli_real_escape_string($connection, $_POST["UserID"]);    
$PasswordinDB = "";
 
// header("location: Error.php");
// query
try {
	  

 $StockQuery =" update user set password ='$NewPassword' where id='$UserID'"; 
	 
  
 if (mysqli_query($connection, $StockQuery)) {
	echo "Password Changed";
} else {
echo "Error: " . $sql. "<br>" . mysqli_error($connection);
}

	 
	   
}
catch (PDOException $e) {
	  header("location: Error.php");
	 // echo ":PurchaseCode'=>$PurchaseCode,':ProductId'=>$ProductId,':CostPrice'=>$CostPrice,':Supplier'=>$Supplier,':ReceiptQty'=>$ReceiptQty,':PurchaseDate'=>$PurchaseDate,':ExpiryDate'=>$ExpiryDate,':PurchaseEntryDate'=>$PurchaseEntryDate";
 
}


 



?>