     <?php
        // Start the buffering //
        ob_start();

        include("../../connect.php");

        session_cache_limiter(FALSE);
        session_start();
        $position = $_SESSION["SESS_LAST_NAME"];
        $LocationCode = $_SESSION['SESS_LOCATION'];
        ?>

     <!DOCTYPE html>
     <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <link rel="stylesheet" href="style.css">
         <title>Estimate</title>
     </head>

     <body onload='PrintOnLoad()'>

         <style>
         body {
             font-size: 11px;
             font-family: Verdana, sans-serif;
         }

         td,
         th,
         tr,
         table {

             width: 90%;
         }


         th {
             border-top: 1px solid black;


         }



         td.description,
         th.description {
             width: 20%;
             word-break: nowrap;
         }

         td.quantity,
         th.quantity {
             width: 10%;

             text-align: right;
         }

         td.price,
         th.price {
             width: 50%;
             word-break: break-all;
             text-align: right;
         }

         table.billdetails {

             border-collapse: collapse;
             width: 90%;
         }



         td.billdetailsleft,
         th.billdetailsleft {
             border-bottom: 1px solid white;
             width: 20px;
             max-width: 20px;
             word-break: nowrap;
             text-align: left;

         }

         td.billdetailsright,
         th.billdetailsright {
             border-bottom: 1px solid white;
             width: 20px;
             max-width: 20px;
             word-break: nowrap;
             text-align: right;

         }


         td.sno,
         th.sno {
             width: 10%;
             word-break: break-all;
             text-align: right;
         }

         .centered {
             text-align: center;
             align-content: center;
         }

         .ticket {
             width: 300px;
             max-width: 300px;
         }

         img {
             max-width: inherit;
             width: inherit;
         }

         @media print {

             .hidden-print,
             .hidden-print * {
                 display: none !important;
             }
         }
         </style>

         <?php
            $Invoice = $_GET['invoice'];


            $res = $connection->query("  
   SELECT 
   
   (SELECT  paitentname FROM salemaster AS a JOIN paitentmaster AS b ON a.paitientcode = b.paitentid WHERE saleuniqueno ='$Invoice') AS PaitentName,
   (SELECT  mobileno FROM salemaster AS a JOIN paitentmaster AS b ON a.paitientcode = b.paitentid WHERE saleuniqueno ='$Invoice') AS MobileNo,
   
   (SELECT CONCAT(invoiceno,'-',saleid) FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS BillNo,
   (SELECT DATE_FORMAT(saledate,'%d-%m-%Y') FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS BillDate,
   
   (SELECT SUM(saleqty*mrp) FROM newsaleitems WHERE invoiceno  ='$Invoice' ) AS Total,
   (SELECT SUM(discountamount) FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS Discount, 
   (SELECT SUM(nettamount) FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS NettAmount, 
   (SELECT SUM(oldbalance) FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS PreviousBalance, 
   (SELECT SUM(amount) FROM salepaymentdetails WHERE invoiceno  ='$Invoice' )  AS Paid,
   (SELECT SUM(newbalance) FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS CurrentBalance,
   (SELECT SUM(couriercharges) FROM salemaster WHERE saleuniqueno  ='$Invoice' ) AS CourierCharge,
   (SELECT invoiceno FROM salemaster WHERE saleuniqueno  ='$Invoice' limit 1 ) AS LocationCode,
   (SELECT billtype FROM salemaster WHERE saleuniqueno  ='$Invoice' limit 1 ) AS BillType,
   (SELECT deliverystatus FROM salemaster WHERE saleuniqueno  ='$Invoice' limit 1 ) AS DeliveryStatus,
   (SELECT saleqty FROM salemaster WHERE saleuniqueno  ='$Invoice' limit 1 ) AS TotalQty,
   (SELECT transactiontype FROM salemaster WHERE saleuniqueno  ='$Invoice' limit 1 ) AS TransactionType
   
   ");



            while ($data = mysqli_fetch_row($res)) {

                $PaitentName = $data[0];
                $MobileNo = $data[1];
                $BillNo = $data[2];
                $BillDate = $data[3];
                $Total = $data[6] ;
                $Discount = $data[5];
                $NettAmount = $data[6] + $data[10];
                $PreviousBalance = $data[7];
                $Paid = $data[8];
                $CurrentBalance = $data[9];
                $CourierCharge = $data[10];
                $BillLocationCode = $data[11];
                $BillType = $data[12];
                $DeliveryStatus = $data[13];
                $TotalQty = $data[14];
                $TransactionType = $data[15];
            }

            ?>
         <div class="ticket">
             <p class="centered" style="display:none;"><u><b>Estimate - <?php
                                                                        if ($BillLocationCode == 'L0') {
                                                                            echo "VAN";
                                                                        } else if ($BillLocationCode == 'L1') {
                                                                            echo "CHE";
                                                                        } else if ($BillLocationCode == 'L2') {
                                                                            echo "VDP";
                                                                        } ?></b></u></p>


             <center>

                 <table class='billdetails '>
                     <tr>
                         <th class='billdetailsleft ' nowrap>Name:<?php echo $PaitentName; ?></th>
                         <th class='billdetailsright'>No:<?php echo $BillNo; ?></th>
                     </tr>
                     <tr nowrap>
                         <th class='billdetailsleft'>Mobile: <?php echo $MobileNo; ?></th>
                         <th class='billdetailsright'>Date:<?php echo $BillDate; ?></th>
                     </tr>
                 </table>


                 <table>
                     <thead>
                         <tr>
                             <th class='sno' style="  border-bottom: 1px solid black;">#</th>
                             <th class="description" style="  border-bottom: 1px solid black;">Description</th>
                             <th class="quantity" style="  border-bottom: 1px solid black;">Qty</th>
                             <th class="price" style="  border-bottom: 1px solid black;">Amount</th>
                         </tr>
                     </thead>
                     <tbody>

                         <?php
                            if ($BillType == 'Regular') {
                                if ($DeliveryStatus == 1) {


                                    $result = mysqli_query($connection, "   
                        SELECT   shortcode,sum(saleqty), SUM(nettamount)  FROM newsaleitems
          WHERE invoiceno  ='$Invoice' group by shortcode  ");
                                } else {
                                    if ($TransactionType == 'Return') {
                                        $result = mysqli_query($connection, "   
                            SELECT   shortcode,sum(saleqty), SUM(nettamount)  FROM newsaleitems
                            WHERE invoiceno  ='$Invoice' group by shortcode ");
                                    } else {
                                        $result = mysqli_query($connection, "   
                            SELECT   shortcode,sum(saleqty), SUM(nettamount)  FROM newsaleitemsproduct
                            WHERE invoiceno  ='$Invoice' group by shortcode ");
                                    }
                                }
                            } else if ($BillType == 'Open') {
                                $result = mysqli_query($connection, "   
				 SELECT   upper(productname),saleqty, SUM(nettamount)  FROM newsaleitems
   WHERE invoiceno  ='$Invoice'; ");
                            }



                            $Sno = 1;
                            while ($row = mysqli_fetch_row($result)) {

                            ?>

                         <tr>
                             <td class='sno'><?php echo $Sno; ?></td>
                             <td class="description"><?php echo $row[0]; ?></td>
                             <td class="quantity"><?php echo $row[1]; ?></td>
                             <td class="price"><?php echo $row[2]; ?></td>

                         </tr>
                         <?php
                                $Sno = $Sno + 1;
                            }
                            ?>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'></td>
                             <td style=" border-top: 1px solid black;" class="description"><b>Total</td>
                             <td style=" border-top: 1px solid black;" class="quantity"><?php echo $TotalQty; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $Total; ?></td>
                         </tr>
                         <?php if ($Discount > 0) {
                            ?>
                         <tr>
                             <td class='sno'></td>
                             <td class="quantity"></td>
                             <td class="description"> Discount</td>
                             <td class="price"> <?php echo $Discount; ?></td>
                         </tr>
                         <?php } ?>

                         <?php if ($CourierCharge > 0) {
                            ?>

                         <tr>
                             <td class='sno'></td>
                             <td class="quantity"></td>
                             <td class="description"><b>Courier</td>
                             <td class="price"><b><?php echo $CourierCharge; ?></td>
                         </tr>
                         <?php } ?>

                         <?php if ($CourierCharge > 0 || $Discount > 0) {
                            ?>

                         <tr>
                             <td class='sno'></td>
                             <td class="quantity"></td>
                             <td nowrap style=" border-top: 1px solid black;" class="description"><b>Nett Amount</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $NettAmount; ?></td>
                         </tr>
                         <?php } ?>

                         <tr>
                             <td class='sno'></td>
                             <td class="quantity"></td>
                             <td style=" border-top: 1px solid black;word-break:nowrap;" class="description"><b><br>
                             </td>
                             <td style=" border-top: 1px solid black;" class="price"><br></td>
                         </tr>

                         <tr>
                             <td colspan="2" rowspan="3">

                                 <img style='border-left: 1px solid white;  font-size:10px padding:2px;'
                                     src="https://chart.googleapis.com/chart?chs=300x200&cht=qr&chl=<?php echo $Invoice; ?>&DS=S%2F&choe=UTF-8"
                                     title="Link to Invoice" />
                             </td>
                             <?php if ($PreviousBalance < 0) {
                                ?>
                             <td nowrap class="description"> Prev.Advance</td>
                             <?php  } else {
                                ?>
                             <td nowrap class="description"> Prev.Balance</td>
                             <?php } ?>

                             <td class="price"> <?php echo $PreviousBalance; ?></td>
                         </tr>

                         <tr>

                             <td nowrap class="description"> Current Bill</td>
                             <td class="price"> <?php echo $NettAmount; ?></td>
                         </tr>

                         <tr>
                             <td nowrap class="description"> Paid</td>
                             <td class="price"> <?php echo $Paid; ?></td>
                         </tr>

                         <tr>
                             <td class='sno'></td>
                             <td class="quantity"></td>
                             <td nowrap style=" border-top: 1px solid black;" class="description"><b>Current Balance
                             </td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $CurrentBalance; ?>
                             </td>
                         </tr>

                     </tbody>
                 </table>
             </center>
             <p class="centered">NO RETURNS!!!
                 Thanks you!!!
             </p>

         </div>
         <button id="btnPrint" class="hidden-print">Print</button>

         <button id="printaddress" onclick="redirecttoReceiptPrint();" class="hidden-print">Print Address</button>
         <script src="script.js"></script>

         <script>
         const $btnPrint = document.querySelector("#btnPrint");
         $btnPrint.addEventListener("click", () => {
             window.print();
         });
         </script>

         <script>
         function PrintOnLoad() {

             window.print();

         }
         </script>


         <script>
         function redirecttoReceiptPrint() {
             var Invoice = <?php echo $Invoice; ?>;
             var str1 = "ReceiptPrintAddress.php?invoice=";
             var str2 = Invoice;
             var str3 = "";
             var BillPrintURL = str1.concat(str2, str3);
             // alert(BillPrintURL);
             // window.location.href = BillPrintURL;
             window.open(BillPrintURL);
         }
         </script>


     </body>

     </html>