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
SELECT DATE_FORMAT(saledate,'%d-%m-%Y') AS InvoiceDate , CONCAT(invoiceno,'-',saleid) AS Invoice, `paitentname`,
SUM(nettamount) AS Total,b.mobileno,a.discountamount,IFNULL(address1,'-') AS address1,address2,c.city,
state,c.pincode,c.couriercharge,billtype,newbalance,gender, 
DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dob)), '%Y')+0 as Age FROM salemaster AS a
JOIN paitentmaster AS b ON a.paitientcode = b.`paitentid` LEFT JOIN courierdetails  AS c
ON a.saleuniqueno=c.invoicenumber WHERE saleuniqueno ='$Invoice';");

    while ($data = mysqli_fetch_row($res)) {

        $InvoiceDate = $data[0];
        $InvoiceNo = $data[1];
        $PaitientName = ucwords(strtolower($data[2]));
        $TotalAmount = $data[3];
        $MobileNo = $data[4];
        $DiscountBill = $data[5];
        $Address1 = strtoupper($data[6]);
        $Address2 = strtoupper($data[7]);
        $City = strtoupper($data[8]);
        $State = strtoupper($data[9]);
        $Pincode = $data[10];
        $CourierCharge = $data[11];
        $FinalTotal = $TotalAmount + $CourierCharge;
        $BillType = 'Regular';
        $Balance = $data[13];
        $Gender = $data[14];
        $Age = $data[15];
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
                '</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');
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


                    <br>
                    <br>
                    <center> <img src="../assets/img/letterheadlogo.png" class="media-object" width="300" alt="" />






                        <h5>
                            AP 393,17th Street, Thiruvalluvar Kudiyirippu, I Block, Anna Nagar, Chennai,Tamil Nadu,
                            India 600040
                        </h5>
                        <h5>
                            Phone: 9176606308 &nbsp;&nbsp;&nbsp;&nbsp;
                            Email: info@sugamgunam.com
                        </h5>
                    </center>
                   
                    <hr>
<div>
                    <div style='float:left;'>

 
    <div style='float:right;'> 
                         &nbsp;&nbsp;&nbsp;    <b>Dr. Jaganathan</b><br>
                          &nbsp;&nbsp;&nbsp;   BSMS,MD(SIDDHA)         &nbsp;&nbsp;&nbsp;    
    </div>   
    
      <div style='float:right;'> 
                              &nbsp;&nbsp;&nbsp; <b>Dr. Malarvizhi</b><br> 
                        &nbsp;&nbsp;&nbsp;     BSMS,MD(SIDDHA)    
    </div>  
    
     <div style='float:right;'> 
                              <b>Dr. Raja Vinayagam</b><br> 
                           BNYS           &nbsp;&nbsp;&nbsp;     
    </div>   
                &nbsp;&nbsp;&nbsp;
                                 <div style='float:right;'> 
                            <b>Dr. Bharathraj</b><br>
                            BHMS,MD(HOMEO)           &nbsp;&nbsp;&nbsp;     &nbsp;&nbsp;&nbsp;  
    </div>   
                &nbsp;&nbsp;&nbsp;                
                
                        <div style='float:right;'> 
                             <b>Dr. Sheba</b><br> 
                           BSMS,B.Pharm, M.Sc(Y&N)                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<br>               
    </div>   
                   
       
                            
                        

                    </div>


</div>
     
 
                    <br> <br>
                     <hr style=' position: relative;
        top: 20px;
        border: none;
        height: 6px;
        background: #f58220;
        margin-bottom: 50px;'>
                  
                    <div style='float:left;'>
                        Name :<b> <?php echo $PaitientName; ?></b> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Age : <b><?php echo $Age; ?></b>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Gender : <b><?php echo $Gender; ?></b>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        Date : <b><?php echo $InvoiceDate; ?></b>

                        <br>
                        <br> <br>
                       
                        <center><b>TO WHOMSOEVER IT MAY CONCERN</b></center>
                        <br>
                        <p style="width: 800px; float: left;">


                            <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo $PaitientName; ?>, is taking treatment with our clinic for
                            health
                            issues, we are
                            prescribing some Siddha, Homeopathy, Ayurvedic, Food supplements for health improvement.
                            <br>
                        </p>
                        <br><br><br><br>

                        <table class='table' border="1" cellpadding="4" cellspacing="4"
                            style="font-family: arial; font-size: 12px;	text-align:left;" width="60%">
                            <thead>
                                <tr>

                                    <th>S. No</th>
                                    <th> SC </th>
                                    <th> Medicine </th>
                                    <th> Nos </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($BillType == 'Regular') {
                                    $result = mysqli_query($connection, " 

                                    SELECT shortcode,productname,SUM(saleqty),SUM(discountamount), SUM(nettamount),invoiceno
FROM 
(SELECT shortcode,productname,saleqty,discountamount, nettamount,invoiceno 
FROM newsaleitems  WHERE invoiceno  ='$Invoice') AS a
GROUP BY  shortcode,productname,invoiceno; ");
                                } else if ($BillType == 'Open') {
                                    $result = mysqli_query($connection, " SELECT '-',UPPER(productname),saleqty,discountamount, nettamount,invoiceno
				FROM newsaleitems WHERE invoiceno  ='$Invoice'; ");
                                }
                                $Sno = 1;
                                while ($row = mysqli_fetch_row($result)) {

                                ?>
                                <tr class="record">
                                    <td><?php echo $Sno; ?></td>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td style="text-align:right"><?php echo $row[2]; ?></td>


                                </tr>
                                <?php
                                    $Sno = $Sno + 1;
                                }
                                ?>





                            </tbody>
                        </table>


                        <br>
                        <p>
                            The above medications and supplies are for the patient’s own use and must stay
                            with the patient at all times.
                        </p>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br>
                        <style>
                        .footer {
                            bottom: 0
                        }
                        </style>
                        <center class='footer'> <img src="../assets/img/letterheadaddress.png" class="media-object"
                                width="800" alt="" />
                        </center>

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