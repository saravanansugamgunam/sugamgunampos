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

//     echo "  
//     SELECT studentname,studentmobileno,b.paymentid,DATE_FORMAT(b.paymentdate,'%d-%m-%Y') AS Paymentdate,c.batchname,
// d.coursename,e.paymentmode,
// (SELECT studentfees FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
// a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice') 
// GROUP BY studentfees) AS Fees,
// (SELECT SUM(paymentamount) FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
// a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice')) AS Paid,
// (SELECT studentfees FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
// a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice') 
// GROUP BY studentfees) -
// (SELECT SUM(paymentamount) FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
// a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice')) as Balance,
// b.paymentamount
// FROM studentmaster AS a 
// JOIN paymentdetails AS b ON a.studentcode =b.studentcode 
// JOIN batchmaster AS c ON b.batchcode=c.batchcode
// JOIN coursemaster AS d ON c.coursecode =d.coursecode 
// JOIN paymentmodemaster AS e ON b.paymentmodeid=e.paymentmodecode
// WHERE b.invoiceno='$Invoice' ";



    $res = $connection->query("  
      SELECT studentname,studentmobileno,b.paymentid,DATE_FORMAT(b.paymentdate,'%d-%m-%Y') AS Paymentdate,c.batchname,
d.coursename,e.paymentmode,
(SELECT studentfees FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice') 
GROUP BY studentfees) AS Fees,
(SELECT SUM(paymentamount) FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice')) AS Paid,
(SELECT studentfees FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice') 
GROUP BY studentfees) -
(SELECT SUM(paymentamount) FROM studentbatchmapping AS a JOIN paymentdetails AS b ON a.batchcode=b.batchcode AND
a.studentcode=b.studentcode WHERE a.studentcode IN(SELECT studentcode FROM paymentdetails WHERE invoiceno='$Invoice')) as Balance,
b.paymentamount
FROM studentmaster AS a 
JOIN paymentdetails AS b ON a.studentcode =b.studentcode 
JOIN batchmaster AS c ON b.batchcode=c.batchcode
JOIN coursemaster AS d ON c.coursecode =d.coursecode 
JOIN paymentmodemaster AS e ON b.paymentmodeid=e.paymentmodecode
WHERE b.invoiceno='$Invoice' ");


    $Balance = 0;
    while ($data = mysqli_fetch_row($res)) {

        $StudentName = $data[0];
        $MobileNo = $data[1];
        $PaymentNo = $data[2];
        $Date = $data[3];
        $BatchName = $data[4];
        $CourseName = $data[5];
        $Paymentmode = $data[6];
        $TotalFee = $data[7];
        $Paid = $data[8];
        $Balance = $data[9];
        $PaymentAmount = $data[10];
    }

    ?>
    <div class="ticket">
        <p class="centered"> <b>
                <b> <label style='font-size:20px'> Receipt </label> <br></b>
                <p hidden>
                    Estimate - <?php
                                if ($BillLocationCode == '0') {
                                    echo "VAN ";
                                } else if ($BillLocationCode == '1') {
                                    echo "CHE";
                                } else if ($BillLocationCode == '2') {
                                    echo "VDP";
                                } ?>
            </b>
        </p>
        </u></p>


        <center>

            <table class='billdetails '>
                <tr>
                    <th class='billdetailsleft ' nowrap>Name:<?php echo $StudentName; ?></th>
                    <th class='billdetailsright'>No:<?php echo $PaymentNo; ?></th>
                </tr>
                <tr>
                    <th class='billdetailsleft '>Mobile: <?php echo $MobileNo; ?></th>
                    <th class='billdetailsright'>Date:<?php echo $Date; ?></th>
                </tr>

            </table>


            <table>
                <thead>
                    <tr>
                        <th class='sno' style="  border-bottom: 1px solid black;">#</th>
                        <th class="description" style="  border-bottom: 1px solid black;">Description</th>
                        <th class="price" style="  border-bottom: 1px solid black;">Amount</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class='sno'>1</td>
                        <td class="description"><?php echo $CourseName;
                                                echo "-";
                                                echo $BatchName; ?></td>
                        <td class="price"><?php echo $PaymentAmount; ?></td>




                    </tr>


                    <tr>
                        <td style=" border-top: 1px solid black;" class='sno'></td>
                        <td style=" border-top: 1px solid black;" class="description"><b>Total</td>
                        <td style=" border-top: 1px solid black;" class="price"><b><?php echo $PaymentAmount; ?></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td style=" border-top: 1px solid black;word-break:nowrap;" class="description"><b><br></td>
                        <td style=" border-top: 1px solid black;" class="price"><br></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td nowrap class="description"> Total Fees</td>
                        <td class="price"> <?php echo $TotalFee; ?></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td nowrap class="description"> Total Paid</td>
                        <td class="price"> <?php echo $Paid; ?></td>
                    </tr>


                    <tr>
                        <td class='sno'></td>
                        <td nowrap style=" border-top: 1px solid black;" class="description"><b>Current Balance</td>
                        <td style=" border-top: 1px solid black;" class="price"><b><?php echo $Balance; ?></td>
                    </tr>

                </tbody>
            </table>
        </center>
        <p class="centered">Thanks you!!!
        </p>
    </div>
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