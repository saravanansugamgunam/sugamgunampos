<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PaitentID = mysqli_real_escape_string($connection, strtoupper($_POST["PaitentID"]));    
 $MedicineDiscount = mysqli_real_escape_string($connection, strtoupper($_POST["MedicineDiscount"]));   
 $ConsultingDiscount = mysqli_real_escape_string($connection, strtoupper($_POST["ConsultingDiscount"])); 
 $TherapyDiscount = mysqli_real_escape_string($connection, strtoupper($_POST["TherapyDiscount"])); 
 $DiscountStatus = mysqli_real_escape_string($connection, strtoupper($_POST["DiscountStatus"])); 

    
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update paitentmaster set discountstatus='$DiscountStatus',medicinediscount='$MedicineDiscount',
    consultingdiscount='$ConsultingDiscount',therapydiscount='$TherapyDiscount'  where paitentid='$PaitentID'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>