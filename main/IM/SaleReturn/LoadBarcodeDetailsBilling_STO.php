<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Barcode"])) {

   // echo "1";
   include("../../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
   $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];
   $LocationCode = $_SESSION['SESS_LOCATION'];

   if ($GroupID == 1) {
      $LocationCode = $LocationCodeAdmin;
   } else {
      $LocationCode = $_SESSION['SESS_LOCATION'];
   }


   $result = mysqli_query($connection, "
SELECT stockitemid,shortcode,productname,batchno,mrp,expirydate,
SUM(currentstock) AS stock,
DATEDIFF(DATE_FORMAT(CONCAT(
'20',SUBSTR(CONCAT('01/',expirydate), 7, 2),
'-',SUBSTR(CONCAT('01/',expirydate), 4, 2),
'-',SUBSTR(CONCAT('01/',expirydate), 1, 2)),'%Y-%m-%d'),CURRENT_DATE)  AS DaystoExpiry

FROM newstockdetails_" . $LocationCode . " WHERE barcode ='" . $Barcode . "' AND currentstock > 0
GROUP BY stockitemid,shortcode,productname,batchno,mrp,expirydate
 ");

   //echo "<table id='tblProject' class='tblMasters'>";
   echo " <table id='tblBill' class='table table-striped table-bordered'>";
   echo " <thead><tr>  
		<th>#</th>     
		<th hidden>Item ID</th>    
		<th>Batch</th>     
		<th>MRP</th>     
		<th>Expiry</th>     
		<th>Stock</th>     
		 
		 <th width='%'>  Select </th>   
		 
		</tr> </thead> <tbody id='ProjectTable'>";

  $SerialNo = 1;
   while ($data = mysqli_fetch_row($result)) {
      echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden >$data[0]</td>   
   <td width='%'>$data[3]</td>     	
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>    
   <td width='%'>$data[6]</td> ";
   if($data[7]<=30) 
   {
      echo "<td width='%'>Stock Expired</td>";
   }  
   else
   {
      echo "<td width='%'><button onclick='LoadBarcodeDetails_STO($data[0]);'>Select</button></td>";  
   }
         
 echo "</tr>";
      $SerialNo = $SerialNo + 1;
   }
   echo "</tbody></table>";
}
