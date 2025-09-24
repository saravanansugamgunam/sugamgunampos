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
$STOID=$_GET['stoid'];
 

	  $res = $connection->query(" 
SELECT DATE_FORMAT(stodate ,'%d-%m-%Y') AS STODate ,  CONCAT('ST',stono,'-',stoid) AS STONo  ,b.locationname,nettamount,stoqty FROM stomaster AS a
JOIN locationmaster AS b ON a.tolocation = b.locationcode WHERE stouniqueno ='$STOID';"); 
	   
while($data = mysqli_fetch_row($res))
{

$InvoiceDate=$data[0];
$InvoiceNo=$data[1];
$ToLocation=$data[2]; 
$TotalAmount=$data[3]; 
$TotalQty=$data[4]; 
}


	
   ?>
 <div class="content" id="content">
     <script>
     function printDiv() {
         var divToPrint = document.getElementById('DivInvoice');
         newWin = window.open("");
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
         newWin.close();



     }

     function Clickheretoprint() {
         var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
         disp_setting += "scrollbars=yes,width=800, height=400, left=100, top=25";
         var content_vlue = document.getElementById("content").innerHTML;

         var docprint = window.open("", "", disp_setting);
         docprint.document.open();
         docprint.document.write(
             '</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');
         docprint.document.write(content_vlue);
         docprint.document.close();
         docprint.focus();
     }
     </script>
     </script>
     <div id='DivInvoice'>
         <div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
             <div style="width: 100%; height: 190px;">
                 <div style="width: 900px; float: left;">
                     <center>

                         <?php 
	 if ($LocationCode=='1')
	 {
		 ?>
                         <img src="../assets/img/L1_Bill_Invoice.png" class="media-object" width="200" alt="" />

                         <br>
                         <font size="2"> No.18, Mc.Nichols Road, Chetpet, Chennai – 31 <br>
                             Phone: +91 9176606308 &nbsp;&nbsp;&nbsp;&nbsp; Email: sugamgunamhealthcenter@gmail.com <br>
                             www.sugamgunam.com <br>
                             <font>
                                 <?php
	 }
	 else if ($LocationCode=='2')
	 {
		 ?>
                                 <img src="../assets/img/L1_Bill_Invoice.png" class="media-object" width="200" alt="" />

                                 <br>
                                 <font size="2"> No.18, Chetpet, Chennai – 31 <br>
                                     Phone: +91 9176606308 &nbsp;&nbsp;&nbsp;&nbsp; Email:
                                     sugamgunamhealthcenter@gmail.com <br>
                                     www.sugamgunam.com <br>
                                     <font>
                                         <?php
	 }
	 ?>


                     </center>

                 </div>
                 <div style="font:bold 19px 'Aleo';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock Transer Out</div>
                 <br>
                 <div style="width: 136px; float: left; height: 70px;">


                     <table cellpadding="3" cellspacing="0"
                         style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

                         <tr>
                             <td style="white-space:nowrap;">STO No. :</td>
                             <td style="white-space:nowrap;"><?php echo $InvoiceNo; ?></td>
                         </tr>
                         <tr>
                             <td style="white-space:nowrap;">STO Date :</td>

                             <td style="white-space:nowrap;"><?php  echo $InvoiceDate; ?></td>
                         </tr>
                         <tr>
                             <td style="white-space:nowrap;">To Location :</td>

                             <td style="white-space:nowrap;"><?php  echo $ToLocation; ?></td>
                         </tr>
                     </table>

                 </div>
                 <div class="clearfix"></div>
             </div>
             <div style="width: 40%; margin-top:-70px;">
                 <table border="1" cellpadding="4" cellspacing="0"
                     style="font-family: arial; font-size: 11px;	text-align:left;" width="100%">
                     <thead>
                         <tr>

                             <th>S. No</th>
                             <th> Barcode </th>
                             <th> Shortcode </th>
                             <th> MRP </th>
                             <th> Qty </th>
                         </tr>
                     </thead>
                     <tbody>

                         <?php
				$result = mysqli_query($connection, "  SELECT barcode,shortcode,mrp,sum(stoqty)
				 FROM  newstoitems WHERE stouniqueno  ='$STOID' group by barcode,shortcode,mrp,stoqty "); 
					 
					$Sno = 1; 
				while($row = mysqli_fetch_row($result))
					{
						
				?>
                         <tr class="record">
                             <td><?php echo $Sno; ?></td>
                             <td><?php echo $row[0]; ?></td>
                             <td><?php echo $row[1]; ?></td>

                             <td style=" text-align:right;"><?php echo $row[2]; ?></td>
                             <td style=" text-align:right;"><?php echo $row[3]; ?></td>


                         </tr>
                         <?php
				$Sno=$Sno+1;
					}
				?>

                         <tr>
                             <td colspan="4" style=" text-align:right;"><strong style="font-size: 12px;">Total:
                                     &nbsp;</strong></td>
                             <td colspan="1" style=" text-align:right;"><strong style="font-size: 12px;">
                                     <?php
					 
					{
					echo formatMoney($TotalQty, true);
					}
					?>
                                 </strong></td>
                         </tr>



                     </tbody>
                 </table>




             </div>
         </div>
     </div>
 </div>
 <center> <button type="button" onclick="printDiv();" class="btn btn-sm btn-info"><i class="icon-print"></i>
         Print</button>
 </center>