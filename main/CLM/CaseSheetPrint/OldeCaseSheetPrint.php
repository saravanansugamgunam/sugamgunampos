<?php

include("../../connect.php");
// $position=$_SESSION["SESS_LAST_NAME"]; 
session_cache_limiter(FALSE);
session_start();

$PaitentId = $_GET['P'];
$UniqueID = $_GET['UID'];
$P1 = $_GET['P1'];
$P2 = $_GET['P2'];
$P3 = $_GET['P3'];
$P4 = $_GET['P4'];
$P5 = $_GET['P5'];
$P6 = $_GET['P6']; 

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


$res = $connection->query(" 
  

      SELECT DATE_FORMAT(a.billdate,'%d %M %Y') AS BillDate, b.paitentname, b.mobileno, 
      LEFT(b.`gender`,1) AS Gender,TIMESTAMPDIFF(YEAR,b.`dob`, CURRENT_DATE()) AS Age,
      IFNULL(d.bp,'-') AS BP,IFNULL(d.height,'-') AS Height,IFNULL(d.weight,'-') AS Weight,
      IFNULL(d.pulse,'-' ) AS Pulse,IFNULL(d.temperature,'-') AS Temp,IFNULL(d.shn,'-') AS Skin,
      IFNULL(d.diet,'-') AS Diet,
      
      
      (SELECT  GROUP_CONCAT(symptoms  ORDER BY symptoms ASC) 
      FROM diseasemapping_paitent AS a 
      JOIN symptomsmaster AS b ON a.conceptid=b.symptomsid AND a.conceptname='Symptoms' AND a.paitientid='$PaitentId'
      WHERE  diseasemappinguniqueid ='$UniqueID') AS Symptoms,


      (  SELECT  GROUP_CONCAT(diagnosis ,'<br>' ORDER BY diagnosis ASC) 
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


      (SELECT GROUP_CONCAT(consultationname  ORDER BY consultationname ASC) 
      FROM diseasemapping_paitent AS a 
      JOIN consultationmaster AS b ON a.conceptid=b.consultationid AND a.conceptname='Therapy' AND a.paitientid='$PaitentId'
      WHERE  diseasemappinguniqueid ='$UniqueID'
      GROUP BY paitientid,consultingdate) AS Therapy,


      (SELECT GROUP_CONCAT(pathology  ORDER BY pathology ASC) 
      FROM diseasemapping_paitent AS a 
      JOIN pathologymaster AS b ON a.conceptid=b.pathologyid AND a.conceptname='Pathology' AND a.paitientid='$PaitentId'
      WHERE  diseasemappinguniqueid ='$UniqueID' ) AS Test


      FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
      JOIN usermaster AS c ON a.doctorid = c.userid 
      LEFT JOIN casehistory AS d ON a.consultationuniquebill= d.consultinguniqueid  
      WHERE consultationuniquebill ='$UniqueID';"); 

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

    <link rel="stylesheet" href="./CaseSheetPrint_files/app-invoice-print.css">

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <link rel="stylesheet" type="text/css" href="./CaseSheetPrint_files/core.css" class="template-customizer-core-css">


</head>

<body>


    <div class="invoice-print p-6">

        <div class="d-flex justify-content-between flex-row">
            <div class="mb-1">
                <div class="d-flex svg-illustration align-items-center gap-1 mb-1">
                    <span class="app-brand-logo demo">
                        <img src='newlogo.png' width=100% height='50px' />
                    </span>
                </div>

                <p class="mb-0">AP 393,17th Street, Thiruvalluvar Kudiyirippu</p>
                <p class="mb-0">I Block, Anna Nagar, Chennai - 600040</p>
                <p class="mb-0">+91 9176606308, +91 9488228603 </p>
                <p class="mb-0">info@sugamgunam.com, www.sugamgunam.com</p>
            </div>
            <div>
                <br>
                <br>
                <h4 class="mb-1">Prof. S.Raja Sheik Peer</h4>
                <span>MD., BNYS. DSMS. B.Ed.Acu, D.Acu</span>
                <p>Reg.No. MCA/2022/12/H/0029/2</p>

                <div>
                </div>
            </div>
        </div>

        <hr class="mb-1">

        <div class="d-flex justify-content-between mb-1">
            <div class="my-1">
                <h6><?php echo $PaitientName; ?> (<?php echo $Gender; ?>) / <?php echo $Age; ?> Y <br>
                    Mob No: <?php echo $MobileNo; ?></h6>

                <strong>Vitals</strong><br>
                Weight(KG): <b><?php echo $Weight; ?></b> &nbsp;&nbsp;&nbsp; BP: <b><?php echo $BP; ?> mmHg</b>
                &nbsp;&nbsp; Temp (F):
                <b><?php echo $Temperature; ?></b><br>
                Height(CM): <b><?php echo $Height; ?></b> &nbsp;&nbsp;Pulse: <b><?php echo $Pulse; ?></b> &nbsp;&nbsp;
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                &nbsp;&nbsp; &nbsp;&nbsp;
                &nbsp;&nbsp;Hair/Skin/Nail: <b><?php echo $Skin; ?></b>

            </div>
            <div class="my-1">
                <h6 style="float:right"><b>Date: <?php echo $InvoiceDate; ?></b></h6>

            </div>
        </div>
        <hr class="mb-1">
        <div class="d-flex justify-content-between mb-0">
            <div class="my-1">
                <h6 class="mb-1">Chief Compliants</h6>
                <p><?php echo $Symptoms; ?> </p>
            </div>
            <div class="my-1">
                <h6 class="mb-1">Diagnosis</h6>
                <p>
                    <?php echo str_replace(",", "",$Diagnosis);?>

            </div>
        </div>

        <?php   
  $result = mysqli_query($connection, "  SELECT productshortcode,
  mor,aft,eve,nig,conditionname,duration
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
                        <th width='%'> Medicine </th>
                        <th width='%'> Mor </th>
                        <th width='%'> Aft </th>
                        <th width='%'> Eve </th>
                        <th width='%'> Nig </th>
                        <th width='%'> Condition </th>
                        <th width='%'> Duration (Days) </th>

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
                        <td width='%' id='ID' style='text-align:center'>$data[6] Days</td>
                    </tr>";
                  } 
                  ?>

                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table m-0 table-borderless">
                <tbody>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Therapy Recomendation:</span>
                                <span><?php echo $Therapy; ?></span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Acupunture Points:</span>
                                <span><?php echo $AcuPoints; ?></span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Investigation / Tests:</span>
                                <span><?php echo $Pathology; ?></span>
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td class="align-top px-2 py-2">
                            <p class="mb-1">
                                <span class="me-1 fw-medium">Advice:</span>
                                <span><?php echo $DietChart; ?></span>
                            </p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="mt-0 mb-6">

    </div>


    <!-- / Content -->






    <div id="template-customizer" class="bg-card" style="visibility: visible"> <a href="javascript:void(0)"
            class="template-customizer-open-btn" tabindex="-1"></a>
        <div class="p-6 m-0 lh-1 border-bottom template-customizer-header position-relative py-4">
            <h6 class="template-customizer-t-panel_header mb-2">Template Customizer</h6>
            <p class="template-customizer-t-panel_sub_header mb-0 small">Customize and preview in real time</p>
            <div class="d-flex align-items-center gap-2 position-absolute end-0 top-0 mt-6 me-5"> <a
                    href="javascript:void(0)" class="template-customizer-reset-btn text-body" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" title="Reset Customizer"><i class="ri-refresh-line ri-20px"></i><span
                        class="badge rounded-pill bg-danger badge-dot badge-notifications"></span></a> <a
                    href="javascript:void(0)" class="template-customizer-close-btn fw-light text-body" tabindex="-1"> <i
                        class="ri-close-line ri-24px"></i> </a> </div>
        </div>
        <div class="template-customizer-inner pt-6">
            <div class="template-customizer-theming">
                <h5 class="m-0 px-5 py-6"> <span
                        class="template-customizer-t-theming_header bg-label-primary rounded-2 py-1 px-3 small">Theming</span>
                </h5>
                <div class="m-0 px-5 pb-6 template-customizer-style w-100"> <label for="customizerStyle"
                        class="form-label d-block template-customizer-t-style_label">Style (Mode)</label>
                    <div class="row px-1 template-customizer-styles-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="customRadioIconlight">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/light.svg" alt="Light"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="customRadioIcon" class="form-check-input d-none" type="radio"
                                        value="light" id="customRadioIconlight" checked="checked">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="customRadioIconlight">Light</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="customRadioIcondark">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/dark.svg" alt="Dark"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="customRadioIcon" class="form-check-input d-none" type="radio"
                                        value="dark" id="customRadioIcondark">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="customRadioIcondark">Dark</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="customRadioIconsystem">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/system.svg" alt="System"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="customRadioIcon" class="form-check-input d-none" type="radio"
                                        value="system" id="customRadioIconsystem">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="customRadioIconsystem">System</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-5 template-customizer-themes w-100"> <label for="customizerTheme"
                        class="form-label template-customizer-t-theme_label">Themes</label>
                    <div class="row px-1 template-customizer-themes-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0"
                                    for="themeRadiostheme-default">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/default.svg" alt="Default"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="themeRadios" class="form-check-input d-none" type="radio"
                                        value="theme-default" id="themeRadiostheme-default" checked="checked">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="themeRadiostheme-default">Default</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0"
                                    for="themeRadiostheme-bordered">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/border.svg" alt="Bordered"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="themeRadios" class="form-check-input d-none" type="radio"
                                        value="theme-bordered" id="themeRadiostheme-bordered">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="themeRadiostheme-bordered">Bordered</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0"
                                    for="themeRadiostheme-semi-dark">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/semi-dark.svg" alt="Semi Dark"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="themeRadios" class="form-check-input d-none" type="radio"
                                        value="theme-semi-dark" id="themeRadiostheme-semi-dark">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="themeRadiostheme-semi-dark">Semi
                                Dark</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="template-customizer-layout">
                <hr class="m-0 px-5 my-6">
                <h5 class="m-0 px-5 pb-6"> <span
                        class="template-customizer-t-layout_header bg-label-primary rounded-2 py-1 px-3 small">Layout</span>
                </h5>
                <div class="m-0 px-5 pb-6 d-block template-customizer-layouts"> <label for="customizerStyle"
                        class="form-label d-block template-customizer-t-layout_label">Menu (Navigation)</label>
                    <div class="row px-1 template-customizer-layouts-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="layoutsRadiosexpanded">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/expanded.svg" alt="Expanded"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="layoutsRadios" class="form-check-input d-none" type="radio"
                                        value="expanded" id="layoutsRadiosexpanded">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="layoutsRadiosexpanded">Expanded</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="layoutsRadioscollapsed">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/collapsed.svg" alt="Collapsed"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="layoutsRadios" class="form-check-input d-none" type="radio"
                                        value="collapsed" id="layoutsRadioscollapsed" checked="checked">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="layoutsRadioscollapsed">Collapsed</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-5 pb-6 template-customizer-layoutNavbarOptions w-100"> <label for="customizerNavbar"
                        class="form-label template-customizer-t-layout_navbar_label">Navbar Type</label>
                    <div class="row px-1 template-customizer-navbar-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0"
                                    for="navbarOptionRadiossticky">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/sticky.svg" alt="Sticky"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="navbarOptionRadios" class="form-check-input d-none" type="radio"
                                        value="sticky" id="navbarOptionRadiossticky">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="navbarOptionRadiossticky">Sticky</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0"
                                    for="navbarOptionRadiosstatic">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/static.svg" alt="Static"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="navbarOptionRadios" class="form-check-input d-none" type="radio"
                                        value="static" id="navbarOptionRadiosstatic">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="navbarOptionRadiosstatic">Static</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0"
                                    for="navbarOptionRadioshidden">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/hidden.svg" alt="Hidden"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="navbarOptionRadios" class="form-check-input d-none" type="radio"
                                        value="hidden" id="navbarOptionRadioshidden" checked="checked">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="navbarOptionRadioshidden">Hidden</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-5 pb-6 template-customizer-content w-100"> <label for="customizerContent"
                        class="form-label template-customizer-t-content_label">Content</label>
                    <div class="row px-1 template-customizer-content-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="contentRadioIconcompact">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/compact.svg" alt="Compact"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="contentRadioIcon" class="form-check-input d-none" type="radio"
                                        value="compact" id="contentRadioIconcompact" checked="checked">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap"
                                for="contentRadioIconcompact">Compact</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="contentRadioIconwide">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/wide.svg" alt="Wide"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="contentRadioIcon" class="form-check-input d-none" type="radio"
                                        value="wide" id="contentRadioIconwide">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="contentRadioIconwide">Wide</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-5 pb-6 template-customizer-directions w-100"> <label for="customizerDirection"
                        class="form-label template-customizer-t-direction_label">Direction</label>
                    <div class="row px-1 template-customizer-directions-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="directionRadioIconltr">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/ltr.svg" alt="Left to Right (En)"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="directionRadioIcon" class="form-check-input d-none" type="radio"
                                        value="ltr" id="directionRadioIconltr" checked="checked">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="directionRadioIconltr">Left to Right
                                (En)</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content p-0" for="directionRadioIconrtl">
                                    <span class="custom-option-body mb-0">
                                        <img src="./CaseSheetPrint_files/rtl.svg" alt="Right to Left (Ar)"
                                            class="img-fluid scaleX-n1-rtl">
                                    </span>
                                    <input name="directionRadioIcon" class="form-check-input d-none" type="radio"
                                        value="rtl" id="directionRadioIconrtl">
                                </label>
                            </div>
                            <label class="form-check-label small text-nowrap" for="directionRadioIconrtl">Right to Left
                                (Ar)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>