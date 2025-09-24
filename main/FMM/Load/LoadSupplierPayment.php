<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 40%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
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
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>
<?php
  
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
				
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 		

 
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]); 
 $Period = mysqli_real_escape_string($connection,$_POST["Period"]);
 
		  
  if($Period=='Today')
  {
    $FromPeriod=$currentdate;
    $ToPeriod=$currentdate;

  }
  else if($Period=='Yesterday')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));
    $ToPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));
 
  }
  else if($Period=='CurrentMonth')
  {
    $FromPeriod=date('Y-m-01', strtotime($currentdate));
    $ToPeriod=date('Y-m-t', strtotime($currentdate));
 

  }
  else if($Period=='Last7Days')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $currentdate) ) ));
    $ToPeriod= $currentdate; 
  }
  else if($Period=='Last14Days')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-14 day' , strtotime ( $currentdate) ) ));
    $ToPeriod= $currentdate; 
  }
  else if($Period=='Last30Days')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $currentdate) ) ));
    $ToPeriod= $currentdate; 
  }
  else if($Period=='Custom')
  {
    $FromPeriod = $FromDate;
    $ToPeriod=$ToDate;
  }



 
	   
	    $TotalStock = mysqli_query($connection, "  
 SELECT SUM(expenseamount) Expense  FROM accountingtransaction where transactiontype ='Supplier Payment' and 
 ledgerid like ('$SupplierCode') and date between '$FromPeriod' and '$ToPeriod'
 ");
 
 
  echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:20%' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total Paid Amount </th>             
		 </tr>
  </thead> <tbody>";
 
while($data = mysqli_fetch_row($TotalStock))
{
  echo "
  <tr>     
   <td width='%'><b>&#x20B9; "; echo formatMoney($data[0], false); echo "</b></td> 
  
  </tr>";
   
   
}

echo "</tbody></table><br>";


$result = mysqli_query($connection, "  

SELECT  DATE_FORMAT(DATE,'%d/%m/%Y'),a.transactiongroup, UPPER(b.suplier_name),c.paymentmode,expenseamount,remarks
 FROM accountingtransaction
 AS a JOIN supliers AS b ON a.ledgerid=b.suplier_id JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  WHERE transactiontype ='Supplier Payment'  and 
 a.ledgerid like ('$SupplierCode') and date between '$FromPeriod' and '$ToPeriod'
 ORDER BY DATE DESC ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>              
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Group</a></th>         
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Supplier</a></th>       
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Mode</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Payment</a></th>        
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Remarks</a></th>  
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>  
   <td  width='%'>$data[3]</td>  
   ";
echo "<td width='%' align='right'>"; echo formatMoney($data[4], false); echo "</td>
<td  width='%'>$data[5]</td>  
  
      
   <td align='center' width='%' style='color:#009ad9'  onclick='GetPointID(this)' hidden><i class='fa fa-2x fa-edit'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>