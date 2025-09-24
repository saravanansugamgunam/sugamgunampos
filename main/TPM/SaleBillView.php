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

    // $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]); 
    $Invoice = $_GET['invoice'];



    $res = $connection->query("  
   
    
 SELECT 
   
 (SELECT  paitentname FROM consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE consultationuniquebill ='$Invoice') AS PaitentName,
 (SELECT  mobileno FROM consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE consultationuniquebill ='$Invoice') AS MobileNo,
 
 (SELECT billid FROM consultingbillmaster WHERE consultationuniquebill ='$Invoice' ) AS BillNo,
 (SELECT DATE_FORMAT(billdate,'%d-%m-%Y') FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS BillDate,
 
 (SELECT round(SUM(grossamount),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Total,
 (SELECT round(SUM(discountamount),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Discount,
 (SELECT round(SUM(grossamount-discountamount),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS NettAmount, 
 (SELECT round(SUM(oldbalance),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS PreviousBalance, 
 

  (SELECT tokennumber FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Token ,
  (SELECT username FROM  usermaster WHERE userid IN(
  SELECT doctorid FROM therapybookingdetails WHERE bookinguniqueid IN('$Invoice')) LIMIT 1 ) AS DoctorName,
  (SELECT  COUNT(*) FROM  consultingdetails   WHERE consultationuniquebill  ='$Invoice') AS TotalItem,
  (SELECT locationcode FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS BillLocationCode,

  
  (SELECT DATE_FORMAT(therapydate,'%d-%m-%Y') FROM therapybookingmaster WHERE bookinguniqueid  ='$Invoice' ) AS TherapyDate,
  
  (SELECT IF(therapytime='00:00:00',DATE_FORMAT(addedon,'%H:%m:%p'),therapytime) AS 
  therapytm FROM therapybookingmaster WHERE bookinguniqueid ='$Invoice') AS TherapyTime,

  (SELECT  DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dob)), '%Y')+0 AS Age FROM 
  consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE 
  consultationuniquebill ='$Invoice') AS Age,
  (SELECT einvoiceno FROM therapybookingmaster WHERE bookinguniqueid  ='$Invoice' ) AS EinvoiceNo,
  (SELECT  gender FROM consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE consultationuniquebill ='$Invoice') AS Gender,
  (SELECT  CONCAT('SG',b.`paitentid`)  FROM consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE consultationuniquebill ='$Invoice') AS PatientID

  ");
  
  
  while ($data = mysqli_fetch_row($res)) {

  $InvoiceDate = $data[3];
  $InvoiceNo = $data[2];
  $PaitientName =  ucwords(strtolower($data[0]));
  $TotalAmount = $data[3];
  $MobileNo = $data[1];
  $DiscountBill = '';//$data[5];
  $Address1 = '';//strtoupper($data[6]);
  $Gender =  $data[16];// ($data[7]);
  $Age = $data[14];
  $eInvoiceNo = $data[15];
  $Paid = '';//($data[9]);
  $Balance = '';//($data[10]);
  $UsedAmount = '';//$data[11];
  $Available = '';//$data[9] - $data[11];
  $PatientID =  $data[17];//$data[9] - $data[11];
  }

        //   while ($data = mysqli_fetch_row($res)) {

        //       $PaitentName = $data[0];
        //       $MobileNo = $data[1];
        //       $BillNo = $data[2];
        //       $BillDate = $data[3];
        //       $Total = $data[4];
        //       $Discount = $data[5];
        //       $NettAmount = $data[6];
        //       $PreviousBalance = $data[7];
        //       $Paid = $data[8];
        //       $CurrentBalance = $data[9];
        //       $Token = $data[10];
        //       $DoctorName = $data[11];
        //       $TotalItem = $data[12];
        //       $BillLocationCode = $data[13];
        //       $TherapyDate = $data[14];
        //       $TherapyTime = $data[15];
        //   }



//     $res = $connection->query(" 
	  
// SELECT 
// DATE_FORMAT(bookingdate,'%d-%m-%Y') AS InvoiceDate , bookingid AS Invoice, `paitentname`,
// SUM(fees) AS Total,b.mobileno,
// (SELECT IFNULL(SUM(discount),0) AS Discount FROM therapybookingdetails WHERE bookinguniqueid='$Invoice')
// AS discount,IFNULL(address,'-') AS address1,gender, 
// DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dob)), '%Y')+0 AS Age,c.Payment,c.Balance,
// (SELECT SUM(nettamount) FROM therapybookingdetails WHERE bookinguniqueid ='$Invoice' AND newstatus='Closed') AS used

// FROM therapybookingmaster AS a JOIN paitentmaster AS b ON a.paitentid = b.`paitentid`  join 
// (SELECT invoicegrn,SUM(debitamount) as TotalFee,SUM(creditamount) as Payment,
// SUM(debitamount)-SUM(creditamount) as Balance
// FROM transactionledger WHERE invoicegrn ='$Invoice')  as c on a.bookinguniqueid=c.invoicegrn
// WHERE bookinguniqueid ='$Invoice'
// ORDER BY 1 DESC  ");

//     while ($data = mysqli_fetch_row($res)) {

//         $InvoiceDate = $data[0];
//         $InvoiceNo = $data[1];
//         $PaitientName = ucwords(strtolower($data[2]));
//         $TotalAmount = $data[3];
//         $MobileNo = $data[4];
//         $DiscountBill = $data[5];
//         $Address1 = strtoupper($data[6]);
//         $Gender = ($data[7]);
//         $Age = ($data[8]);
//         $Paid = ($data[9]);
//         $Balance = ($data[10]);
//         $UsedAmount = $data[11];
//         $Available = $data[9] - $data[11];
    // }

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

                    <center> <img src="../assets/img/letterheadlogo.png" class="media-object" width="200" alt="" />
                  
                    	 
 <div style="font:bold 14px 'calibri';">AP 393,17th Street, Thiruvalluvar Kudiyirippu, I Block,</div>
<div style="font:bold 14px 'calibri';">Anna Nagar, Chennai, Tamil Nadu, India – 600040</div>

<div style="font:bold 14px 'calibri';">Ph: 9176606308</div>
<div style="font:bold 14px 'calibri';">www.sugamgunam.com</div>
  </center>  
                    <hr>


                    <div style='float:right;font-family: Arial'>
                        Ref. No: <?php echo $InvoiceNo; ?>
                        <br>
                        Date: <?php echo $InvoiceDate; ?>
                    </div>


                    <div style='float:left;'>
                        Name : <?php echo $PaitientName;  ?>
                         <br>
                        Patient ID : <?php echo $PatientID; ?>
                        <br>
                        Mobile No : <?php echo $MobileNo; ?>

                        <br>
                        Age : <?php echo $Age; ?>
                        <br>
                        Gender : <?php echo $Gender; ?>
                        <br>
                        <br>
                        <b>Therapy Details</b>
                        <br>
                        <style>
                        th,
                        thead,
                        td {
                            border: 1px solid #dddddd;
                        }
                        </style>
                        <table class='table' cellpadding="4" cellspacing="4"
                            style="font-family: arial; font-size: 12px;	text-align:left; " width="100%">
                            <thead>
                                <tr>

                                    <th>S. No</th>
                                    <th> Therapy </th>
                                    <th> Sitting </th>
                                    <th> Therapy Dt </th>
                                    <th> Therapy Time </th>
                                    <th> Therapist </th>

                                    <?php if ($DiscountBill > 0) {
                                        echo " 
                                        <th> Rate </th>
                                        <th> Disc </th>
                                        <th> Amount </th> 
                                        <th> Status </th> 
                                        <th> Consumed </th>";
                                    } else {
                                        echo "   
                                        <th> Amount </th> 
                                        <th> Status </th> 
                                        <th> Consumed </th>";

                                    } ?>


                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $result = mysqli_query($connection, " 
				SELECT b.consultationname,a.totalsitings,date_format(reviseddate,'%d-%m-%Y'),IFNULL(d.timeslot,revisedtime) AS timeslot,
				c.`username`, a.rate,a.discount,a.nettamount ,a.bookingstatus, 
                IF(a.bookingstatus ='Closed',a.nettamount,0) AS Balance
			   FROM therapybookingdetails AS a 
			   JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
			   JOIN usermaster AS c ON a.doctorid=c.userid 
			   LEFT JOIN 
			   (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a 
			   LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid ='$Invoice'
			   GROUP BY bookingitemid) AS d
			   ON  a.bookingid =d.bookingitemid
			   WHERE bookinguniqueid ='$Invoice'  and bookingstatus in('Booked','Closed')
			   GROUP BY a.bookingid,a.therapyid,b.consultationname,reviseddate,c.`username`, a.rate,a.discount,a.nettamount ,
			   IFNULL(d.timeslot,revisedtime),a.bookingstatus 
			   ORDER BY reviseddate,therapyid,sitingid,a.bookingid  ; ");


                                $Sno = 1;
                                while ($row = mysqli_fetch_row($result)) {

                                ?>
                                <tr class="record">

                                    <td><?php echo $Sno; ?></td>
                                    <td><?php echo $row[0]; ?></td>
                                    <td align=right><?php echo $row[1]; ?></td>
                                    <td align=right><?php echo $row[2]; ?></td>
                                    <td><?php echo $row[3]; ?></td>
                                    <td><?php echo $row[4]; ?></td>

                                    <?php if ($DiscountBill > 0) {
                                            echo "
                                        <td align=right> $row[5]</td>
                                        <td align=right> $row[6] </td>
                                        <td align=right> $row[7] </td> 
                                        <td align=right> $row[8] </td> 
                                        <td align=right> $row[9] </td>";

                                        } else {
                                            echo " 
                                        <td align=right> $row[7] </td> 
                                        <td align=right> $row[8] </td> 
                                        <td align=right> $row[9] </td>";
                                        } ?>


                                </tr>

                                <?php
                                    $Sno = $Sno + 1;
                                }
                                if ($DiscountBill > 0) {
                                    echo "<tr>

				  
                    <td colspan='6' style='border: 1px solid white;;border-right: 1px solid #dddddd;' > </td> 
                    <td colspan='1'>Total</td>
                    <td align=right>$DiscountBill</td>
                    <td align=right><b>$TotalAmount</td>  
                    <tr> 
                    <tr>
                    <td colspan='6'   style='border: 1px solid white;border-right: 1px solid #dddddd;' > </td> 
                    <td colspan='2'>Paid</td>  
                    <td align=right><b>$Paid</td>  
                    <tr> 
                    <tr>
                    <tr>
                    <td colspan='6'  style='border: 1px solid white;;border-right: 1px solid #dddddd;'> </td> 
                    <td colspan='2'>Balance</td>  
                    <td align=right><b>$Balance</td>  
                    <tr> 	 ";
                                } else {
                                    echo "<tr hidden>

				  
				<td colspan='5' style='border: 1px solid white;;border-right: 1px solid #dddddd;' > </td> 
				<td  >Total</td> 
				<td align=right><b> </td>  
                <td  >Used</td> 
				<td align=right><b>$UsedAmount</td>  

				<tr> 
				<tr hidden>
				<td colspan='5'   style='border: 1px solid white;border-right: 1px solid #dddddd;' > </td> 
				<td colspan='1'>Paid</td>  
				<td align=right><b>$Paid</td> 
                <td  >Available</td> 
				<td align=right><b>$Available</td>  
 
				<tr> 
				<tr>
				<tr hidden>
				<td colspan='5'  style='border: 1px solid white;;border-right: 1px solid #dddddd;'> </td> 
				<td colspan='1'>Balance</td>  
				<td align=right><b>$Balance</td>  
				<tr> 	 ";
                                }

                                ?>
                            </tbody>
                        </table>


                        <label>Payment Details</label>
                        <table style="font-family: arial; font-size: 12px;	 padding: 8px; " width="30%">
                            <thead style="font-family: arial; font-size: 12px;	 padding: 8px; ">
                                <tr style="font-family: arial; font-size: 12px;	 padding: 8px; ">

                                    <th style="font-family: arial; font-size: 12px; padding: 2px;">S. No</th>
                                    <th style="font-family: arial; font-size: 12px; padding: 2px;"> Mode </th>
                                    <th style="font-family: arial; font-size: 12px; padding: 2px;"> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($connection, " 
				SELECT concat(DATE_FORMAT(DATE,'%d-%m-%Y'),' - ',b.paymentmode),a.amount FROM salepaymentdetails AS a JOIN 
				paymentmodemaster AS b ON a.paymentmode=b.paymentmodecode 
				WHERE invoiceno='$Invoice'  ; ");


                                $Sno = 1;
                                while ($row = mysqli_fetch_row($result)) {

                                ?>
                                <tr style="font-family: arial; font-size: 12px; padding: 2px;">
                                    <td style="font-family: arial; font-size: 12px; padding: 2px; "><?php echo $Sno; ?>
                                    </td>
                                    <td style="font-family: arial; font-size: 12px; padding: 2px; ">
                                        <?php echo $row[0]; ?></td>
                                    <td style="font-family: arial; font-size: 12px; padding: 2px; " align=right>
                                        <?php echo $row[1]; ?></td>

                                </tr>

                                <?php
                                    $Sno = $Sno + 1;
                                }
                                echo "<tr> </tbody>
					</table>"; ?>

                                <br>
                                <p style="width: 800px; float: left;">

                                    <b>Terms and Conditions</b>
                                    <br>

                                    Dear, <?php echo $PaitientName; ?>,
                                    Request you to ,please arrive 20 minutes before prescribed time, so that it will
                                    not affect other patient therapy time

                                    <br>
                                    1. Confirm your appointment before one day
                                    <br>
                                    2. Appointment Cancellation allowed one day before

                                    <br>
                                    3. NO Refund allowed
                                    <br>
                                </p>
                                <br><br><br><br>

                                <a href='https://www.sugamgunam.com/Therapyinstruction.pdf' target='_blank'>
                                    <b>Therapy Instructions</b>
                                </a>

                                <br>
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

                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10" onclick="SendEInvoice();"><i
                            class="fa fa-download m-r-5"></i>
                        Send Whatsapp</a>



                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10" onclick="redirecttoLDTPrint();"><i
                            class="fa fa-download m-r-5"></i>
                        Print Liver Detox Form</a>

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

    function redirecttoLDTPrint() {

        var Invoice = document.getElementById("txtInvoiceNo").value;
        var str1 = "TherapyViewLDT.php?invoice=";
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
function SendEInvoice() {

 

    var MobileNo =     "<?php echo $MobileNo; ?>";

    var PaitentName = "<?php echo $PaitientName; ?>";
    var eInvoiceNo = "<?php echo $eInvoiceNo; ?>";

 

    if (eInvoiceNo == "-") {
        alert("Can't send this invoice, try newer invoices");
    } else {
        var datas = "&MobileNo=" + MobileNo +
            "&PaitentName=" + PaitentName +
            "&eInvoiceNo=" + eInvoiceNo;
            // alert(datas)

        $.ajax({
            url: "sendeinvoice.php",
            method: "POST",
            data: datas,
            success: function(data) {
            //   alert(data);

                // document.getElementById("txtUrl").value = data;

            }
        });
    }
}



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