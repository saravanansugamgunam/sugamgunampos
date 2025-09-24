<?php
 
session_cache_limiter(FALSE);
session_start(); 
 include("../../../connect.php"); 

 if(isset($_POST["Invoice"]))
{

   	  
	 $currentdate =date("Y-m-d H:i:s"); 							  
	$Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
	$BillType = mysqli_real_escape_string($connection, $_POST["BillType"]);
	$StateCode = mysqli_real_escape_string($connection, $_POST["StateCode"]);

	$query=mysqli_query($connection, "
	SELECT ROUND(basiccharge + ChargeAbove250 + MarginAmount,0) AS TotalCourierCharge ,displayname
	FROM (
	    SELECT SUM(weight * saleqty) AS Weight,basiccharge,
	   IF((SUM(weight * saleqty)-250)>0,(SUM(weight * saleqty)-250),0) * (additionalcharge/500) AS ChargeAbove250,
	   (basiccharge +IF((SUM(weight * saleqty)-250)>0,(SUM(weight * saleqty)-250),0)  * (additionalcharge/500)) * (margin/100) AS MarginAmount,
	    margin,displayname  FROM  productmaster AS a JOIN newsaleitemsproduct AS b ON a.`productid`=b.`productcode`,
	   statemaster WHERE invoiceno='$Invoice' AND stateid ='$StateCode') as a  " );
	   
	   $data = array();
	  
	   while($row=mysqli_fetch_assoc($query))
	   { 
         if($BillType=='Courier')
         {
            $data[] = $row['TotalCourierCharge'];  
            $data[] = $row['displayname'];  
         }
         else
         {
            $data[] = 0;  
         }
	     
	   }
		
	echo json_encode($data);

	 
	   mysqli_close($connection);

 
}
?>