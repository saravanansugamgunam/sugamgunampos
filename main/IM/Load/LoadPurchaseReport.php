<style id="table_style" type="text/css">


</style>
<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");
$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$Type = mysqli_real_escape_string($connection, $_POST["Type"]);

$FromDate = explode('/', $FromDate);
$ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0];
$ToDate = explode('/', $ToDate);
$ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0];

$ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

function formatMoney($number, $fractional = false)
{
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

if ($Type == 'Detail') {

  $result = mysqli_query($connection, " 
  SELECT   DATE_FORMAT(a.invoicedate, '%d-%b-%y') AS InvoiceDate,a.grnnumber,c.suplier_name,
  DATE_FORMAT(a.receiptdate, '%d-%b-%y') AS ReceiptDate,
b.productshortcode,b.category,LEFT(b.productname,30),
a.batchno,a.manufacturedate, a.expirydate as expirydate,
SUM(a.qty) AS Qty,ROUND(a.rate),ROUND(a.mrp) , 
ROUND(SUM(a.gstamount)) AS Gst,
ROUND(SUM(a.totalamount)) AS Total,productcode,d.invoiceno 
  FROM purchaseitemsnew AS a JOIN productmaster AS b ON a.productcode = b.productid
JOIN supliers AS c ON a.suppliercode=c.suplier_id
JOIN purchasemaster AS d ON a.grnnumber=d.purchasegrn
 WHERE addedon BETWEEN '$ActualFromDate' AND '$ActualToDate' 
GROUP BY DATE_FORMAT(a.invoicedate, '%d-%b-%y'),a.productcode,a.rate,a.mrp,
b.productshortcode,b.category,b.productname,a.batchno, a.expirydate,
DATE_FORMAT(a.receiptdate, '%d-%b-%y'),a.grnnumber,productcode,d.invoiceno 
 


");


  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered' style='font-family: Arial;
  font-size: 10pt;border: 1px solid #ccc; border-collapse: collapse;'>";
  echo " <thead style='background-color: #F7F7F7;color: #333;font-weight: bold;' ><tr>  
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'>S.No</th>  
    <th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Inv.Date </th>		
    <th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Inv.No </th>		
    <th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> GRN </th>		
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Supplier </th>     
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Rec.Date </th>    
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> S.code</th>    
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Category </th>    
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'>  Product </th>        
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'>  Batch.No </th>      
    <th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'>  Mfg.Dt </th>        
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'>  Exp.Dt </th>        
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Qty </th>        
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Rate </th>        
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> MRP </th>          
    <th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> GST </th>    
		<th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Total </th>      
    <th style='background-color: #F7F7F7;color: #333;font-weight: bold;' width='%'> Edit </th>  
		</tr> </thead> <tbody  >";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td style='padding: 5px; border: 1px solid #ccc;'>$SerialNo</td>
  <td style='padding: 5px; border: 1px solid #ccc;'> $data[0]</td>
  
  <td style='padding: 5px; border: 1px solid #ccc;'>$data[16]</td> 
  <td style='padding: 5px; border: 1px solid #ccc;'>$data[1]</td>   
   <td  style='padding: 5px; border: 1px solid #ccc;' width='%'>$data[2]</td>   
   <td style='padding: 5px; border: 1px solid #ccc;'  width='%'>$data[3]</td>     
   <td style='padding: 5px; border: 1px solid #ccc;' width='%'>$data[4]</td>     
   <td style='padding: 5px; border: 1px solid #ccc;' width='%'>$data[5]</td>           
   <td style='padding: 5px; border: 1px solid #ccc; word-wrap:break-word;' width:3px;>$data[6]</td>            
   <td style='padding: 5px; border: 1px solid #ccc;' width='%'>$data[7]</td>            
   <td style='padding: 5px; border: 1px solid #ccc;'  width='%' style='text-align:right;'>$data[8]</td>             
   <td style='padding: 5px; border: 1px solid #ccc;' width='%' style='text-align:right;'>$data[9]</td>             
   <td style='padding: 5px; border: 1px solid #ccc;' width='%' style='text-align:right;'>$data[10]</td>     
   <td style='padding: 5px; border: 1px solid #ccc;' width='%' style='text-align:right;'>$data[11]</td>     
   <td style='padding: 5px; border: 1px solid #ccc;' width='%' style='text-align:right;'>";
    echo formatMoney($data[12], false);
    echo "</td> 
   <td style='padding: 5px; border: 1px solid #ccc;' width='%' style='text-align:right;'>";
    echo formatMoney($data[13], false);
    echo "</td>  
   <td style='padding: 5px; border: 1px solid #ccc;' width='%' style='text-align:right;'>";
    echo formatMoney($data[14], false);
    echo "</td>   
    <td style='padding: 5px; border: 1px solid #ccc;' align='center' style='color:#009ad9'   >
    <a href='' data-toggle='modal' data-target='#myModifyPaymentMode' 
    onclick='ModifyRate($data[1],$data[15],$data[11],$data[12]);'>
        <i class='fa fa-2x  fa-pencil-square-o' title='Sales Cancel'></i></a>
 </td>
  
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
} else {

  $result = mysqli_query($connection, "  
  SELECT  DATE_FORMAT(a.invoicedate, '%d-%b-%y') AS DATE,  c.suplier_name, 
SUM(a.qty) AS Qty,  ROUND(IFNULL(SUM(a.qty)*a.profit,0),2) AS Profit,
 ROUND(IFNULL(SUM(a.totalamount),0),2)  AS Total,
 a.suppliercode,DATE_FORMAT(a.invoicedate, '%Y-%m-%d'),grnnumber
 FROM purchaseitemsnew AS a JOIN productmaster AS b ON a.productcode = b.productid
JOIN supliers AS c ON a.suppliercode=c.suplier_id 
 WHERE addedon BETWEEN '$ActualFromDate' AND '$ActualToDate' 
 
GROUP BY DATE_FORMAT(a.invoicedate, '%d-%b-%y'), c.suplier_name,
 a.suppliercode,DATE_FORMAT(a.invoicedate, '%Y-%m-%d'),grnnumber


 ");


  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise1' class='table table-striped table-bordered'>";
  echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th  width='%'> Supplier</a></th>      
		<th width='%'> Qty</th>           
		<th width='%' > Profit </th>        
		<th width='%'> Nett Amount </th>     
		<th hidden width='%'> Supplier Code </th>     
		<th hidden width='%'> Date </th>     
		<th width='%'> View</th>     
		</tr> </thead> <tbody  >";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>   
   <td  width='%' style='text-align:right;' >";
    echo formatMoney($data[2], false);
    echo "</td>  
   <td width='%' style='text-align:right;' >";
    echo formatMoney($data[3], false);
    echo "</td>     
   <td width='%' style='text-align:right;' >";
    echo formatMoney($data[4], false);
    echo "</td>  
   <td hidden >$data[5]</td>  
   <td hidden >$data[6]</td>  
   <td align='center' style='color:#009ad9'  >
   <a href='PurchaseView.php?A=$data[7]&B=$data[6]' target='_blank' ?>
<button class='btn btn-sm btn-info btn-xs'>View</button></a></td>

</tr>";


    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody>
</table>";
}
?>