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

     <body>

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
                 width: 50%;
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


             td.billdetailsleftconsultatnt,
             th.billdetailsleftconsultatnt {
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
            SELECT  n2000,n500,n200,n100,n50,n20,n10,coin,b.username,medcash,
            concash,thecash,othcash,nettcash+expense-othcash,expense,nettcash,cashinhand,cashdifference,
            remarks,a.id,
            date_Format(a.closingdate,'%d-%m-%Y') as closingdate,
            openingcash,closingcash,pettycashdifference
            FROM denomination AS a 
            JOIN usermaster AS b ON a.enteredby=b.userid where a.id ='$Invoice'");


            while ($data = mysqli_fetch_row($res)) {

                $n2000 = $data[0];
                $n500 = $data[1];
                $n200 = $data[2];
                $n100 = $data[3];
                $n50 = $data[4];
                $n20 = $data[5];
                $n10 = $data[6];
                $coin = $data[7];
                $username = $data[8];
                $medcash = $data[9];
                $concash = $data[10];
                $thecash = $data[11];
                $othcash = $data[12];
                $grosscash = $data[13];
                $expense = $data[14];
                $nettcash = $data[15];
                $cashinhand = $data[16];
                $cashdifference = $data[17];
                $remarks = $data[18];
                $closingdate = $data[20];
                $OpeningPettyCash = $data[21];
                $ClosingPettyCash = $data[22];
                $PettyCashDifference = $data[23];
            }


            ?>

         <div class="ticket">
             <p class="centered"><u><b>

                         <label style='font-size:15px'>Cash Settlement - Con & Thy

                     </b>
             </p>
             </u></p>


             <center>

                 <table class='  '>
                     <tr>
                         <th class='billdetailsleft ' style="  border-bottom: 1px solid black;" nowrap>
                             Name:<?php echo $username; ?></th>
                         <th class='billdetailsright' style="  border-bottom: 1px solid black;">
                             Date:<?php echo $closingdate; ?></th>
                     </tr>


                     <tr>
                         <td class='billdetailsleft ' nowrap>Gross Cash:<?php echo  $grosscash; ?>
                         </td>
                     </tr>
                     <tr>
                         <td class='billdetailsleft ' nowrap>Oth. Income:<?php echo  $othcash; ?>
                         </td>
                     </tr>

                     <tr>
                         <td class='billdetailsleft ' nowrap>Expenses:<?php echo  $expense; ?>
                         </td>
                     </tr>
                     <tr>
                         <td class='billdetailsleft ' nowrap><b>Nett Cash:<?php echo  $nettcash; ?></b>
                         </td>
                     </tr>



                 </table>


                 <table>
                     <thead>
                         <tr>
                             <th class='' style="  border-bottom: 1px solid black;">#</th>
                             <th class="" style="  border-bottom: 1px solid black;">Note</th>
                             <th class="" style="  border-bottom: 1px solid black;">Count</th>
                             <th class="" style="  border-bottom: 1px solid black;">Amount</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>1</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>2000</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n2000; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n2000 * 2000; ?>
                             </td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>2</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>500</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n500; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n500 * 500; ?></td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>3</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>200</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n200; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n200 * 200; ?></td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>4</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>100</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n100; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n100 * 100; ?></td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>5</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>50</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n50; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n50 * 50; ?></td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>6</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>20</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n20; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n20 * 20; ?></td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>7</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>10</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n10; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $n10 * 10; ?></td>
                         </tr>

                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno'>8</td>
                             <td style=" border-top: 1px solid black;" class="description"><b>Coins</td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $coin; ?></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $coin * 1; ?></td>
                         </tr>
                         <tr>
                             <td style=" border-top: 1px solid black;" class='sno' colspan=2><b>Total</b>
                             </td>
                             <td style=" border-top: 1px solid black;" class="price"></td>
                             <td style=" border-top: 1px solid black;" class="price"><b><?php echo $cashinhand * 1; ?>
                             </td>
                         </tr>

                         <tr>
                             <td style=" " class='sno' colspan=2><b>Difference</b>
                             </td>
                             <td style=" " class="price"></td>
                             <td style="  " class="price">
                                 <b><?php echo $cashdifference * 1; ?>
                             </td>
                         </tr>



                     </tbody>
                 </table>

                 <label style='float:left;'>
                     <label style='float:left;'>
                         <u>Petty Cash</u></label>
                     <br>
                     <td>Op. Cash: <?php echo $OpeningPettyCash * 1; ?> | </td>
                     <td>Cl.Petty Cash: <?php echo $ClosingPettyCash * 1; ?> | </td>
                     <td><b>Diff: <?php echo $PettyCashDifference * 1; ?></b></td>

                     </tr>

                     <br>

                     <label style='float:left;'>Remarks:&nbsp;<?php echo $remarks; ?></label>
             </center>

         </div>
         <br>
         <br>
         <br>
         <button id="btnPrint" class="hidden-print">Print</button>
         <script src="script.js"></script>

         <script>
             const $btnPrint = document.querySelector("#btnPrint");
             $btnPrint.addEventListener("click", () => {
                 window.print();
             });
         </script>
     </body>

     </html>