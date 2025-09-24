<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<script>
// function myFunction() {
// var input, filter, table, tr, td, i, txtValue;
// input = document.getElementById("txtItemSearch");
// filter = input.value.toLowerCase();
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// alert(1);
// }

// $(document).ready(function(){
// $("#txtItemSearch").on("keyup", function() {
// var value = $(this).val().toLowerCase();
// alert(2);
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// });
</script>

<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");
$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
$BillMode = mysqli_real_escape_string($connection, $_POST["BillMode"]);
$Location = mysqli_real_escape_string($connection, $_POST["Location"]);
$DiscountStatus = mysqli_real_escape_string($connection, $_POST["DiscountStatus"]);
$DeliveryStatus = mysqli_real_escape_string($connection, $_POST["DeliveryStatus"]);

if($DeliveryStatus=='All')
{
    $DeliveryStatusSaleItems =' a.deliverystatus =1 ';
    $DeliveryStatusSaleItemsProduct =' a.deliverystatus =0 ';
}
else if($DeliveryStatus=='Delivered')
{
    $DeliveryStatusSaleItems =' a.deliverystatus =1 ';
    $DeliveryStatusSaleItemsProduct =' a.deliverystatus =10 ';
}
else if($DeliveryStatus=='UnDelivered')
{
    $DeliveryStatusSaleItems =' a.deliverystatus =10 ';
    $DeliveryStatusSaleItemsProduct =' a.deliverystatus =0 ';
}


//$Location = $_SESSION['SESS_LOCATION'];



if ($BillMode == 'All') {
    $BillMode = '%';
}


if ($Location == 'All') {
    $Location = '%';
}


if ($DiscountStatus == 'All') {
    $DiscountStatus = ' ';
    $DiscountStatusMaster = ' ';
} else if ($DiscountStatus == 'Discount') {
    $DiscountStatus = ' and discountamount > 0 ';
    $DiscountStatusMaster = ' and a.discountamount > 0 ';
} else if ($DiscountStatus == 'Regular') {
    $DiscountStatus = ' and discountamount = 0 ';
    $DiscountStatusMaster = ' and a.discountamount = 0 ';
}

