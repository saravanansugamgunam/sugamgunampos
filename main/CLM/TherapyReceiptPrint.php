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


              table {

                  width: 95%;
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
   
   (SELECT round(SUM(grossamount),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Total,
   (SELECT round(SUM(discountamount),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Discount,
   (SELECT round(SUM(grossamount-discountamount),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS NettAmount, 
   (SELECT round(SUM(oldbalance),0) FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS PreviousBalance, 

   (SELECT  SUM(creditamount) 
   FROM transactionledger WHERE invoicegrn ='$Invoice' AND 
   transactionmode IN('Therapy - Payment','Therapy - Advance Payment','Therapy - Outstanding Payment')   )  AS Paid,

   (SELECT  SUM(debitamount)-SUM(creditamount) FROM transactionledger WHERE invoicegrn  ='$Invoice' ) AS CurrentBalance,


	(SELECT tokennumber FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS Token ,
	(SELECT username FROM  usermaster WHERE userid IN(
        SELECT doctorid FROM therapybookingdetails WHERE bookinguniqueid IN('$Invoice')) LIMIT 1 ) AS DoctorName,
	(SELECT  COUNT(*) FROM  consultingdetails   WHERE consultationuniquebill  ='$Invoice') AS TotalItem,
	(SELECT locationcode FROM consultingbillmaster WHERE consultationuniquebill  ='$Invoice' ) AS BillLocationCode,

    
	(SELECT DATE_FORMAT(therapydate,'%d-%m-%Y') FROM therapybookingmaster WHERE bookinguniqueid  ='$Invoice' ) AS TherapyDate,
    
	(SELECT IF(therapytime='00:00:00',DATE_FORMAT(addedon,'%H:%m:%p'),therapytime) AS 
    therapytm FROM therapybookingmaster WHERE bookinguniqueid ='$Invoice') AS TherapyTime




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
                $TherapyDate = $data[14];
                $TherapyTime = $data[15];
            }

            ?>
          <div class="ticket">
              <p class="centered"><u><b>
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
                          <th class='billdetailsleftconsultatnt ' nowrap colspan=2>Therapist:
                              <?php echo $DoctorName; ?></th>
                      </tr>
                      <tr>
                          <th class='billdetailsleft '>Th.Dt: <?php echo $TherapyDate; ?></th>
                          <th class='billdetailsright'>Th.Time:<?php echo $TherapyTime; ?></th>
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
     b ON a.consultationid = b.consultationid   WHERE consultationuniquebill ='$Invoice';
    
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

                          <td class='sno'></td>
                          <td style=" border-top: 1px solid black;word-break:nowrap;" class="description"><b><br></td>
                          <td style=" border-top: 1px solid black;" class="price"><br></td>

                      </tbody>
                  </table>

                  <br>
                  <label style='float:left;'>
                      &nbsp;&nbsp;&nbsp;&nbsp;<b>Therapy Timing</b>
                  </label>

                  <table>
                      <thead>
                          <tr>
                              <th style="border-bottom: 1px solid black;" #</th>
                              <th style="border-bottom: 1px solid black;"> Date</th>
                              <th style="border-bottom: 1px solid black;">Amount</th>
                          </tr>
                      </thead>
                      <tbody>

                          <?php
                            // 	$result = mysqli_query($connection, " SELECT DATE_FORMAT(createdon,'%d-%m-%y'),creditamount 
                            //     FROM transactionledger WHERE invoicegrn ='$Invoice' AND 
                            //     transactionmode IN('Therapy - Payment','Therapy - Advance Payment','Therapy - Outstanding Payment')
                            //    ; "); 

                            $result = mysqli_query($connection, " 
				SELECT b.consultationname,a.totalsitings, 
                TRIM(TRAILING  SUBSTRING(
                    CONCAT(DATE_FORMAT(reviseddate,'%d-%m-%y'),' / ',IFNULL(d.timeslot,revisedtime)) ,20, 9) FROM 
                    CONCAT(DATE_FORMAT(reviseddate,'%d-%m-%y'),' / ',IFNULL(d.timeslot,revisedtime))  )  AS  ff 
			 
			   FROM therapybookingdetails AS a 
			   JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
			   JOIN usermaster AS c ON a.doctorid=c.userid 
			   LEFT JOIN 
			   (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a 
			   LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid ='$Invoice'
			   GROUP BY bookingitemid) AS d
			   ON  a.bookingid =d.bookingitemid
			   WHERE bookinguniqueid ='$Invoice' 
			   GROUP BY  b.consultationname,reviseddate, 
			   IFNULL(d.timeslot,revisedtime)
			   ORDER BY reviseddate,therapyid,sitingid,a.bookingid  ; ");



                            $Sno = 1;
                            while ($row = mysqli_fetch_row($result)) {

                            ?>

                              <tr>
                                  <td><?php echo $Sno; ?></td>

                                  <td><?php echo $row[0]; ?></td>
                                  <td><?php echo $row[2]; ?></td>

                              </tr>
                          <?php
                                $Sno = $Sno + 1;
                            }
                            ?>

                      </tbody>
                  </table>



                  <br>
                  <label style='float:left;'>
                      &nbsp;&nbsp;&nbsp;&nbsp;<b>Payment Details</b>
                  </label>

                  <table>
                      <thead>
                          <tr>
                              <th class='sno' style="  border-bottom: 1px solid black;">#</th>
                              <th class="description" style="  border-bottom: 1px solid black;">
                                  Date</th>
                              <th class="price" style="  border-bottom: 1px solid black;">Amount</th>
                          </tr>
                      </thead>
                      <tbody>

                          <?php
                            // 	$result = mysqli_query($connection, " SELECT DATE_FORMAT(createdon,'%d-%m-%y'),creditamount 
                            //     FROM transactionledger WHERE invoicegrn ='$Invoice' AND 
                            //     transactionmode IN('Therapy - Payment','Therapy - Advance Payment','Therapy - Outstanding Payment')
                            //    ; "); 

                            $result = mysqli_query($connection, " select concat(date_format(date,'%d-%m-%Y'),'<br>',b.paymentmode),
amount from salepaymentdetails  as a 
join paymentmodemaster as b on a.paymentmode=b.paymentmodecode
where invoiceno ='$Invoice'  ");


                            $Sno = 1;
                            while ($row = mysqli_fetch_row($result)) {

                            ?>

                              <tr>
                                  <td class='sno'><?php echo $Sno; ?></td>
                                  <td class="description">
                                      <?php
                                        echo ' ', $row[0];
                                        ?>
                                  </td>
                                  <td class="price"><?php echo $row[1]; ?></td>




                              </tr>
                          <?php
                                $Sno = $Sno + 1;
                            }
                            ?>



                      </tbody>
                  </table>



              </center>
              <p class="centered">Please arrive 20 mins before prescribed time, <br>
                  NO Refund allowed <br>
                  Thanks you!!!
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