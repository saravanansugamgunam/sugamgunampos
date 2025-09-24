<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StockTakeBy"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
   

   $StockTakeBy = mysqli_real_escape_string($connection, $_POST["StockTakeBy"]);  
   $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
   $Product = mysqli_real_escape_string($connection, $_POST["Product"]);
   $Group = mysqli_real_escape_string($connection, $_POST["Group"]);
   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["SESS_MEMBER_ID"];
   $userid = $_SESSION["SESS_MEMBER_ID"];
   $ClientID = 1;
   // $userid = 1;	

   try {
   $AddBatch = "insert into stocktakearea (stocktakelocation,remarks,incharge,createdby,productcode,groupid) values 
   ('$LocationCode','$Remarks','$StockTakeBy','$userid','$Product','$Group')"; 

   mysqli_query($connection, $AddBatch); 
   echo "1";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>