$FromDate = explode('/', $FromDate);
$ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0];
$ToDate = explode('/', $ToDate);
$ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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

    // $result = mysqli_query($connection, " 
    // SELECT saleuniqueno,CONCAT(invoiceno,'-',saleid) AS Bill,DATE_FORMAT(saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
    // saleqty,discountamount,nettamount,received,profitamount,locationcode,a.transactiontype FROM salemaster  AS a
    // JOIN paitentmaster AS b ON a.paitientcode=b.paitentid
    // WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and locationcode like('$Location') and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0 ");


    $result = mysqli_query($connection, " 

 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,d.couriercharge,a.received,a.profitamount,a.locationcode,a.transactiontype, 
 SUM(c.returnstatus) as returnstatus,saletype,IFNULL(courierservice,'-'),c.barcode,e.username,a.deliverystatus,
 g.username
   FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid 
 JOIN newsaleitems AS c ON  a.saleuniqueno=c.invoiceno 
 LEFT JOIN (SELECT SUM(couriercharge) AS couriercharge,invoicenumber,courierservice FROM  courierdetails GROUP BY invoicenumber) AS d ON  a.saleuniqueno=d.invoicenumber
 left join usermaster as e on a.addedby=e.userid
 left join deliverydetails as f on a.saleuniqueno=f.invoiceno
 left join usermaster as g on f.deliveredby=g.userid

 WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') and a.transactiontype in('Sale','Return')
  and cancellstatus =0 and $DeliveryStatusSaleItems and 
 saletype like ('%" . $BillMode . "%') $DiscountStatusMaster
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) ,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,a.received,a.profitamount,a.locationcode,a.transactiontype,saletype,
 courierservice ,d.couriercharge
 
 union 
 
 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,d.couriercharge,a.received,a.profitamount,a.locationcode,a.transactiontype, 
 SUM(c.returnstatus) as returnstatus,saletype,IFNULL(courierservice,'-'),'Not Delivered',e.username,a.deliverystatus,
 'Not Delivered'  FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid 
 JOIN newsaleitemsproduct AS c ON  a.saleuniqueno=c.invoiceno 
 LEFT JOIN (SELECT SUM(couriercharge) AS couriercharge,invoicenumber,courierservice FROM  courierdetails GROUP BY invoicenumber) AS d ON  a.saleuniqueno=d.invoicenumber
 left join usermaster as e on a.addedby=e.userid
 WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') and 
 a.transactiontype in('Sale','Return') and cancellstatus =0 and  $DeliveryStatusSaleItemsProduct and 
 saletype like ('%" . $BillMode . "%') $DiscountStatusMaster
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) ,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,a.received,a.profitamount,a.locationcode,a.transactiontype,saletype,
 courierservice ,d.couriercharge
 
 union 

 
  SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,d.couriercharge,a.received,a.profitamount,a.locationcode,a.transactiontype, 
 SUM(c.returnstatus) as returnstatus,saletype,IFNULL(courierservice,'-'),'-','-','1','Delivered'  FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid 
 JOIN  saleitems AS c ON  a.saleuniqueno=c.invoiceno 
 LEFT JOIN (SELECT SUM(couriercharge) AS couriercharge,invoicenumber,courierservice FROM  courierdetails GROUP BY invoicenumber) AS d ON  a.saleuniqueno=d.invoicenumber
 WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') 
 and a.transactiontype in('Sale','Return') and cancellstatus =0 and 
 saletype like ('%" . $BillMode . "%')  $DiscountStatusMaster
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) ,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 a.saleqty,a.discountamount,a.nettamount,a.received,a.profitamount,a.locationcode,a.transactiontype,saletype,
 courierservice ,d.couriercharge
 
 
 
 
 ");



    //echo "<table id='tblProject' class='tblMasters'>";
    echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
    echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden  width='%'> Unique No </th>    
		<th width='%'> Bill No </th>    
		<th  width='%'> Date</a></th>    
		<th  width='%'> Patient  </th>     
		<th width='%'> Qty</th>           
		<th width='%'> Discount </th>        
		<th width='%'> Amount </th>        
		<th width='%'> Courier.Chg </th>        
		<th width='%'> Received Amount </th>        
		<th width='%' hidden> Profit</th>      
        <th width='%'> Billed</th>      
        <th width='%'> Delivered</th>      
		<th width='%'> View</th>           
	          
		<th width='%'> Return</th>           
		<th width='%'> </th>           
		<th width='%'> </th>           
        <th width='%'> </th>
        <th width='%'> </th>
		</tr> </thead> <tbody id='tblSalesDetail' >";

    $SerialNo = 1;
    while ($data = mysqli_fetch_row($result)) {
        echo "
  <tr>
  <td width='%'><a href='../assets/Custom/IndexTable.js'> $SerialNo</a></td>
  <td hidden id ='InvoiceNo' > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'style='text-align:right;' >";
        echo formatMoney($data[4], false);
        echo "</td>    
   <td width='%'style='text-align:right;' >";
        echo formatMoney($data[5], true);
        echo "</td>       
   <td width='%' style='text-align:right;'>";
        echo formatMoney($data[6], true);
        echo "</td> 
   <td width='%' style='text-align:right;'>";
        echo formatMoney($data[7], true);
        echo "</td> 
   <td  width='%' style='text-align:right;'>";
        echo formatMoney($data[8], true);
        echo "</td> 
   <td hidden width='%' style='text-align:right;'>";
        echo formatMoney($data[9], true);
       
        echo "</td> ";
        echo "<td>$data[16]</td>";
        echo "<td>$data[18]</td>";
        
   echo "<td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td>
<td align='center' style='color:#009ad9'>";

    if ($data[11] == 'Return') {
    echo "
<td></td>";
} else {

echo "<a href='' data-toggle='modal' data-target='#myModalReturn' onclick='LoadItemDetails(" . $data[0] . ");'> <i
        data-toggle='tooltip' class='fa fa-2x  fa-mail-reply-all text-warning' title='Sales Return'></i></a>";
}
echo "</td>";


if ($data[17] =='1') {
echo "<td></td>";
} else {

echo "<td align='center' style='color:#009ad9'>
    <a href='ItemDeliveryNew.php?MID=61&invoice=$data[0]' target='_blank' ?>
        <i class='fa fa-2x fa-pencil' title='View'></i></a>
</td> ";
}


echo "<td align='center' style='color:#009ad9'>";
    if ($data[11] == 'Return' || $data[10] == 'Cancelled') {
    } else {
    if ($data[12] == 0) {
    echo "


    <a href='' data-toggle='modal' data-target='#myModalCancel' onclick='LoadCancelBillDetail($data[0],$data[10]);'> <i
            class='fa fa-2x  fa-times-circle text-danger' title='Sales Cancel'></i></a>";
    }
    }

    echo "
</td>";


echo "<td align='center' style='color:#009ad9'>";

    if ($data[13] == 'Courier' || $data[13] == 'Online') {
    if ($data[14] == '0') {


    echo "<a href='' data-toggle='modal' data-target='#myModalCourierTracking'
        onclick='LoadCancelBillDetail(" . $data[0] . ");'> <i class='fa fa-2x  fa-truck text-danger'
            title='Courier Details'></i></a>";
    } else {
    echo "<a href='' data-toggle='modal' data-target='#myModalCourierTrackingDetails'
        onclick='LoadCourierDetails(" . $data[0] . ");'> <i class='fa fa-2x  fa-truck text-success'
            title='View Courier Details'></i></a>";
    }
    } else {
    echo "";
    }
    echo "</td>";

echo "<td align='center' style='color:#009ad9'>
    <a href='ViewAbroad.php?invoice=$data[0]' target='_blank' ?>
        <i class='fa fa-2x fa-plane' title='View'></i></a>
</td>";

echo "<td align='center' style='color:#009ad9'>
    <a href='' data-toggle='modal' data-target='#myModifyPaymentMode' onclick='LoadCancelBillDetail(" . $data[0] . ");'>
        <i class='fa fa-2x  fa-pencil-square-o' title='Sales Cancel'></i></a>";



    echo "
</td>";




echo "</tr>";

//echo "<tr>
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
    }
    echo "</tbody>
    </table>";
    } else if ($Type == 'ProductWise') {

    // $result = mysqli_query($connection, "
    // SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'),
    // CONCAT(b.paitentname,' (',b.mobileno,')'),
    // `shortcode`,`category`,`productname`,`rate`,`mrp`,
    // c.saleqty,c.discountamount,c.nettamount,c.profitamount,a.locationcode,a.transactiontype FROM salemaster AS a
    // JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN newsaleitems AS c ON a.`saleuniqueno`=c.`invoiceno`
    // WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') and
    // a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0 ");


    $result = mysqli_query($connection, "

    SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,concat (DATE_FORMAT(a.saledate,'%d-%m-%Y'),
    DATE_FORMAT(a.entrydate,' %H:%i %p')),
    CONCAT(b.paitentname,'
    (',b.mobileno,')'),
    shortcode,c.category,productname,rate,mrp,
    sum(c.saleqty),sum(c.discountamount),sum(c.nettamount),sum(c.profitamount),a.locationcode,a.transactiontype
    ,SUM(c.returnstatus),saletype,IFNULL(courierservice,'-'),e.username,f.username FROM salemaster AS a
    JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN newsaleitems AS c ON a.saleuniqueno=c.invoiceno
    LEFT JOIN courierdetails AS d ON a.saleuniqueno=d.invoicenumber
    left join usermaster as e on a.addedby=e.userid
    LEFT JOIN usermaster AS f ON c.employeecode=f.userid
    WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') AND
    a.transactiontype IN('Sale','Return') AND cancellstatus =0 and
    saletype like ('%" . $BillMode . "%') $DiscountStatus

    GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid),DATE_FORMAT(a.saledate,'%d-%m-%Y'),
    CONCAT(b.paitentname,' (',b.mobileno,')'),
    shortcode,c.category,productname,rate,mrp
    ,a.locationcode,a.transactiontype,saletype,courierservice,e.username,f.username

    union

    SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'),
    CONCAT(b.paitentname,'
    (',b.mobileno,')'),
    shortcode,c.category,productname,rate,mrp,
    sum(c.saleqty),sum(c.discountamount),sum(c.nettamount),sum(c.profitamount),a.locationcode,a.transactiontype
    ,SUM(c.returnstatus),saletype,IFNULL(courierservice,'-'),e.username,f.username FROM salemaster AS a
    JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN saleitems AS c ON a.saleuniqueno=c.invoiceno
    LEFT JOIN courierdetails AS d ON a.saleuniqueno=d.invoicenumber
    left join usermaster as e on a.addedby=e.userid
    LEFT JOIN usermaster AS f ON c.employeecode=f.userid
    WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') AND
    a.transactiontype IN('Sale','Return') AND cancellstatus =0 and
    saletype like ('%" . $BillMode . "%') $DiscountStatus

    GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid),DATE_FORMAT(a.saledate,'%d-%m-%Y'),
    CONCAT(b.paitentname,' (',b.mobileno,')'),
    shortcode,c.category,productname,rate,mrp
    ,a.locationcode,a.transactiontype,saletype,courierservice,e.username,f.username


    ");


    //echo "<table id='tblProject' class='tblMasters'>";
        echo "";
        echo " <table id='tblItemwise' name='tblItemwise' class='table table-striped table-bordered'>";
            echo " <thead>
                <tr>
                    <th>S.No</th>
                    <th hidden width='%'> Unique No </th>
                    <th width='%'> B.No </th>
                    <th width='%'> Date</a></th>
                    <th width='%'> Patient </th>
                    <th width='%'> S.Code </th>
                    <th width='%' hidden> Category </th>
                    <th width='%' id='Pr'> Product </th>
                    <th width='%' hidden> Cost </th>
                    <th width='%'> MRP </th>
                    <th width='%'> Qty</th>
                    <th width='%'> Discount </th>
                    <th width='%'> Nett.Amt </th>
                    <th width='%' hidden> Profit</th>
                    <th width='%'> User</th>
                    <th width='%'> Sold By</th>

                    <th width='%'> View</th>
                    <th width='%'> Return</th>
                    <th width='%'> Cancel</th>
                    <th width='%'> Courier</th>

                </tr>
            </thead>
            <tbody id='tblSalesDetails'>";

                $SerialNo = 1;
                while ($data = mysqli_fetch_row($result)) {
                echo "
                <tr>
                    <td width='%'>$SerialNo</td>
                    <td hidden id='InvoiceNo'> $data[0]</td>
                    <td>$data[1]</td>
                    <td width='%'>$data[2]</td>
                    <td width='%'>$data[3]</td>
                    <td width='%'>$data[4]</td>
                    <td width='%' hidden>$data[5]</td>
                    <td width='%'>$data[6]</td>
                    <td width='%' hidden style='text-align:right;'>";
                        echo formatMoney($data[7], false);
                        echo "</td>
                    <td width='%' style='text-align:right;'>";
                        echo formatMoney($data[8], false);
                        echo "</td>
                    <td width='%' style='text-align:right;'>";
                        echo formatMoney($data[9], false);
                        echo "</td>
                    <td width='%' style='text-align:right;'>";
                        echo formatMoney($data[10], true);
                        echo "</td>
                    <td width='%' style='text-align:right;'>";
                        echo formatMoney($data[11], true);
                        echo "</td>
                    <td hidden width='%' style='text-align:right;'>";
                        echo formatMoney($data[12], true);
                        echo "</td>";
                    echo "<td>$data[18]</td>";
                    echo "<td>$data[19]</td>";
                    echo "<td align='center' style='color:#009ad9'>
                        <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
                            <i class='fa fa-2x fa-eye' title='View'></i></a>
                    </td>
                    <td align='center' style='color:#009ad9'>";

                        if ($data[14] == 'Return') {
                        } else {
                        echo "

                        <a href='' data-toggle='modal' data-target='#myModalReturn'
                            onclick='LoadItemDetails(" . $data[0] . ");'> <i
                                class='fa fa-2x  fa-mail-reply-all text-warning' title='Sales Return'></i></a>";
                        }
                        echo "
                    </td>
                    <td align='center' style='color:#009ad9'>";
                        if ($data[14] == 'Return' || $data[10] == 'Cancelled') {
                        } else {
                        if ($data[15] == 0) {

                        echo "


                        <a href='' data-toggle='modal' data-target='#myModalCancel'
                            onclick='LoadCancelBillDetail(" . $data[0] . ");'> <i
                                class='fa fa-2x  fa-times-circle text-danger' title='Sales Cancel'></i></a>";
                        }
                        }

                        echo "
                    </td>";

                    echo "<td align='center' style='color:#009ad9'>";

                        if ($data[16] == 'Courier' || $data[16] == 'Online') {


                        if ($data[17] == '0') {


                        echo "<a href='' data-toggle='modal' data-target='#myModalCourierTracking'
                            onclick='LoadCancelBillDetail(" . $data[0] . ");'> <i class='fa fa-2x  fa-truck text-danger'
                                title='Courier Details'></i></a>";
                        } else {
                        echo "<a href='' data-toggle='modal' data-target='#myModalCourierTrackingDetails'
                            onclick='LoadCourierDetails(" . $data[0] . ");'> <i class='fa fa-2x  fa-truck text-success'
                                title='View Courier Details'></i></a>";
                        }
                        } else {
                        }

                        echo "</td>
                </tr>";


                //echo "<tr>

                    //echo "<br>";
                    $SerialNo = $SerialNo + 1;
                    }
                    echo "
            </tbody>
        </table>";
        } else {

        $result = mysqli_query($connection, "


        SELECT DATE_FORMAT(a.saledate,'%d-%m-%Y'), SUM(a.saleqty) AS Qty,ROUND(SUM(a.discountamount),2) AS Discount,
        ROUND(SUM(a.nettamount),2) AS TotalSale,
        ROUND(SUM(d.couriercharge),2) AS CourierCharge,
        ROUND(SUM(a.received),2) AS Received,ROUND(SUM(a.profitamount),2) AS Profit,locationcode FROM salemaster AS a

        LEFT JOIN courierdetails AS d ON a.saleuniqueno=d.invoicenumber
        WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode like('$Location') and
        a.transactiontype in('Sale','Return') and cancellstatus =0 and
        saletype like ('%" . $BillMode . "%') $DiscountStatus
        GROUP BY locationcode ,DATE_FORMAT(a.saledate,'%d-%m-%Y') ");

        //echo "<table id='tblProject' class='tblMasters'>";
            echo " <table id='data-table' class='table table-striped table-bordered'>";
                echo " <thead>
                    <tr>
                        <th>S.No</th>

                        <th width='%'> Date</a></th>
                        <th width='%'> Qty</th>
                        <th width='%'> Discount </th>
                        <th width='%'> Nett Amount </th>
                        <th width='%'> Courier. Chg </th>
                        <th width='%'> Received Amount </th>
                        <th width='%' hidden> Profit</th>
                    </tr>
                </thead>
                <tbody id='tblSalesDetails'>";

                    $SerialNo = 1;
                    while ($data = mysqli_fetch_row($result)) {
                    echo "
                    <tr>
                        <td width='10%'>$SerialNo</td>
                        <td> $data[0]</td>
                        <td>$data[1]</td>
                        <td width='%' style='text-align:right;'>";
                            echo formatMoney($data[2], false);
                            echo "</td>
                        <td width='%' style='text-align:right;'>";
                            echo formatMoney($data[3], false);
                            echo "</td>
                        <td width='%' style='text-align:right;'>";
                            echo formatMoney($data[4], false);
                            echo "</td>
                        <td width='%' style='text-align:right;'>";
                            echo formatMoney($data[5], false);
                            echo "</td>
                        <td hidden width='%' style='text-align:right;'>";
                            echo formatMoney($data[6], false);
                            echo "</td>

                    </tr>";


                    //echo "<tr>

                        //echo "<br>";
                        $SerialNo = $SerialNo + 1;
                        }
                        echo "
                </tbody>
            </table>";
            }

            ?>