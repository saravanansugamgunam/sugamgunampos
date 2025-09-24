 <?php
 
session_cache_limiter(FALSE);
session_start();
   include("../../../connect.php"); 
 $currentdate =date("Y-m-d");  
 
if(isset($_POST["UserID"]))
{  
 
 // $Status=1;
  $UserID = mysqli_real_escape_string($connection,$_POST["UserID"]); 
  $Locationcode = mysqli_real_escape_string($connection,$_POST["Locationcode"]);  
     
	$AddLead = "delete from uselocationmapping  where userid='$UserID' and locationid ='$Locationcode' "; 
  if (mysqli_multi_query($connection, $AddLead)) {
                
       
    echo "1";
   
          } else {
             echo $AddLead;
             // echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
          } 
  
   
}
else
{
	echo "0";
}


 
?>