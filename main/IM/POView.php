
<html lang="en">
<?php 
  
    include("../../connect.php");
   
	 session_cache_limiter(FALSE);
    session_start();
	 $position = $_SESSION["SESS_LAST_NAME"]; 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   
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
					
    // $STOID = mysqli_real_escape_string($connection, $_POST["STOID"]); 
$POID=$_GET['POID'];


$res = $connection->query(" 
  SELECT b.suplier_name,b.suplier_address, b.suplier_contact,a.purchaseordernumber,DATE_FORMAT(a.orderdate,'%d-%m-%Y') AS orderdate,b.contact_person,
  a.totalqty, a.grossamount,
a.gst,a.nettamount FROM purchaseordermaster AS a JOIN supliers AS b ON a.suppliercode=b.suplier_id
WHERE a.id = '$POID';"); 
	   
while($data = mysqli_fetch_row($res))
{

$SupplierName=$data[0];
$SupplierAddress=$data[1];
$SupplierMobile=$data[2]; 
$OrderNo=$data[3]; 
$OrderDate=$data[4]; 

$OrderTotal=$data[6];
}



?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
          content="width=device-width, initial-scale=1.0">
    <title>Sugamgunam Purchase Order</title>
    <style>
        /* Set A4 size */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 0;
        }

        body {
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  font: 12pt "Tahoma";
}

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.page {
  width: 21cm;
  min-height: 29.7cm;
  padding: 2cm;
  margin: 1cm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.subpage {
  padding: 1cm;
  border: 5px red solid;
  height: 256mm;
  outline: 2cm #FFEAEA solid;
}

@page {
  size: A4;
  margin: 0;
}

</style> 

<script>
         function PrintOnLoad() {

             window.print();

         }
         </script>

</head>
<body onload='PrintOnLoad()'>

<p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;'>
    <strong><span style='font-size:37px;font-family:"Calibri Light",sans-serif;color:#8EA9DB;'>PURCHASE
                ORDER</span></strong></p>
<table style="border: none;border-collapse:collapse;">
    <tbody>
        <tr>
            <td colspan="2" style="width:190.45pt;padding:0in 5.4pt 0in 5.4pt;height:.5in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <span style='font-size:21px;font-family:"Calibri Light",sans-serif;'>&nbsp; &nbsp;Sugamgunam
                            Herbals</span></p>
            </td>
            <td style="width: 76.9pt;padding: 0in 5.4pt;height: 0.5in;vertical-align: bottom;">
                <br>
            </td>
            <td style="width: 54.3pt;padding: 0in 5.4pt;height: 0.5in;vertical-align: bottom;">
                <br>
            </td>
            <td style="width: 47.5pt;padding: 0in 5.4pt;height: 0.5in;vertical-align: bottom;">
                <br>
            </td>
            <td style="width: 128.6pt;padding: 0in 5.4pt;height: 0.5in;vertical-align: bottom;">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="width:267.35pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">AP 393,17TH STREET, THIRUVALLUVAR KUDIYIRIPPU, I
                            Block,</span></p>
            </td>
            <td style="width:54.3pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:47.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:right;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">DATE</span></p>
            </td>
            <td style="width:128.6pt;border:solid #A6A6A6 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;"><?php echo $OrderDate; ?></span></p>
            </td>
        </tr>
        <tr>
            <td style="width:179.35pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Anna Nagar, Chennai - 600040</span></p>
            </td>
            <td style="width:11.1pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:76.9pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:54.3pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:47.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:right;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">PO #</span></p>
            </td>
            <td style="width:128.6pt;border:solid #A6A6A6 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;"><?php echo $OrderNo; ?></span></p>
            </td>
        </tr>
        <tr>
            <td style="width:179.35pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Phone: 7502522666</span></p>
            </td>
            <td style="width:11.1pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:76.9pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:54.3pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width: 47.5pt;padding: 0in 5.4pt;height: 15pt;vertical-align: bottom;">
                <br>
            </td>
            <td style="width:128.6pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:190.45pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Mail: purchase@sugamgunam.com</span></p>
            </td>
            <td style="width:76.9pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:54.3pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:47.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:128.6pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
        </tr>
        <tr>
            <td style="width:179.35pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">GST No: 33BAZPM0405P1Z8</span></p>
            </td>
            <td style="width:11.1pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:76.9pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:54.3pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:47.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:128.6pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
        </tr>
    </tbody>
</table>
<p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
</p>
<table style="border: none;width:491.5pt;margin-left:13.5pt;border-collapse:collapse;">
    <tbody>
        <tr>
            <td style="width:89.0pt;background:#4472C4;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.05pt;line-height:normal;'>
                    <strong><span
                                style='font-size:13px;font-family:"Calibri Light",sans-serif;color:white;'>VENDOR</span></strong>
                </p>
            </td>
            <td style="width:60.0pt;background:#4472C4;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <strong><span
                                style='font-size:13px;font-family:"Calibri Light",sans-serif;color:white;'>&nbsp;</span></strong>
                </p>
            </td>
            <td style="width:59.0pt;background:#4472C4;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <strong><span
                                style='font-size:13px;font-family:"Calibri Light",sans-serif;color:white;'>&nbsp;</span></strong>
                </p>
            </td>
            <td style="width: 111.5pt;padding: 0in 5.4pt;height: 0.25in;vertical-align: bottom;">
                <br>
            </td>
            <td style="width:62.0pt;background:#4472C4;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.05pt;line-height:normal;'>
                    <strong><span style='font-size:13px;font-family:"Calibri Light",sans-serif;color:white;'>SHIP
                                TO</span></strong></p>
            </td>
            <td style="width:.5in;background:#4472C4;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <strong><span
                                style='font-size:13px;font-family:"Calibri Light",sans-serif;color:white;'>&nbsp;</span></strong>
                </p>
            </td>
            <td style="width:74.0pt;background:#4472C4;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <strong><span
                                style='font-size:13px;font-family:"Calibri Light",sans-serif;color:white;'>&nbsp;</span></strong>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="width:208.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;"><?php echo $SupplierName; ?></span></p>
            </td>
            <td style="width:111.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td colspan="2" style="width:98.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Sugamgunam&nbsp;Herbals</span></p>
            </td>
            <td style="width:74.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="width:208.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;"><?php echo $SupplierAddress; ?>,</span></p>
            </td>
            <td style="width:111.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td colspan="3" style="width:172.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">1395, H Block, 10th Street,&nbsp;</span></p>
            </td>
        </tr>
        <tr>
            <td style="width:89.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Phone:<?php echo $SupplierMobile; ?>&nbsp;</span></p>
            </td>
            <td style="width:60.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:59.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:111.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td colspan="3" style="width:172.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Behind 13th Main road, Annanagar</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:149.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;"> </span></p>
            </td>
            <td style="width:59.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:111.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td colspan="2" style="width:98.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Chennai - 600040</span></p>
            </td>
            <td style="width:74.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:149.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-indent:10.0pt;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;"> </span></p>
            </td>
            <td style="width:59.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td style="width:111.5pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
            <td colspan="2" style="width:98.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <span style="font-size:13px;font-family:Calibri;">Phone: 63851 61116</span></p>
            </td>
            <td style="width:74.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt;">
                <br>
            </td>
        </tr>
    </tbody>
</table>
<p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
    &nbsp;</p>

<style>


    .tableHeader {
        width:11.28%;
        border-top:solid #4472C4 1.0pt;
        border-left:none;
        border-bottom:solid #4472C4 1.0pt;
        border-right:none;
        background:#4472C4;
        padding:0in 0pt 0in 0pt;
        text-indent:10.0pt;
        height:.25in;
        margin-top:0in;
        margin-right:0in;
        margin-bottom:0in;
        margin-left:0in; 
        font-family:"Calibri",sans-serif;
        text-align:left;line-height:normal;
        color: white;
        font-size:13px;

    }

    
    .tableItem {
        
        border:none;
        border-bottom:solid #D9D9D9 1.0pt;
        padding:0in 5.4pt 0in 5.4pt;
        height:15.0pt;
        font-size:11.0pt;font-family:"Calibri",sans-serif;
     
        text-align:left;line-height:normal;
        text-indent:10.0pt;
    }
     

    .tableOrderTotal {
         
        border:none;
        border-bottom:solid #D9D9D9 1.0pt;
        padding:0in 5.4pt 0in 5.4pt;
        height:15.0pt;
        font-size:11.0pt;font-family:"Calibri",sans-serif;
        border-bottom:  double gray 2.25pt;
        text-align:left;line-height:normal;
        text-indent:10.0pt;
    }

    </style>
<table style="border: none;width:90.0%;margin-left:.25in;border-collapse:collapse;">
    <tbody>
        <tr>
            <td style='width:10%' class="tableHeader"><strong>S.No</strong> </td>

            <td style='width:10%' class="tableHeader"> <strong>ITEM NO</strong></td>

            <td style='width:70%' colspan="7" class="tableHeader"> <strong>DESCRIPTION</strong></td>
            <td style='width:10%' class="tableHeader"> <strong>UOM</strong></td>
             
            <td style='width:10%' class="tableHeader">
            <strong>TOTAL </strong>
                
            </td>
        </tr>


        <?php
				$result = mysqli_query($connection, "  
                
SELECT CONCAT('SG',b.`uniquebarcode`) AS barcode, b.`productname`,a.`uom`,a.`qty` FROM `purchaseorderitems` AS a JOIN productmaster AS b ON 
a.`productcode`=b.`productid`  WHERE
a.`purchaseorderuniqueid` IN (SELECT purchaseorderuniqueid FROM purchaseordermaster WHERE id='$POID') "); 
					 
					$Sno = 1; 
				while($row = mysqli_fetch_row($result))
					{
						
				?>

        <tr>
            <td class="tableItem"><?php echo $Sno; ?></td>
            <td class="tableItem"><?php echo $row[0]; ?></td>
            <td colspan="7" class="tableItem" ><?php echo $row[1]; ?></td>
            <td  class="tableItem" ><?php echo $row[2]; ?></td>
            <td class="tableItem" style='text-align:right;'><?php echo $row[3]; ?></td>
        </tr>
        <?php $Sno=$Sno+1;  } ?>
        
        <tr>
        <td class=""></td>
            <td class=""></td>
            <td colspan="7" class=""></td>
            <td   class="tableItem"  
            style='font-size:11.0pt;font-family:"Calibri",sans-serif; text-align:left;line-height:normal; border-bottom:  double gray 2.25pt;' >
            <strong>Total</strong></td>
            <td class="tableOrderTotal" style='text-align:right;'><strong><?php echo $OrderTotal; ?></strong></td>      
        </tr>
</table>



<div style='  margin-left: 20px;'>
<table  >
        <tr>
            <td colspan="6" style="width:60.22%;border:solid #A6A6A6 1.0pt;background:#BFBFBF;padding:0in 5.4pt 0in 5.4pt;height:.25in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:normal;'>
                    <strong><span style='font-size:13px;font-family:"Calibri Light",sans-serif;color:black;'>Comments or
                                Special Instructions</span></strong></p>
            </td>
            <tr>
            </tr>   
            <td style="border:solid #A6A6A6 1.0pt;padding:0in 0in 0in 0in;">
                <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;
                font-family:"Calibri",sans-serif;'>
                    &nbsp;</p>
            </td>
        </tr> 
        </table>
</div>


    

    <style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color:  #4472C4;
  color: white;
  text-align: center;
}
</style>

<div class="footer">
 
<p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;'>
    If you have any questions about this purchase order, please contact</p>
<p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;'>
    +91 6385161116</p>
</div>


    </body>
    </html>