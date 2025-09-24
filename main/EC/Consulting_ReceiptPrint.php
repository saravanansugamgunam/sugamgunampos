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
   
 SELECT 
   
   (SELECT  paitentname FROM consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE consultationuniquebill ='$Invoice') AS PaitentName,
   (SELECT  mobileno FROM consultingbillmaster AS a JOIN paitentmaster AS b ON a.paitentid= b.paitentid WHERE consultationuniquebill ='$Invoice') AS MobileNo,
   
   (SELECT billid FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS BillNo,
   (SELECT DATE_FORMAT(billdate,'%d-%m-%Y') FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS BillDate,
   
   (SELECT SUM(grossamount) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Total,
   (SELECT SUM(discountamount) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Discount,
   (SELECT SUM(grossamount-discountamount) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS NettAmount, 
   (SELECT SUM(oldbalance) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS PreviousBalance, 
   (SELECT SUM(receivedamount) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' )  AS Paid,
   (SELECT SUM(newbalance) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS CurrentBalance,
	(SELECT tokennumber FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Token ,
	(SELECT  username FROM consultingbillmaster AS a JOIN usermaster AS b ON a.doctorid= b.userid WHERE consultationuniquebill ='$Invoice') AS DoctorName,
	(SELECT  COUNT(*) FROM  consultingdetails   WHERE consultationuniquebill  ='$Invoice') AS TotalItem,
	(SELECT locationcode FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS BillLocationCode,
    (SELECT count(*) FROM  consultingdetails   WHERE  consultationid='33' and consultationuniquebill  ='$Invoice') AS SpecialConsulting,
    (SELECT timing FROM consultingtiming  WHERE id IN (
        SELECT timeid FROM  consultingbillmaster WHERE consultationuniquebill ='$Invoice' ))   AS Timing
	");



    while ($data = mysqli_fetch_row($res)) {

        $PaitentName = $data[0];
        $MobileNo = $data[1];
        $BillNo = $data[2];
        $BillDate = $data[3];
        $Total = $data[4];
        $Discount = $data[5];
        $NettAmount = $data[6];
        $PreviousBalance = $data[7];
        $Paid = $data[8];
        $CurrentBalance = $data[9];
        $Token = $data[10];
        $DoctorName = $data[11];
        $TotalItem = $data[12];
        $BillLocationCode = $data[13];
        $SpecialConsulting = $data[14];
        $SpecialTiming = $data[15];
    }

    ?>
    <div class="ticket">
        <p class="centered"><u><b>
                    <?php
                    if ($SpecialConsulting > 0) {
                        echo " <b> <label style='font-size:20px'>Special Consulting
                    <br>
                    <label style='font-size:12px'>Time:";
                        echo $SpecialTiming;
                        echo "</label> <br></b>";
                    } else {
                        echo " <b> <label style='font-size:20px'>Token:";
                        echo $Token;
                        echo "</label>
                         <br></b>";
                    }
                    ?>

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
                    <th class='billdetailsleft ' nowrap>Name:<?php echo $PaitentName; ?></th>
                    <th class='billdetailsright'>No:<?php echo $BillNo; ?></th>
                </tr>
                <tr>
                    <th class='billdetailsleft '>Mobile: <?php echo $MobileNo; ?></th>
                    <th class='billdetailsright'>Date:<?php echo $BillDate; ?></th>
                </tr>
                <tr>
                    <th class='billdetailsleftconsultatnt ' nowrap colspan=2>Consultant:
                        <?php echo $DoctorName; ?></th>
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

                    <?php
                    $result = mysqli_query($connection, "   
				
				
    SELECT b.consultationname,round((a.consultationcharge)+
	(SELECT  extracharge FROM consultingbillmaster WHERE consultationuniquebill ='$Invoice')/$TotalItem,0)

	FROM  `consultingdetails` AS a JOIN `consultationmaster` AS 
     b ON a.consultationid = b.consultationid   WHERE consultationuniquebill ='$Invoice' and a.consultationid<>'9999'  

union 
     				
    SELECT a.consultationname,round((a.consultationcharge)+
	(SELECT  extracharge FROM consultingbillmaster WHERE consultationuniquebill ='$Invoice')/$TotalItem,0)

	FROM  `consultingdetails` AS a JOIN `consultationmaster` AS 
     b ON a.consultationid = b.consultationid   WHERE consultationuniquebill ='$Invoice' and a.consultationid='9999';
    
    
	 ");

                    $Sno = 1;
                    while ($row = mysqli_fetch_row($result)) {

                    ?>

                        <tr>
                            <td class='sno'><?php echo $Sno; ?></td>
                            <td class="description"><?php echo $row[0]; ?></td>
                            <td class="price"><?php echo $row[1]; ?></td>




                        </tr>
                    <?php
                        $Sno = $Sno + 1;
                    }
                    ?>

                    <tr>
                        <td style=" border-top: 1px solid black;" class='sno'></td>
                        <td style=" border-top: 1px solid black;" class="description"><b>Total</td>
                        <td style=" border-top: 1px solid black;" class="price"><b><?php echo $Total; ?></td>
                    </tr>
                    <?php if ($Discount > 0) {
                    ?>
                        <tr>
                            <td class='sno'></td>
                            <td class="description"> Discount</td>
                            <td class="price"> <?php echo $Discount; ?></td>
                        </tr>



                        <tr>
                            <td class='sno'></td>
                            <td nowrap style=" border-top: 1px solid black;" class="description"><b>Nett Amount</td>
                            <td style=" border-top: 1px solid black;" class="price"><b><?php echo $NettAmount; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class='sno'></td>
                        <td style=" border-top: 1px solid black;word-break:nowrap;" class="description"><b><br>
                        </td>
                        <td style=" border-top: 1px solid black;" class="price"><br></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td nowrap class="description"> Prev.Balance</td>
                        <td class="price"> <?php echo $PreviousBalance; ?></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td nowrap class="description"> Current Bill</td>
                        <td class="price"> <?php echo $NettAmount; ?></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td nowrap class="description"> Paid</td>
                        <td class="price"> <?php echo $Paid; ?></td>
                    </tr>

                    <tr>
                        <td class='sno'></td>
                        <td nowrap style=" border-top: 1px solid black;" class="description"><b>Current Balance
                        </td>
                        <td style=" border-top: 1px solid black;" class="price"><b><?php echo $CurrentBalance; ?>
                        </td>
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
        function PrintOnLoad() {

            window.print();

        }
    </script>


    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>

</html>