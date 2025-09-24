<?php

session_cache_limiter(FALSE);
session_start();

if (isset($_POST["Barcode"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
  $LocationCode = mysqli_real_escape_string($connection, $_POST["Location"]);

  $GroupID = $_SESSION['SESS_GROUP_ID'];

  $result = mysqli_query($connection, "
 SELECT stockitemid,shortcode,productname,batchno,mrp,expirydate,
 SUM(currentstock) AS stock   
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
    <td width='%'>$data[6]</td>    
    <td width='%'>
    <a href='#modalStockModification' data-toggle='modal' onclick='LoadStockItemID($data[0],$data[6]);'> 
     <i class='fa  fa-pencil' style='cursor:pointer'></i>Adjust Stock</a> </td>        
   </tr>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}
