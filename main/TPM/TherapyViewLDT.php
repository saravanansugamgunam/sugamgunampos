<form action="" method="post">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>



    <?php
// Start the buffering //
ob_start();
   
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
					
    // $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]); 
$Invoice=$_GET['invoice'];
 

	  $res = $connection->query(" 
	  
SELECT 
DATE_FORMAT(bookingdate,'%d-%m-%Y') AS InvoiceDate , bookingid AS Invoice, `paitentname`,
SUM(fees) AS Total,b.mobileno,
(SELECT IFNULL(SUM(discount),0) AS Discount FROM therapybookingdetails WHERE bookinguniqueid='$Invoice')
AS discount,IFNULL(address,'-') AS address1,gender, 
DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dob)), '%Y')+0 AS Age,c.Payment,c.Balance,
(SELECT DATE_FORMAT(collectiontime,'%d-%m-%Y %h:%i %p') FROM therapybookingdetails WHERE bookinguniqueid='$Invoice' and modeofcollection<>'-' limit 1) as CollectionTime,
(SELECT modeofcollection FROM therapybookingdetails WHERE bookinguniqueid='$Invoice' and modeofcollection<>'-'  limit 1) as Modeofcollection


FROM therapybookingmaster AS a JOIN paitentmaster AS b ON a.paitentid = b.`paitentid`  join 
(SELECT invoicegrn,SUM(debitamount) as TotalFee,SUM(creditamount) as Payment,
SUM(debitamount)-SUM(creditamount) as Balance 
FROM transactionledger WHERE invoicegrn ='$Invoice')  as c on a.bookinguniqueid=c.invoicegrn
WHERE bookinguniqueid ='$Invoice'
ORDER BY 1 DESC  "); 
	   
