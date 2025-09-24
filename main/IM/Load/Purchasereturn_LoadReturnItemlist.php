<?php

session_cache_limiter(FALSE);
session_start();

if (isset($_POST["STOUniqueNo"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);

  $result = mysqli_query($connection, "
 
  SELECT barcode,shortcode,productname,batchcode,SUM(returnqty)  AS Qty, mrp*SUM(returnqty) AS Total , SUM(nettamount) AS nett, 
  currentstock FROM newpurchasereturnitems WHERE invoiceno ='$STOUniqueNo'
  GROUP BY shortcode,productname,currentstock,batchcode,barcode

 ");

  //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
  echo " <thead><tr>  
		<th>S. No</th>     
		<th   width='%'><a href=\"javascript:SortTable(2,'T');\">Barcode</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Short Code</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Product</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Batch No</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Nett Amount</a></th>    
		<th hidden width='%'> <a href=\"javascript:SortTable(3,'T');\">Current Stock</a></th>    
		 
		 
		</tr> </thead> <tbody id='ProjectTable'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td   > $data[0]</td>
  <td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>        
   <td id='TotalAmount' width='%'>$data[5]</td>     
   <td hidden>$data[6]</td>     
   <td align='center' width='%' style='color:#009ad9' hidden onclick='GetPointID(this)'  >
   <i class='fa fa-2x fa-trash'></i></td>  
    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}
