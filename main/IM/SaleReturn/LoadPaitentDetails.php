<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["MobileNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
 $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);


 
// $query=mysqli_query($connection, "SELECT paitentid, paitentname  FROM  paitentmaster WHERE mobileno ='".$MobileNo."'"); 
// $query=mysqli_query($connection, "SELECT paitentid, paitentname,IFNULL(SUM(newbalance),0) AS Balance 
// FROM paitentmaster AS a LEFT JOIN salemaster AS b ON a.paitentid = b.paitientcode WHERE mobileno ='".$MobileNo."' 
// GROUP BY paitentid, paitentname ");

// $query=mysqli_query($connection, "SELECT paitentid, paitentname,IFNULL(newbalance,0) AS Balance   
// FROM paitentmaster AS a LEFT JOIN salemaster AS b ON a.paitentid = b.paitientcode WHERE mobileno ='".$MobileNo."' 
 // ORDER BY saleid   DESC LIMIT 1 ");
 
 if($Barcode<>'')
 {
  $query=mysqli_query($connection, "
  SELECT a.paitentid, paitentname,topay-receipt AS Balance,COUNT(b.orderid) AS TotalOrders,discountstatus,mobileno,
  medicinediscount,consultingdiscount,therapydiscount,
  (SELECT COUNT(*) AS TotalEstimate FROM salemaster_estimate WHERE paitientcode in(
    SELECT paitentid FROM paitentmaster WHERE barcode ='$Barcode'  and estimateclosure=0)) as TotalEstimate 
 FROM paitentmaster AS a LEFT JOIN paitientorder AS b ON a.paitentid = b.paitentid AND 
 b.orderstatus in('Open','Purchased')
   WHERE a.barcode ='".$Barcode."'");
 }
 else
 {
  $query=mysqli_query($connection, "
  SELECT a.paitentid, paitentname,topay-receipt AS Balance,COUNT(b.orderid) AS TotalOrders,discountstatus,mobileno,
  medicinediscount,consultingdiscount,therapydiscount,
  (SELECT COUNT(*) AS TotalEstimate FROM salemaster_estimate WHERE paitientcode ='$MobileNo' and estimateclosure=0) as TotalEstimate 
 FROM paitentmaster AS a LEFT JOIN paitientorder AS b ON a.paitentid = b.paitentid AND 
 b.orderstatus in('Open','Purchased')
   WHERE a.paitentid ='".$MobileNo."'");
 }

 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['paitentname']; 
	   $data[] = $row['paitentid']; 
	    $data[] = $row['Balance']; 
	    $data[] = $row['TotalOrders']; 
	    $data[] = $row['discountstatus']; 
      $data[] = $row['mobileno']; 
      $data[] = $row['medicinediscount']; 
      $data[] = $row['TotalEstimate']; 
      
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>