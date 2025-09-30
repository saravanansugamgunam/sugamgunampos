<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   
<?php
  
session_cache_limiter(FALSE);
session_start();
   
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
 
 $Type = 'Detail'; 
 $Paitent = mysqli_real_escape_string($connection, $_POST["Paitent"]); 
   
  $LocationCode = $_SESSION['SESS_LOCATION'];
  $Location='%';
  

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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
 
  
  
  
 if ($Type=='Detail')
 { 
 
 $result = mysqli_query($connection, " 

 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,  CONCAT(DATE_FORMAT(a.saledate,'%d-%m-%Y'),' ', 
  DATE_FORMAT(DATE_ADD(DATE_ADD(a.entrydate ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')) AS Bill, 
 d.locationname, 
 CONCAT(b.paitentname,' (',b.mobileno,')'),
 e.username,IFNULL(f.`username`,'Admin'),
 a.saleqty,a.discountamount,a.nettamount + a.couriercharges,a.received,a.profitamount,a.locationcode,a.transactiontype,
 SUM(c.returnstatus) as returnstatus FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid 
 JOIN newsaleitems AS c ON  a.saleuniqueno=c.invoiceno 
  join locationmaster as d on a.locationcode=d.locationcode
  join usermaster as e on a.doctorcode = e.userid
  LEFT JOIN usermaster AS f ON a.addedby = f.userid
 WHERE  b.paitentid = '$Paitent'  and a.locationcode like('$Location') and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0   
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) ,CONCAT(DATE_FORMAT(a.saledate,'%d-%m-%Y'),' ', 
  DATE_FORMAT(DATE_ADD(DATE_ADD(a.entrydate ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')),
   CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,a.received,a.profitamount,a.locationcode,
 a.transactiontype,d.locationname,e.username
 
 union
 
  SELECT saleuniqueno,
  CONCAT(a.invoiceno,'-',a.saleid) AS Bill,
  CONCAT(DATE_FORMAT(a.saledate,'%d-%m-%Y'),' ', 
  DATE_FORMAT(DATE_ADD(DATE_ADD(a.entrydate ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')) AS Bill, 
  d. locationname,
  CONCAT(b.paitentname,' (',b.mobileno,')'),
  e.username,
  IFNULL(f.`username`,'Admin'),

 a.saleqty,a.discountamount,a.nettamount + a.couriercharges,a.received,a.profitamount,a.locationcode,a.transactiontype, 
 SUM(c.returnstatus) as returnstatus FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid 
 JOIN saleitems AS c ON  a.saleuniqueno=c.invoiceno 
  join locationmaster as d on a.locationcode=d.locationcode
  
  join usermaster as e on a.doctorcode = e.userid
  LEFT JOIN usermaster AS f ON a.addedby = f.userid
 WHERE  b.paitentid = '$Paitent'  and a.locationcode like('$Location') and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0   
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) ,CONCAT(DATE_FORMAT(a.saledate,'%d-%m-%Y'),' ', 
  DATE_FORMAT(DATE_ADD(DATE_ADD(a.entrydate ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,a.received,a.profitamount,a.locationcode,a.transactiontype,d.locationname
 ,e.username
ORDER BY  saleuniqueno DESC
 ");
 
   
 
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden   width='%'> Unique No </th>    
		<th hidden  width='%'> Bill No </th>    
		<th  width='%'> Date</a></th>    
		<th  width='%'> Location</a></th>    
		<th  width='%'> Patient  </th>     
		<th  width='%'> Doctor  </th>     
		<th  width='%'> User  </th>     
		<th width='%'> Qty</th>           
		<th width='%'> Discount </th>        
		<th width='%'> Nett Amount </th>         
		<th width='%'> Type</th>           
		<th width='%'> View</th>           
		  
		 
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'><a href='../assets/Custom/IndexTable.js'> $SerialNo</a></td>
  <td hidden  id ='InvoiceNo' > $data[0]</td>
  <td  hidden >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
             
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[7], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[8], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[9], true); echo "</td>";
   if($data[13]=='Return')
   {
  echo " <td width='%'  style='color: red;'><b>$data[13]</b></td> ";
   }
   else
   {
    echo "   <td width='%'>$data[13]</td> ";

   }  
    
   echo "  
   <td align='center' style='color:#009ad9'  >
   <a href='SaleBillProductView.php?invoice=$data[0]' target='_blank' ?>
   <button  class='btn btn-sm btn-info btn-xs'>View</button></a></td>  
     
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 else if ($Type=='ProductWise')
 {
 
// $result = mysqli_query($connection, " 
 // SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 // `shortcode`,`category`,`productname`,`rate`,`mrp`,
 // c.saleqty,c.discountamount,c.nettamount,c.profitamount,a.locationcode,a.transactiontype FROM salemaster  AS a
 // JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN newsaleitems AS c ON a.`saleuniqueno`=c.`invoiceno`
 // WHERE  b.paitentid = '$Paitent'  and a.locationcode ='$LocationCode'  and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0 ");
 
 
 $result = mysqli_query($connection, "

 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), 
 d.locationname,
 CONCAT(b.paitentname,' (',b.mobileno,')'),
 shortcode,category,productname,rate,mrp,
 sum(c.saleqty),sum(c.discountamount),sum(c.nettamount),sum(c.profitamount),a.locationcode,a.transactiontype ,SUM(c.returnstatus) FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN newsaleitems AS c ON a.saleuniqueno=c.invoiceno  join locationmaster as d on a.locationcode=d.locationcode
 WHERE  b.paitentid = '$Paitent'  and a.locationcode like('$Location')   AND a.transactiontype NOT IN('Outstanding','Cancelled') AND cancellstatus =0   
 
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid),DATE_FORMAT(a.saledate,'%d-%m-%Y'),
  CONCAT(b.paitentname,' (',b.mobileno,')'),
 shortcode,category,productname,rate,mrp ,a.locationcode,a.transactiontype,d.locationname

union 

 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), d.locationname, CONCAT(b.paitentname,' (',b.mobileno,')'),
 shortcode,category,productname,rate,mrp,
 sum(c.saleqty),sum(c.discountamount),sum(c.nettamount),sum(c.profitamount),a.locationcode,a.transactiontype ,SUM(c.returnstatus) FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN saleitems AS c ON a.saleuniqueno=c.invoiceno
  join locationmaster as d on a.locationcode=d.locationcode 
 WHERE  b.paitentid = '$Paitent'  and a.locationcode like('$Location')   AND a.transactiontype NOT IN('Outstanding','Cancelled') AND cancellstatus =0   
 
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid),DATE_FORMAT(a.saledate,'%d-%m-%Y'),
  CONCAT(b.paitentname,' (',b.mobileno,')'),
 shortcode,category,productname,rate,mrp ,a.locationcode,a.transactiontype,d.locationname
   ");

 //echo "<table id='tblProject' class='tblMasters'>";
 echo "";
  echo "  <table id='tblItemwise' name='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden width='%'> Unique No </th>    
		<th width='%'> B.No </th>    
		<th  width='%'> Date</a></th>    
		<th  width='%'> Date</a></th>    
		<th  width='%'> Location  </th>     
		<th  width='%'> S.Code  </th>     
		<th  width='%'> Category  </th>     
		<th  width='%' id='Pr'> Product  </th>     
		<th  width='%'> Cost  </th>     
		<th  width='%'> MRP  </th>     
		<th width='%'> Qty</th>           
		<th width='%'> Discount </th>        
		<th width='%'> Nett.Amt </th>        
		<th width='%'> Profit</th>           
		<th width='%'> View</th>           
		  		
		 
		</tr> </thead> <tbody id='tblSalesDetails' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden id ='InvoiceNo' > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>         
   <td width='%'>$data[7]</td>         
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[8], false); echo "</td>       
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[9], false); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[10], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[11], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[12], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[13], true); echo "</td> 
   <td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
   <button  class='btn btn-sm btn-info btn-xs'>View</button></a></td>  
   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 
 else
	 
	 {
		 
$result = mysqli_query($connection, "  

    
 SELECT DATE_FORMAT(saledate,'%d-%m-%Y'), c.locationname,SUM(saleqty) AS Qty,ROUND(SUM(discountamount),2) AS Discount,
 ROUND(SUM(nettamount),2) AS TotalSale,
 ROUND(SUM(received),2) AS Received,ROUND(SUM(profitamount),2) AS Profit FROM salemaster  AS a 
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid  join locationmaster as c on a.locationcode=c.locationcode
 WHERE  b.paitentid = '$Paitent'   and a.locationcode like('$Location')  and a.transactiontype not in('Outstanding') and cancellstatus =0    
  GROUP BY c.locationname ,DATE_FORMAT(saledate,'%d-%m-%Y') ");
  
   

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th  width='%'> Location</a></th>     
		<th width='%'> Qty</th>           
		<th width='%' > Discount </th>        
		<th width='%'> Nett Amount </th>        
		<th width='%'> Received Amount </th>        
		<th width='%'> Profit</th>      
		</tr> </thead> <tbody  id='tblSalesDetails'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>  
  <td >$data[2]</td>  
    
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[3], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[5], false); echo "</td>  
   <td  width='%' style='text-align:right;' >"; echo formatMoney($data[6], false); echo "</td> 
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 