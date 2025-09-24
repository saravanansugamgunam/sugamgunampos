<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["MappingId"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
 $MappingId = mysqli_real_escape_string($connection, $_POST["MappingId"]);    

   
   
  try {
    $AddPaymentMode = "delete from  diseasemapping where  mappingid='$MappingId'  "; 
  
 mysqli_query($connection, $AddPaymentMode); 
echo "Selected detail removed";
// echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>