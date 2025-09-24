<?php

include("../../connect.php");
// $position=$_SESSION["SESS_LAST_NAME"]; 
session_cache_limiter(FALSE);
session_start();

$PaitentId = $_GET['P'];
$UniqueID = $_GET['UID'];
$P1 = 0;//$_GET['P1'];
$P2 = 0;//$_GET['P2'];
$P3 = 0;//$_GET['P3'];
$P4 = 0;//$_GET['P4'];
$P5 = 0;//$_GET['P5'];
$P6 = 0;//$_GET['P6']; 

$userid = $_SESSION["SESS_MEMBER_ID"];
$LocationCode = $_SESSION['SESS_LOCATION'];
if (isset($_SESSION['SESS_LAST_NAME'])) {
    //echo 'Session Active';

} else {
    //echo 'Session In Active';
    $url = '../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; ' . $url . '">';
}

if(strlen($UniqueID)==16)
{

    $res = $connection->query(" 
  

    SELECT DATE_FORMAT(consultingdate,'%d %M %Y') AS BillDate, b.paitentname, b.mobileno, 
    b.`gender` AS Gender,TIMESTAMPDIFF(YEAR,b.`dob`, CURRENT_DATE()) AS Age,
    IFNULL(a.bp,'-') AS BP,IFNULL(a.height,'-') AS Height,IFNULL(a.weight,'-') AS Weight,
    IFNULL(a.pulse,'-' ) AS Pulse,IFNULL(a.temperature,'-') AS Temp,IFNULL(a.shn,'-') AS Skin,
    IFNULL(a.diet,'-') AS Diet,
    
    
    (SELECT  GROUP_CONCAT(symptoms  ORDER BY symptoms ASC) 
    FROM diseasemapping_paitent AS a 
    JOIN symptomsmaster AS b ON a.conceptid=b.symptomsid AND a.conceptname='Symptoms' AND a.paitientid='$PaitentId'
    WHERE  diseasemappinguniqueid ='$UniqueID') AS Symptoms,


    (  SELECT  GROUP_CONCAT('&nbsp;',diagnosis   ORDER BY diagnosis ASC) 
    FROM diseasemapping_paitent AS a 
    JOIN diagnosismaster AS b ON a.conceptid=b.diagnosisid AND a.conceptname='Diagnosis' AND a.paitientid='$PaitentId'
    WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Diagnosis,


    ( SELECT  GROUP_CONCAT(acupoints  ORDER BY acupoints ASC) 
    FROM diseasemapping_paitent AS a 
    JOIN acupuncturepoints AS b ON a.conceptid=b.acuid AND a.conceptname='Acupoints' AND a.paitientid='$PaitentId'
    WHERE  diseasemappinguniqueid ='$UniqueID') AS Acupoints,


    (SELECT GROUP_CONCAT(CONCAT(productshortcode,': ' ,productname)  ORDER BY CONCAT(productshortcode,': ' ,productname) ASC) 
    FROM diseasemapping_paitent AS a 
    JOIN productmaster AS b ON a.conceptid=b.productid AND a.conceptname='Medicine' AND a.paitientid='$PaitentId'
    WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Medicine,


    (SELECT GROUP_CONCAT('&nbsp;',consultationname,'- (',duration,' Sittings',' ',c.conditionname,')'  ORDER BY consultationname ASC) 
    FROM diseasemapping_paitent AS a 
    JOIN consultationmaster AS b ON a.conceptid=b.consultationid AND a.conceptname='Therapy' AND a.paitientid='$PaitentId'
    LEFT JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond
    WHERE  diseasemappinguniqueid ='$UniqueID'
    GROUP BY paitientid,consultingdate) AS Therapy,


    (SELECT GROUP_CONCAT(pathology  ORDER BY pathology ASC) 
    FROM diseasemapping_paitent AS a 
    JOIN pathologymaster AS b ON a.conceptid=b.pathologyid AND a.conceptname='Pathology' AND a.paitientid='$PaitentId'
    WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Test,

    DATE_FORMAT(nextappointmentdate,'%d-%m-%Y'),
    testsrequired,
    c.doctorshortcode


    FROM  casehistory AS a JOIN 
    paitentmaster AS b ON a.paitentid = b.paitentid  
    JOIN usermaster AS c ON a.createdby = c.userid  
    WHERE  consultinguniqueid ='$UniqueID';"); 

}
else
{
    
$res = $connection->query(" 
  

SELECT DATE_FORMAT(a.billdate,'%d %M %Y') AS BillDate, b.paitentname, b.mobileno, 
b.`gender` AS Gender,TIMESTAMPDIFF(YEAR,b.`dob`, CURRENT_DATE()) AS Age,
IFNULL(d.bp,'-') AS BP,IFNULL(d.height,'-') AS Height,IFNULL(d.weight,'-') AS Weight,
IFNULL(d.pulse,'-' ) AS Pulse,IFNULL(d.temperature,'-') AS Temp,IFNULL(d.shn,'-') AS Skin,
IFNULL(d.diet,'-') AS Diet,


(SELECT  GROUP_CONCAT(symptoms  ORDER BY symptoms ASC) 
FROM diseasemapping_paitent AS a 
JOIN symptomsmaster AS b ON a.conceptid=b.symptomsid AND a.conceptname='Symptoms' AND a.paitientid='$PaitentId'
WHERE  diseasemappinguniqueid ='$UniqueID') AS Symptoms,


(  SELECT  GROUP_CONCAT('&nbsp;',diagnosis   ORDER BY diagnosis ASC) 
FROM diseasemapping_paitent AS a 
JOIN diagnosismaster AS b ON a.conceptid=b.diagnosisid AND a.conceptname='Diagnosis' AND a.paitientid='$PaitentId'
WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Diagnosis,


( SELECT  GROUP_CONCAT(acupoints  ORDER BY acupoints ASC) 
FROM diseasemapping_paitent AS a 
JOIN acupuncturepoints AS b ON a.conceptid=b.acuid AND a.conceptname='Acupoints' AND a.paitientid='$PaitentId'
WHERE  diseasemappinguniqueid ='$UniqueID') AS Acupoints,


(SELECT GROUP_CONCAT(CONCAT(productshortcode,': ' ,productname)  ORDER BY CONCAT(productshortcode,': ' ,productname) ASC) 
FROM diseasemapping_paitent AS a 
JOIN productmaster AS b ON a.conceptid=b.productid AND a.conceptname='Medicine' AND a.paitientid='$PaitentId'
WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Medicine,


(SELECT GROUP_CONCAT('&nbsp;',consultationname,'- (',duration,' Sittings',' ',c.conditionname,')'  ORDER BY consultationname ASC) 
FROM diseasemapping_paitent AS a 
JOIN consultationmaster AS b ON a.conceptid=b.consultationid AND a.conceptname='Therapy' AND a.paitientid='$PaitentId'
LEFT JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond
WHERE  diseasemappinguniqueid ='$UniqueID'
GROUP BY paitientid,consultingdate) AS Therapy,


(SELECT GROUP_CONCAT(pathology  ORDER BY pathology ASC) 
FROM diseasemapping_paitent AS a 
JOIN pathologymaster AS b ON a.conceptid=b.pathologyid AND a.conceptname='Pathology' AND a.paitientid='$PaitentId'
WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Test,

DATE_FORMAT(nextappointmentdate,'%d-%m-%Y'),
testsrequired,
c.doctorshortcode


FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
JOIN usermaster AS c ON a.doctorid = c.userid 
LEFT JOIN casehistory AS d ON a.consultationuniquebill= d.consultinguniqueid  
WHERE consultationuniquebill ='$UniqueID';"); 

}


while($data = mysqli_fetch_row($res))
{
 
$InvoiceDate=$data[0];
$PaitientName=$data[1]; 
$MobileNo=$data[2]; 
$Gender=$data[3];  
$Age=$data[4];  
$BP=$data[5];  
$Height=$data[6];  
$Weight=$data[7];  
$Pulse=$data[8];  
$Temperature=$data[9];  
$Skin=$data[10];  
$DietChart=$data[11];  
$Symptoms=$data[12];  
$Diagnosis=$data[13];  
$AcuPoints=$data[14];  
$Medicine=$data[15];  
$Therapy=$data[16];  
$Pathology=$data[17];  
$NextAppointment=$data[18];  
$PathologyRemarks=$data[19];  
$DoctorCode=$data[20]; 

if($data[18]=='01 January 1900')
{
    $NextAppointment = '';
}
 

}
?>

<!DOCTYPE html>
<!-- saved from url=(0092)http://localhost/pos/main/CLM/CaseSheetPrint.php?PID=7853&INV=1714692711842&TID=1&S=O&MID=31 -->
<html lang="en" data-style="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">


    <!-- Page CSS -->

    <link rel="stylesheet" href="app-invoice-print2.css">

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <link rel="stylesheet" type="text/css" href="./CaseSheetPrint_files/core.css" class="template-customizer-core-css">

    <style>
    .outerDiv {

        width: 768px;
        margin: 0px auto;
        padding: 1px;
    }

    .leftDiv {

        color: #000;

        width: 38%;
        float: left;
    }

    .rightDiv {
        width: 55%;
        float: right;
    }
    </style>
</head>

<body onload="window.print()">


    <div class="invoice-print p-10">

        <div class="outerDiv">
            <div class="leftDiv">
                <img src='newlogo.png' height='50'><br>
                <h7>Health Centre & Herbal Pharmacy</h7><br>
            </div>
            <div class="rightDiv">
                <h7>AP 393,17th Street, Thiruvalluvar Kudiyirippu, </h7><br>
                <h7>I Block,Anna Nagar, Chennai - 600040</h7><br>
                <h7>Med: 9176606308 | Consulting: 9488228603</h7><br>
                <h7>Online Shop: www.sugamgunam.com</h7><br>
            </div>
            <div style="clear: both;"></div>
        </div>

        <br>
        <center>
            <h7><b>Registered under Clinical Establishment Act in Ministry of AYUSH, Govt. of India</b></h7><br>

        </center>


        <hr class="mb-2">

        <div class="d-flex justify-content-between mb-1">
            <div class="my-1">
                <h6><?php echo $PaitientName; ?> (<?php echo $Gender; ?>) / Age: <?php echo $Age; ?> Yrs <br>
                    Mob No: <?php echo $MobileNo; ?></h6>


            </div>
            <div class="my-1  mb-1 ">
                <h6><b>Date: <?php echo $InvoiceDate; ?></b><br>
                    Code: <?php echo $DoctorCode; ?><br>
                    Next Appointment: <?php echo $NextAppointment; ?>
                </h6>


            </div>
        </div> 


        <?php   
  $result = mysqli_query($connection, "  SELECT productshortcode,
 if(mor=0,'',concat(mor,' ',if(prescriptionuom='-','',prescriptionuom))),
   if(aft=0,'',concat(aft,' ',if(prescriptionuom='-','',prescriptionuom))),
   if(eve=0,'',concat(eve,' ',if(prescriptionuom='-','',prescriptionuom))),
   if(nig=0,'',concat(nig,' ',if(prescriptionuom='-','',prescriptionuom))),
    concat(conditionname,' ',condmanual),duration
    FROM diseasemapping_paitent AS a 
  JOIN productmaster AS b ON a.conceptid=b.`productid` AND a.conceptname='Medicine' AND a.paitientid='$PaitentId'
  left JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond 
  where  diseasemappinguniqueid ='$UniqueID'");
   
 
  ?>

        <div class="table-responsive border border-bottom-0 rounded">
            <h5 class="mb-1"> &nbsp;&nbsp;Rx.</h5>
            <table class="table m-0">
                <thead class="table-light border-top">
                    <tr>
                        <th style='font:18px' width='%'> Medicine </th>
                        <th style='font:18px' width='%'> Mor </th>
                        <th style='font:18px' width='%'> Aft </th>
                        <th style='font:18px' width='%'> Eve </th>
                        <th style='font:18px' width='%'> Nig </th>
                        <th style='font:18px' width='%'> Condition </th>
                        <th style='font:18px' width='%'> Duration </th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                while ($data = mysqli_fetch_row($result)) {
                  echo " 
                    <tr>
                        <td width='%' id='Name'>$data[0]</td>
                        <td width='%' id='ID'>$data[1]</td>
                        <td width='%' id='ID'>$data[2]</td>
                        <td width='%' id='ID'>$data[3]</td>
                        <td width='%' id='ID'>$data[4]</td>
                        <td width='%' id='ID'>$data[5]</td>
                        <td width='%' id='ID' style='text-align:center'>$data[6]</td>
                    </tr>";
                  } 
                  ?>

                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table m-0 table-borderless">
                <tbody>
                    <?php if($Therapy=='')
                    {

                    } 
                    else
                    {?>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Therapy Recomendation:</span>
                                <span><?php echo $Therapy; ?></span>
                            </p>
                        </td>
                    </tr>
                    <?php }?>


                    <?php if($AcuPoints=='')
                    {

                    } 
                    else
                    {?>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Acupunture Points:</span>
                                <span><?php echo $AcuPoints; ?></span>
                            </p>
                        </td>
                    </tr>
                    <?php }
                    ?>




                    <?php if($Pathology=='')
                    {

                    } 
                    else
                    {?>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Investigation / Tests:</span>
                                <span><?php echo $Pathology; ?></span>
                                <span><b><?php echo $PathologyRemarks; ?></b></span>
                            </p>
                        </td>

                    </tr>

                    <?php } ?>


                    <?php if($DietChart=='')
                    {

                    } 
                    else
                    {?>

                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Diet / Advice:</span>
                                <span><?php echo $DietChart; ?></span>
                            </p>
                        </td>

                    </tr>
                    <?php } ?>



                </tbody>
            </table>
        </div>


    </div>


    <!-- / Content -->

    <div style='display:none'>
        <strong>Vitals</strong><br>
        Weight(KG): <b><?php echo $Weight; ?></b> &nbsp;&nbsp;&nbsp; BP: <b><?php echo $BP; ?> mmHg</b>
        &nbsp;&nbsp; Temp (F):
        <b><?php echo $Temperature; ?></b><br>
        Height(CM): <b><?php echo $Height; ?></b> &nbsp;&nbsp;Pulse: <b><?php echo $Pulse; ?></b> &nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;
        &nbsp;&nbsp;Hair/Skin/Nail: <b><?php echo $Skin; ?></b>
    </div>

    <div class="my-1" style='display:none'>
        <h6 class="mb-1">Chief Compliants</h6>
        <p><?php echo $Symptoms; ?> </p>
    </div>

    <div class="d-flex justify-content-between mb-0">

        <div class="my-1" style='display:none'>
            <h6 class="mb-1">Diagnosis</h6>
            <p>
                <?php echo  $Diagnosis ;?>

        </div>
    </div>


</body>

</html>