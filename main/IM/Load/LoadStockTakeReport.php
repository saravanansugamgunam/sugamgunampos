<style>
table.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 40%;
    text-align: left;
    border-collapse: collapse;
}	

table.blueTable td,
table.blueTable th {
    border: 1px solid #AAAAAA;
    padding: 2px 2px;
    text-align: center;
}

table.blueTable tbody td {
    font-size: 13px;
    text-align: center;
}

table.blueTable tr:nth-child(even) {
    background: #D0E4F5;
}

table.blueTable thead {
    background: #83b3e4;
    background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    border-bottom: 1px solid #444444;
}

table.blueTable thead th {
    font-size: 14px;
    font-weight: normal;
    color: #FFFFFF;
    border-left: 1px solid #D0E4F5;
    padding: 5px 20px;

}

table.blueTable thead th:first-child {
    border-left: none;
}

table.blueTable tfoot {
    font-size: 14px;
    font-weight: bold;
    color: #FFFFFF;
    background: #D0E4F5;
    background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    border-top: 2px solid #444444;
}

table.blueTable tfoot td {
    font-size: 14px;
}

table.blueTable tfoot .links {
    text-align: right;
}

table.blueTable tfoot .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
}
  </style>

  <?php 

include("../../connect.php");
    
session_cache_limiter(FALSE);
session_start();
  $LocationCode = $_SESSION['SESS_LOCATION'];
  $UserID =$_SESSION['SESS_MEMBER_ID'];
  date_default_timezone_set('Asia/Kolkata'); 


  
function formatMoney($number, $fractional=false) {
	if ($fractional) {
		$number = sprintf('%.2f', $number);
	}
	while (true) {
		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
		if ($replaced != $number) {
			$number = $replaced;
		} else {
			break;
		}
	}
	return $number;
}

  $currentdate =date("d-m-Y h:i A"); 

  $ID = mysqli_real_escape_string($connection, $_POST["ID"]);
  $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
   
 
  
  $resultTotal = mysqli_query($connection, "
  SELECT barcodestatus, SUM(scanqty),SUM(currentstock),ROUND(SUM(currentstock*rate),0)  FROM stocktakeitems 
  WHERE stocktakeuniqueno ='$ID' GROUP BY barcodestatus  ORDER BY 1 DESC 
   ");
  echo"	<table width ='30%' class='  table-striped table-bordered' style='float:right'>
  <thead>
      <tr><th style='text-align:centre; padding: 5px 5px 5px 5px;'>Status</th>
          <th style='text-align:centre; padding: 5px 5px 5px 5px;'>Scanned Qty</th>
          <th  style='text-align:centre; padding: 5px 5px 5px 5px;' >Stock Qty</th>
          <th style='text-align:centre; padding: 5px 5px 5px 5px;'>Stock @ Cost</th> 
      </tr>
  </thead>
  <tbody>";
  
     $SerialNo = 1;
     while($data = mysqli_fetch_row($resultTotal))
     {
       echo "<tr> 
               <td style='text-align:left; padding: 5px 5px 5px 5px;'>$data[0]</td>
              <td style='text-align:right; padding: 5px 5px 5px 5px;'>$data[1]</td>
              <td  style='text-align:right; padding: 5px 5px 5px 5px;'>$data[2]</td>
              <td  style='text-align:right; padding: 5px 5px 5px 5px;'>$data[3]</td>  
              </tr>"; 
     }
 
  echo "</tbody>
</table>
<br><br> <br> <br> <br> <br> <br> <br> <br>  ";

 

			$result = mysqli_query($connection, " 
            SELECT stocktakeuniqueno,barcode,shortcode,category,productname,mrp,rate,
            scanqty,currentstock,barcodestatus FROM stocktakeitems 
            WHERE stocktakeuniqueno ='$ID'  AND barcodestatus like ('$Type')  ");
 

		echo"	<table id='data-table' class='table table-striped table-bordered'>
                                    <thead>
                                        <tr><th>#</th>
                                            <th>ID</th>
                                            <th>Barcode</th>
                                           
                                            <th>SC</th> 
											<th>Catgory</th>
                                            <th>Product</th>
                                            <th>MRP</th> 
                                            <th>Rate</th> 
                                            <th>Scan Qty</th>
                                            <th>Current Stock</th>  
                                            <th>Barcode Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    
									   $SerialNo = 1;
									   while($data = mysqli_fetch_row($result))
									   {
										 echo "<tr>
                                         <td>$SerialNo</td>
                                         		<td>$data[0]</td>
												<td>$data[1]</td>
												<td>$data[2]</td>
												<td>$data[3]</td> 
												<td>$data[4]</td>
													<td>$data[5]</td>
													<td>$data[6]</td>
                                                    <td>$data[7]</td>
                                                    <td>$data[8]</td>
                                                    <td>$data[9]</td>
														 
                                        		</tr>";
                                                $SerialNo= $SerialNo+1;
									   }
                                   
                                    echo "</tbody>
                                </table> ";
		 


 ?>




  <script src="../../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="../../assets/js/table-manage-default.demo.min.js"></script>

  <script>
$(document).ready(function() {
    App.init();
    TableManageDefault.init();
});
  </script>