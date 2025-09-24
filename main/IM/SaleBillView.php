<?php
// ---------------------------------------------------------------
// Invoice Print with Subtotal & Discount Breakdown
// ---------------------------------------------------------------
?>
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

$position     = $_SESSION["SESS_LAST_NAME"] ?? '';
$LocationCode = $_SESSION['SESS_LOCATION']   ?? '';

function formatMoney($number, $fractional = false) {
    if ($fractional) {
        $number = sprintf('%.2f', (float)$number);
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

// Invoice unique id (saleuniqueno) from GET
$Invoice = isset($_GET['invoice']) ? mysqli_real_escape_string($connection, $_GET['invoice']) : '';

$InvoiceDate = $InvoiceNo = $PaitientName = $MobileNo = $Address1 = $Address2 = $City = $State = $Remarks = '';
$TotalAmount = $DiscountBill = $CourierCharge = $FinalTotal = 0.00;
$Pincode = $BillType = $DeliveryStatus = $TransactionType = $CancelledStatus = $eInvoice = '-';
$Balance = 0;

// --------------------------- Header / Master fetch ---------------------------
$qMaster = "
SELECT DATE_FORMAT(saledate,'%d-%m-%Y') AS InvoiceDate ,
       CONCAT(invoiceno,'-',saleid)      AS Invoice,
       paitentname,
       SUM(nettamount)                   AS Total,
       b.mobileno,
       a.discountamount,
       IFNULL(address1,'-')              AS address1,
       address2,
       c.city,
       state,
       c.pincode,
       c.couriercharge,
       billtype,
       newbalance,
       remarks,
       deliverystatus,
       a.transactiontype,
       a.cancellstatus,
       a.einvoiceno
FROM salemaster AS a
JOIN paitentmaster AS b ON a.paitientcode = b.paitentid
LEFT JOIN courierdetails AS c ON a.saleuniqueno=c.invoicenumber
WHERE saleuniqueno ='$Invoice';
";

if ($res = $connection->query($qMaster)) {
    if ($data = mysqli_fetch_row($res)) {
        $InvoiceDate     = $data[0];
        $InvoiceNo       = $data[1];
        $PaitientName    = ucwords(strtolower($data[2]));
        $TotalAmount     = (float)$data[3]; // nett after all discounts (no courier)
        $MobileNo        = $data[4];
        $DiscountBill    = (float)$data[5]; // bill-level discount from salemaster
        $Address1        = strtoupper($data[6]);
        $Address2        = strtoupper($data[7]);
        $City            = strtoupper($data[8]);
        $State           = strtoupper($data[9]);
        $Pincode         = $data[10];
        $CourierCharge   = (float)$data[11];
        $BillType        = $data[12];
        $Balance         = (float)$data[13];
        $Remarks         = $data[14];
        $DeliveryStatus  = $data[15];
        $TransactionType = $data[16];
        $CancelledStatus = $data[17];
        $eInvoice        = $data[18];
    }
    mysqli_free_result($res);
}

// --------------------------- Discount maths & toggles ---------------------------
// Sum of item-level discounts across newsaleitems + saleitems
$ItemDiscountTotal = 0.00;
$qItemDisc = "
    SELECT SUM(discountamount) AS disc
    FROM (
        SELECT discountamount FROM newsaleitems WHERE invoiceno = '$Invoice'
        UNION ALL
        SELECT discountamount FROM saleitems    WHERE invoiceno = '$Invoice'
    ) x
";
if ($rDisc = mysqli_query($connection, $qItemDisc)) {
    if ($row = mysqli_fetch_assoc($rDisc)) {
        $ItemDiscountTotal = (float)($row['disc'] ?? 0);
    }
    mysqli_free_result($rDisc);
}

// Show discount column if either item-wise or bill-wise discount exists
$ShowDiscountCol = ($DiscountBill > 0) || ($ItemDiscountTotal > 0);

// Subtotal BEFORE any discounts (reconstruct original total)
$SubtotalBeforeDiscounts = (float)$TotalAmount + (float)$ItemDiscountTotal + (float)$DiscountBill;

// Final totals
$FinalTotal = (float)$TotalAmount + (float)$CourierCharge;
?>

<div class="content" id="content">
    <input type='hidden' id='txtDate'          name='txtDate'          value='<?php echo htmlspecialchars($InvoiceDate); ?>' />
    <input type='hidden' id='txtTotalAmount'   name='txtTotalAmount'   value='<?php echo htmlspecialchars($TotalAmount); ?>' />
    <input type='hidden' id='txtTotalBalance'  name='txtTotalBalance'  value='<?php echo htmlspecialchars($Balance); ?>' />
    <input type='hidden' id='txtMobileNo'      name='txtMobileNo'      value='<?php echo htmlspecialchars($MobileNo); ?>' />
    <input type='hidden' id='txtPaitentname'   name='txtPaitentname'   value='<?php echo htmlspecialchars($PaitientName); ?>' />

    <script>
    function SendSMSBilling() {
        var SaleDate        = document.getElementById("txtDate").value;
        var TotalSaleAmount = document.getElementById("txtTotalAmount").value;
        var BalanceAmount   = document.getElementById("txtTotalBalance").value;
        var MobileNo        = document.getElementById("txtMobileNo").value;
        var PaitentName     = document.getElementById("txtPaitentname").value;

        var datas = "&SaleDate=" + encodeURIComponent(SaleDate) +
                    "&TotalSaleAmount=" + encodeURIComponent(TotalSaleAmount) +
                    "&BalanceAmount=" + encodeURIComponent(BalanceAmount) +
                    "&MobileNo=" + encodeURIComponent(MobileNo) +
                    "&PaitentName=" + encodeURIComponent(PaitentName);

        $.ajax({
            url: "sendsms.php",
            method: "POST",
            data: datas,
            success: function(data) {
                // optional: show toast
            }
        });
    }

    function printDiv() {
        var divToPrint = document.getElementById('DivInvoice');
        var newWin = window.open("");
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
        docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');
        docprint.document.write(content_vlue);
        docprint.document.close();
        docprint.focus();
    }

    function SendSMS() {
        var MobileNo   = document.getElementById("txtMobileNo").value;
        var TotalValue = document.getElementById("txtTotalInvoiceValue").value;
        var M1 = "Get well soon!. Your bill value is ";
        var M2 = ", Thanks for trust in SugamGunam, Chetpet";
        var Message = M1.concat('Rs.', TotalValue, M2);

        var datas = "&MobileNo=" + encodeURIComponent(MobileNo) + "&Message=" + encodeURIComponent(Message);

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
	<div style="width: 100%; " >
	<div style="width: 900px; float: left;">
	<center><div style="font:bold 25px 'calibri';"> <img src="../assets/img/logo.png" class="media-object"   width="200" alt="" /></div>
	
	
	<center><div style="font:bold 20px 'calibri';"> HERBALS</div>
	
	<center><div style="font:bold 16px 'calibri';"> GSTIN: 33BAZPM0405P1Z8</div>
	<center><div style="font:bold 14px 'calibri';">AP 393,17th Street, Thiruvalluvar Kudiyirippu, I Block,</div>
<center><div style="font:bold 14px 'calibri';">Anna Nagar, Chennai, Tamil Nadu, India – 600040</div>

<center><div style="font:bold 14px 'calibri';">Ph: 9488228603</div>
<center><div style="font:bold 14px 'calibri';">www.sugamgunam.com</div>
<center><div style="font:bold 16px 'calibri';">Invoice</div>
                                <?php
								if ($LocationCode == '1') {
								?>
                                <!--  <img src="../assets/img/L1_Bill_Invoice.png" class="media-object"   width="200" alt="" />-->

                                <br>
                                <!-- 	<font size="2"> No.18, Mc.Nichols Road,    Chetpet, Chennai – 31 <br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font> -->
                                <?php
								} else if ($LocationCode == '2') {
								?>
                                <!-- 	 <img src="../assets/img/L1_Bill_Invoice.png" class="media-object"   width="200" alt="" /> -->

                                <br>
                                <!--  <font size="2"> No.18, Chetpet, Chennai – 31 <br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font>-->
                                <?php
								}
								?>


                            </center>
                </div>

                <style>
                    /* watermark / center overlay if needed */
                    .centered {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                    }
                </style>

                <div style="width: 200px; float: left;">
                    <table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">
                        <tr>
                            <td>Bill No. :</td>
                            <td><?php echo htmlspecialchars($InvoiceNo); ?></td>
                        </tr>
                        <tr>
                            <td>Date :</td>
                            <td><?php echo htmlspecialchars($InvoiceDate); ?></td>
                        </tr>
                        <tr>
                            <td>Paitent :</td>
                            <td><?php echo htmlspecialchars($PaitientName); ?></td>
                        </tr>
                        <tr>
                            <td>Mobile :</td>
                            <td>
                                <?php echo htmlspecialchars($MobileNo); ?>
                                <input type="hidden" id="txtMobileNo" name="txtMobileNo" value="<?php echo htmlspecialchars($MobileNo); ?>" />
                            </td>
                        </tr>
                        <?php
                        if ($Address1 !== "-") {
                            echo "<tr><td valign='top'>Address :</td><td>";
                            echo "<b>".htmlspecialchars($Address1)."</b><br>";
                            if ($Address2 !== "") echo "<b>".htmlspecialchars($Address2)."</b><br>";
                            echo "<b>".htmlspecialchars($City)."</b><br>";
                            echo "<b>".htmlspecialchars($State)." - ".htmlspecialchars($Pincode)."</b><br>";
                            echo "</td></tr>";
                        }
                        ?>
                    </table>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>

            <div style="width: 100%; ">
                <table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px; text-align:left;" width="100%">
                    <thead>
                        <tr>
                            <th>S. No</th>
                            <th> Barcode </th>
                            <th> Shortcode </th>
                            <th> Qty </th>
                            <?php if ($ShowDiscountCol) { echo "<th> Discount </th>"; } ?>
                            <th> Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // --------------------------- Items query (by BillType) ---------------------------
                        if ($BillType == 'Regular') {
                            if ((int)$DeliveryStatus === 1) {
                                $qItems = "
                                    SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno
                                    FROM (
                                        SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno FROM newsaleitems
                                        UNION
                                        SELECT '-',shortcode,saleqty,discountamount, nettamount,invoiceno FROM saleitems
                                    ) AS a
                                    WHERE invoiceno = '$Invoice';
                                ";
                            } else {
                                if ($TransactionType == 'Return') {
                                    $qItems = "
                                        SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno
                                        FROM (
                                            SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno FROM newsaleitems
                                            UNION
                                            SELECT '-',shortcode,saleqty,discountamount, nettamount,invoiceno FROM saleitems
                                        ) AS a
                                        WHERE invoiceno = '$Invoice';
                                    ";
                                } else {
                                    $qItems = "
                                        SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno
                                        FROM (
                                            SELECT 'Not Delivered' as barcode,shortcode,saleqty,discountamount, nettamount,invoiceno FROM newsaleitemsproduct
                                            UNION
                                            SELECT '-',shortcode,saleqty,discountamount, nettamount,invoiceno FROM saleitems
                                        ) AS a
                                        WHERE invoiceno = '$Invoice';
                                    ";
                                }
                            }
                        } else if ($BillType == 'Open') {
                            $qItems = "
                                SELECT '-' as barcode, UPPER(productname) as shortcode, saleqty, discountamount, nettamount, invoiceno
                                FROM newsaleitems
                                WHERE invoiceno = '$Invoice';
                            ";
                        } else {
                            $qItems = "
                                SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno
                                FROM (
                                    SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno FROM newsaleitems
                                    UNION
                                    SELECT '-',shortcode,saleqty,discountamount, nettamount,invoiceno FROM saleitems
                                ) a
                                WHERE invoiceno = '$Invoice';
                            ";
                        }

                        $Sno = 1;
                        if ($result = mysqli_query($connection, $qItems)) {
                            while ($row = mysqli_fetch_row($result)) {
                                ?>
                                <tr class="record">
                                    <td><?php echo $Sno; ?></td>
                                    <td><?php echo htmlspecialchars($row[0]); ?></td>
                                    <td><?php echo htmlspecialchars($row[1]); ?></td>
                                    <td style="text-align:right;"><?php echo htmlspecialchars($row[2]); ?></td>
                                    <?php if ($ShowDiscountCol) { echo "<td style='text-align:right;'>".htmlspecialchars($row[3])."</td>"; } ?>
                                    <td style="text-align:right;"><?php echo htmlspecialchars($row[4]); ?></td>
                                </tr>
                                <?php
                                $Sno++;
                            }
                            mysqli_free_result($result);
                        }
                        ?>

                        <!-- Totals / Summary -->
                        <tr>
                            <td colspan="<?php echo $ShowDiscountCol ? 5 : 4; ?>" style="text-align:right;">
                                <strong style="font-size: 12px;">Subtotal (Before Discounts):&nbsp;</strong>
                            </td>
                            <td colspan="2" style="text-align:right;">
                                <strong style="font-size: 12px;"><?php echo formatMoney($SubtotalBeforeDiscounts, true); ?></strong>
                            </td>
                        </tr>
 
                        <?php if ($DiscountBill > 0) { ?>
                        <tr>
                            <td colspan="<?php echo $ShowDiscountCol ? 5 : 4; ?>" style="text-align:right;">
                                <strong style="font-size: 12px;">Less: Bill Discount:&nbsp;</strong>
                            </td>
                            <td colspan="2" style="text-align:right;">
                                <strong style="font-size: 12px;"><?php echo formatMoney($DiscountBill, true); ?></strong>
                            </td>
                        </tr>
                        <?php } ?>

                       
                        <?php if ($CourierCharge > 0) { ?>
                        <tr>
                            <td colspan="<?php echo $ShowDiscountCol ? 5 : 4; ?>" style="text-align:right;">
                                <strong style="font-size: 12px;">Add: Courier Charges:&nbsp;</strong>
                            </td>
                            <td colspan="2" style="text-align:right;">
                                <strong style="font-size: 12px;"><?php echo formatMoney($CourierCharge, true); ?></strong>
                            </td>
                        </tr>
                        <?php } ?>

                        <tr>
                            <td colspan="<?php echo $ShowDiscountCol ? 5 : 4; ?>" style="text-align:right;">
                                <strong style="font-size: 12px;">Final Amount:&nbsp;</strong>
                            </td>
                            <td colspan="2" style="text-align:right;">
                                <strong style="font-size: 12px;"><?php echo formatMoney($FinalTotal, true); ?></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <br><br>
                <h5>Payment Details</h5>
                <table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px; text-align:left;" width="20%">
                    <thead>
                        <tr>
                            <th>S. No</th>
                            <th> Payment Mode </th>
                            <th> Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qPay = "
                            SELECT b.paymentmode, a.amount
                            FROM salepaymentdetails AS a
                            JOIN paymentmodemaster AS b ON a.paymentmode = b.paymentmodecode
                            WHERE invoiceno = '$Invoice';
                        ";
                        $Sno = 1;
                        if ($result = mysqli_query($connection, $qPay)) {
                            while ($row = mysqli_fetch_row($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $Sno; ?></td>
                                    <td><?php echo htmlspecialchars($row[0]); ?></td>
                                    <td><?php echo formatMoney((float)$row[1], true); ?></td>
                                </tr>
                                <?php
                                $Sno++;
                            }
                            mysqli_free_result($result);
                        }
                        ?>
                    </tbody>
                </table>

                <?php if (!empty($Remarks)) { echo "<div style='margin-top:8px;'>".htmlspecialchars($Remarks)."</div>"; } ?>

                <center>
                    <br>
                    <label> Thank you !!! </label>
                </center>
            </div>
        </div>
    </div>

    <center>
        <?php if ($CancelledStatus =='1') { ?>
            <div class='centered'>
                <img src='../assets/img/cancelled.png' alt='Cancelled' style='width:30%;'>
            </div>
        <?php } else { ?>
            <?php
            // Save the generated HTML to a file if needed
            file_put_contents('Bill.html', ob_get_contents());
            ?>
            <table>
                <tr>
                    <td>
                        <button type="button" onclick="Clickheretoprint();" class="btn btn-sm btn-info">
                            <i class="icon-print"></i> Print
                        </button>
                    </td>
                    <td>
                        <button type="button" onclick="redirecttoReceiptPrint();" class="btn btn-sm btn-info">
                            <i class="icon-print"></i> Receipt Print
                        </button>
                    </td>
                    <td>
                        <button type="button" onclick="SendEInvoice();" class="btn btn-sm btn-primary">
                            <i class="icon-print"></i> Send E-Invoice(Whatsapp)
                        </button>
                    </td>
                    <td>
                        <button type="button" onclick="SendSMSBilling();" class="btn btn-sm btn-primary">
                            <i class="icon-print"></i> SMS
                        </button>
                    </td>
                    <td>
                        <a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal">Email</a>
                    </td>
                </tr>
            </table>
        <?php } ?>

        <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' value='<?php echo htmlspecialchars($Invoice); ?>' />
    </center>

    <script>
    function redirecttoReceiptPrint() {
        var Invoice = document.getElementById("txtInvoiceNo").value;
        var BillPrintURL = "ReceiptPrint.php?invoice=" + encodeURIComponent(Invoice);
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
                    <label>Email ID*</label>
                    <input class="form-control" style='width: 350px;' type="text" name="txtEmail" id="txtEmail" />
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <a href="javascript:;" type='submit' onclick='SeneEmail();' class='btn btn-sm btn-success'>Send</a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /content -->

<script>
function SendEInvoice() {
    var MobileNo    = document.getElementById("txtMobileNo").value;
    var PaitentName = document.getElementById("txtPaitentname").value;
    var eInvoiceNo  = "<?php echo htmlspecialchars($eInvoice); ?>";

    if (eInvoiceNo === "-") {
        alert("Can't send this invoice, try newer invoices");
    } else {
        var datas = "&MobileNo="   + encodeURIComponent(MobileNo) +
                    "&PaitentName=" + encodeURIComponent(PaitentName) +
                    "&eInvoiceNo="  + encodeURIComponent(eInvoiceNo);

        $.ajax({
            url: "sendeinvoice.php",
            method: "POST",
            data: datas,
            success: function(data) {
                alert("Message Sent");
            }
        });
    }
}

function SeneEmail() {
    var EmaiID = document.getElementById("txtEmail").value;
    if (EmaiID === "") {
        alert("Kindly provide Email ID");
    } else {
        var datas = "&EmaiID=" + encodeURIComponent(EmaiID);
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

</form>