while($data = mysqli_fetch_row($res))
{

$InvoiceDate=$data[0];
$InvoiceNo=$data[1];
$PaitientName=ucwords(strtolower($data[2])) ; 
$TotalAmount=$data[3];  
$MobileNo=$data[4]; 
$DiscountBill=$data[5]; 
$Address1=strtoupper($data[6]); 
$Gender=($data[7]); 
$Age=($data[8]);  
$Paid=($data[9]);  
$Balance=($data[10]);   

$CollectionTime=($data[11]);   
$ModeofCollection=($data[12]);   

}
 
   ?>
    <div class="content" id="content">
        <input type='hidden' id='txtDate' name='txtDate' value='<?php echo $InvoiceDate; ?>' />
        <input type='hidden' id='txtTotalAmount' name='txtTotalAmount' value='<?php echo $TotalAmount; ?>' />
        <input type='hidden' id='txtTotalBalance' name='txtTotalBalance' value='<?php echo $Balance; ?>' />
        <input type='hidden' id='txtMobileNo' name='txtMobileNo' value='<?php echo $MobileNo; ?>' />
        <input type='hidden' id='txtPaitentname' name='txtPaitentname' value='<?php echo $PaitientName; ?>' />


        <script>
        function SendSMSBilling() {
            var SaleDate = document.getElementById("txtDate").value
            var TotalSaleAmount = document.getElementById("txtTotalAmount").value;
            var BalanceAmount = document.getElementById("txtTotalBalance").value;
            var MobileNo = document.getElementById("txtMobileNo").value;
            var PaitentName = document.getElementById("txtPaitentname").value;

            var datas = "&SaleDate=" + SaleDate +
                "&TotalSaleAmount=" + TotalSaleAmount +
                "&BalanceAmount=" + BalanceAmount +
                "&MobileNo=" + MobileNo +
                "&PaitentName=" + PaitentName;
            // alert(datas);
            $.ajax({
                url: "sendsms.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    //  swal(data);
                }
            });
        }



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
            var content_vlue = document.getElementById("DivInvoice").innerHTML;

            var docprint = window.open("", "", disp_setting);
            docprint.document.open();
            docprint.document.write(
                '</head><body onLoad="self.print()" >');
            docprint.document.write(content_vlue);
            docprint.document.close();
            docprint.focus();
        }




        function SendSMS() {

            var MobileNo = document.getElementById("txtMobileNo").value;
            // var MobileNo = 9884589943; 
            var TotalValue = document.getElementById("txtTotalInvoiceValue").value;
            var M1 = "Get well soon!. Your bill value is ";
            var M2 = ", Thanks for trust in SugamGunam, Chetpet";
            var Message = M1.concat('Rs.', TotalValue, M2);
            // alert(Message);
            var datas = "&MobileNo=" + MobileNo + "&Message=" + Message;
            // alert(datas); 
            $.ajax({
                url: "sendsms.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);

                }
            });
        }
        </script>
        <div id='DivInvoice'>

            <div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
                <div style="width: 100%; ">

                    <center> <img src="../assets/img/newlogo.png" class="media-object" width="200" alt="" />
                        <hr>
                        <h4>
                            <b>
                                Therpay Package Form
                            </b>
                        </h4>
                    </center>

                    <style>
                    .container {
                        position: absolute;
                        top: 0;
                        right: 0;
                        bottom: 0;
                        left: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    .parent1 {
                        width: 100%;
                        position: relative;
                        border: 1px solid grey;
                        padding: 15px;
                        align-content: center;
                        margin: auto;
                        font-weight: bold;
                    }

                    .parent2 {
                        width: 100%;
                        position: relative;
                        border: 1px solid grey;
                        padding: 15px 15px 55px;
                        align-content: center;
                        margin: auto;
                        font-weight: bold;
                    }

                    .parent3 {
                        width: 50%;
                        position: relative;
                        border: 1px solid grey;
                        padding: 15px 15px 55px;
                        align-content: center;
                        margin: auto;
                        font-weight: bold;
                        float:right;
                    }
                    .parent4 {
                        width: 50%;
                        position: relative;
                        border: 1px solid grey;
                        padding: 15px 15px 55px;
                        align-content: center;
                        margin: auto;
                        float:right;
                        font-weight: bold;
                    }

                    </style>


                    <div class="parent1">

                        <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:30%; border: 1px solid #ffffff  !important; "><b>Name:
                                        <?php  echo $PaitientName; ?></td>
                                <td style="width:30%; border: 1px solid #ffffff  !important;"><b>Age:
                                        <?php  echo $Age; ?></td>
                                <td style="width:30%; border: 1px solid #ffffff  !important;"><b>Gender:
                                        <?php  echo $Gender; ?> </td>
                            </tr>
                        </table>

                    </div>
                    <br>


                    <div class="parent1">
                        <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:25%; border: 1px solid #ffffff  !important; "><b>Mobile:
                                        <?php  echo $MobileNo; ?></td>
                                <td style="width:25%; border: 1px solid #ffffff  !important;"><b>Pulse: </td>
                                <td style="width:25%; border: 1px solid #ffffff  !important;"><b>BP: </td>
                                 <td style="width:25%; border: 1px solid #ffffff  !important;"><b>Weight: </td>
                            </tr>
                        </table>

                    </div>

                    <br>
                    <div class="parent2">

                        <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:30%; border: 1px solid #ffffff  !important; "><b>Recomended Therapy:
                                </td>

                            </tr>
                        </table>

                    </div>
                    <br>
  



                    <div class="parent1">
                        <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:50%; border: 1px solid #ffffff  !important; "><b>Collection Date / Time:
                                        <?php  echo $CollectionTime; ?></td>
                                <td style="width:50%; border: 1px solid #ffffff  !important;"><b> Mode of Collection:
                                        <?php  echo $ModeofCollection; ?> </td> 
                            </tr>
                        </table>

                    </div>


                    <br>
                    <p style="width: 800px; float: left;">

                        <b>Terms and Conditions</b>
                        <br> 
                        1. Full Payment in Advance.
                        <br>
                        2. Confirm your appointment before one day
                        <br>
                        3. Appountment Cancellation allowed one day before, otherwise NO Reschedule of NO
                        refund allowed
                        <br>
                        4. Clearly understood that the medicines received are prepared only for me and
                        it's natural and can't be shared and to be used as prescribed in the
                        stipulated time.
                        <br>
                        5. I requests and authorizations, and anything pertinent to my care. I permit
                        a copy of this authiorization to be used in place of the original, By
                        signing this form to provide care and services. In the course of my therapy care.
                        I agree to with care / Service to I have consented.

                        <br><br><br>

                        <br>
                    </p>
                    <br><br><br><br>

                    <br><br><br><br>
                    <br><br><br><br> 





                    <div class="parent4">
                        <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:50%; border: 1px solid #ffffff  !important;"><b>
                                    Paitent Signature </td>
                            </tr>
                        </table>

                    </div>

                    <div class="parent3">
                        <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:50%; border: 1px solid #ffffff  !important; "><b> Therapist Signature
                                         </td>
                              
                            </tr>
                        </table>

                    </div>
                    
                    <br>
                    <br>
                    <br>
                    <br>  <br> 
                    <br>
                    <table style="width:100%; border: 1px solid #ffffff  !important; font-size: 15px;	 ">
                            <tr>
                                <td style="width:33%; border: 1px solid #ffffff  !important; "><b>
                                    Place: Chennai</td>

                                    <td style="width:33%; border: 1px solid #ffffff  !important; "><b>
                                    Date: <?php echo date("d/m/Y"); ?> </td>

                                   <td style="width:33%; border: 1px solid #ffffff  !important; "><b>
                                    Time: <?php echo date("h:i:s A"); ?></td>


 
                            </tr>
                        </table>


                    
                    <style>
                    .footer {
                        bottom: 0
                    }
                    </style>

                </div>

                <div class="clearfix"></div>
            </div>
            <div style="width: 100%; ">




            </div>
        </div>
    </div>
    </div>
    <center>
        <tr>
            <?php
 

// Get the content that is in the buffer and put it in your file //
file_put_contents('Bill.html', ob_get_contents());
?>


            <center>
                <span class="pull-center hidden-print">
                    <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' value='<?php echo $Invoice; ?>' />
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                            class="fa fa-print m-r-5"></i> Print</a>

                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10" onclick="redirecttoReceiptPrint();"><i
                            class="fa fa-download m-r-5"></i>
                        Receipt Print</a>
                </span>
            </center>
    </center>
    <script>
    function redirecttoReceiptPrint() {

        var Invoice = document.getElementById("txtInvoiceNo").value;
        var str1 = "ReceiptPrint.php?invoice=";
        var str2 = Invoice;
        var str3 = "";
        var BillPrintURL = str1.concat(str2, str3);
        // alert(BillPrintURL);
        // window.location.href = BillPrintURL;
        window.open(BillPrintURL);
    }
    </script>

    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Email To</h4>
                </div>
                <div class="modal-body">
                    <label>
                        Email ID*
                    </label>
                    <input class="form-control" style='width: 350px;' type="text" name="txtEmail" id="txtEmail" />

                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                    <a href="javascript:;" type='submit' onclick='SeneEmail();' class='btn btn-sm btn-success'>Send</a>
                </div>
            </div>
        </div>
    </div>



</form>
<script>
function SeneEmail() {

    var EmaiID = document.getElementById("txtEmail").value;
    if (EmaiID == "") {
        alert("Kindly provide Email ID");
    } else {

        var datas = "&EmaiID=" + EmaiID;
        // alert(datas);
        $.ajax({
            url: "sendemail.php",
            method: "POST",
            data: datas,
            success: function(data) {
                alert(data);

            }
        });
    }

}
</script>