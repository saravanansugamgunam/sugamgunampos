<style>
.checkbox-round {
    width: 1.3em;
    height: 1.3em;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid black;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
}

.checkbox-round:checked {
    background-color: gray;
}

.row {
    margin-left: -5px;
    margin-right: -5px;
}

.column {
    float: left;
    width: 50%;
    padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
    content: "";
    clear: both;
    display: table;
}
</style>

<script>
function LoadID() {
    //Assign Click event to Button. 
    var message = '';
    var Value = 0;

    //Loop through all checked CheckBoxes in GridView.
    $("#tblBillingItems input[type=checkbox]:checked").each(function() {
        var row = $(this).closest("tr")[0];
        message += "'";
        message += row.cells[1].innerHTML;
        message += "',";


    });
    var str = message;
    var ItemId = str.substring(0, str.length - 1);

    document.getElementById("txtSelectedBill").value = ItemId;
    // LoadDoctorShare();
}
</script>
<script>
$(document).ready(function() {
    $("#ckbCheckAll").click(function() {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });

    $(".checkBoxClass").change(function() {
        if (!$(this).prop("checked")) {
            $("#ckbCheckAll").prop("checked", false);
        }
    });
});
</script>
<?php

session_cache_limiter(FALSE);
session_start();

if (isset($_POST["userid"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $userid = mysqli_real_escape_string($connection, $_POST["userid"]);
  $ShareFor = mysqli_real_escape_string($connection, $_POST["ShareType"]);
  $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
  $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
  $Status = mysqli_real_escape_string($connection, $_POST["Status"]);
  $DoctorTherapist = mysqli_real_escape_string($connection, $_POST["DoctorTherapist"]);

  if ($Status == '0') {
    $Status = '    ';
    $StatusInventory = ' ';
  } else if ($Status == '1') {
    $Status = '   and consultationuniquebill NOT IN (SELECT billuniqueid FROM referencesharebilldetails)  ';
    $StatusInventory = '   and saleuniqueno NOT IN (SELECT billuniqueid FROM referencesharebilldetails)  ';
    $StatusTherapy = "   and bookingid NOT IN (SELECT billuniqueid FROM referencesharebilldetails where billtype='Therapy')  ";
  } else {
    $Status = '  and  consultationuniquebill  IN (SELECT billuniqueid FROM referencesharebilldetails)  ';
    $StatusInventory = '   and saleuniqueno NOT IN (SELECT billuniqueid FROM referencesharebilldetails)  ';
    $StatusTherapy = "  and  bookingid  IN (SELECT billuniqueid FROM referencesharebilldetails  where billtype='Therapy') ";
  }


  if ($ShareFor == 'Inventory') {
    $result = mysqli_query($connection, "
    SELECT saleuniqueno,DATE_FORMAT(saledate,'%d-%m-%y'), c.paitentname,ROUND((nettamount),0), 
    IFNULL(d.`paidamount`,0)
    FROM salemaster  AS a  JOIN usermaster AS b ON a.doctorcode=b.userid 
    JOIN paitentmaster AS c ON a.paitientcode=c.paitentid
    LEFT JOIN referencesharebilldetails AS d ON a.saleuniqueno=d.billuniqueid 
    WHERE saledate > '2022-08-01'    AND saledate   BETWEEN '$FromDate' AND '$ToDate'   
     AND   a.locationcode LIKE('%') 
      AND a.cancellstatus =0  and nettamount > 0 AND a.doctorcode LIKE ('$userid')   $StatusInventory 
   ORDER BY saledate DESC ");

    //echo "<table id='tblProject' class='tblMasters'>";
    echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
    echo " <thead><tr>  
      <th>S. No</th>     
      <th  hidden width='%'>-</th>        
      <th width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>     
      <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paitent</a></th>    
      <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total</a></th>         
      <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paid</a></th>         
     
       <th><input type='checkbox' id='ckbCheckAll' name='ckbCheckAll'  /> Select All </th>
       
      </tr> </thead> <tbody id='ProjectTable'>";

    $SerialNo = 1;
    while ($data = mysqli_fetch_row($result)) {
      echo "
    <tr>
    <td width='10%'>$SerialNo</td>
    <td  hidden  >$data[0]</td>
    <td  width='%' >$data[1]</td>  
     <td width='%'>$data[2]</td>   
     <td width='%'>$data[3]</td>              
     <td width='%'>$data[4]</td>";

      if ($data[4] > 0) {
        echo "<td>Paid</td>";
      } else {
        echo "<td style='cursor: pointer' >
     <input class='checkbox-round checkBoxClass'   type='checkbox'/ onclick='LoadID();' </td>";
      }


      echo "</tr>";


      //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
      //echo "<br>";
      $SerialNo = $SerialNo + 1;
    }
    echo "</tbody></table>";
  } else  if ($ShareFor == 'Therapy') {

    if ($DoctorTherapist == 'Doctor') {
      $result = mysqli_query($connection, "SELECT bookingid,DATE_FORMAT(reviseddate,'%d-%m-%y'),DATE_FORMAT(closingdate,'%d-%m-%y'), b.paitentname,c.`consultationname`,
      nettamount  FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
     a.paitentid = b.paitentid LEFT JOIN consultationmaster AS c ON a.therapyid = c.consultationid WHERE closingdate > '2022-08-01' 
     AND closingdate BETWEEN '$FromDate' AND '$ToDate'   AND b.referenceid LIKE ('$userid')  AND   bookingstatus ='Closed' $StatusTherapy  ");
    } else {
      $result = mysqli_query($connection, "SELECT bookingid,DATE_FORMAT(reviseddate,'%d-%m-%y'),DATE_FORMAT(closingdate,'%d-%m-%y'), b.paitentname,c.`consultationname`,
      nettamount  FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
     a.paitentid = b.paitentid LEFT JOIN consultationmaster AS c ON a.therapyid = c.consultationid WHERE closingdate > '2022-08-01' 
     AND closingdate BETWEEN '$FromDate' AND '$ToDate'   AND  b.referenceid LIKE ('$userid')  AND   bookingstatus ='Closed' $StatusTherapy  ");
    }



    //echo "<table id='tblProject' class='tblMasters'>";
    echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
    echo " <thead><tr>  
     <th>S. No</th>     
     <th  hidden width='%'>-</th>        
     <th width='%'><a href=\"javascript:SortTable(2,'T');\">Therapy Date</a></th>     
     <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Closure Date</a></th>    
     <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paitent</a></th>    
     <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Therapy Name</a></th>         
     <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Amount</a></th>         
     <th width='%' hidden> <a href=\"javascript:SortTable(3,'T');\">Paid</a></th>         
    
      <th><input type='checkbox' id='ckbCheckAll' name='ckbCheckAll'  /> Select All </th>
      
     </tr> </thead> <tbody id='ProjectTable'>";

    $SerialNo = 1;
    while ($data = mysqli_fetch_row($result)) {
      echo "
   <tr>
   <td width='10%'>$SerialNo</td>
   <td  hidden  >$data[0]</td>
   <td  width='%' >$data[1]</td>  
    <td width='%'>$data[2]</td>   
    <td width='%'>$data[3]</td>              
    <td width='%'>$data[4]</td>
    <td width='%'>$data[5]</td>";

      // if ($data[5] > 0) {
      //   echo "<td>Paid</td>";
      // } else {
      echo "<td style='cursor: pointer' >
    <input class='checkbox-round checkBoxClass'   type='checkbox'/ onclick='LoadID();' </td>";
      // }


      echo "</tr>";


      //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
      //echo "<br>";
      $SerialNo = $SerialNo + 1;
    }
    echo "</tbody></table>";
  } else  if ($ShareFor == 'Consultation') {

    $result = mysqli_query($connection, "
    SELECT consultationuniquebill,date_format(billdate,'%d-%m-%y'), c.paitentname,ROUND((totalamount)-(discountamount),0), 
    IFNULL(d.`paidamount`,0)
    FROM consultingbillmaster  AS a  JOIN usermaster as b ON a.doctorid=b.userid 
    JOIN paitentmaster AS c ON a.paitentid=c.paitentid
    LEFT JOIN referencesharebilldetails AS d ON a.consultationuniquebill=d.billuniqueid 
    WHERE billdate > '2022-08-01'  
     AND billdate   BETWEEN '$FromDate' AND '$ToDate'  AND  a.locationcode LIKE('%') 
      AND a.cancelledstatus =0  AND a.doctorid LIKE ('$userid') AND a.billtype='$ShareFor'   $Status 
   ORDER BY billdate DESC  
    ");


    //echo "<table id='tblProject' class='tblMasters'>";
    echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
    echo " <thead><tr>  
      <th>S. No</th>     
      <th  hidden width='%'>-</th>        
      <th width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>     
      <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paitent</a></th>    
      <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total</a></th>         
      <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paid</a></th>         
     
       <th><input type='checkbox' id='ckbCheckAll' name='ckbCheckAll'  /> Select All </th>
       
      </tr> </thead> <tbody id='ProjectTable'>";

    $SerialNo = 1;
    while ($data = mysqli_fetch_row($result)) {
      echo "
    <tr>
    <td width='10%'>$SerialNo</td>
    <td  hidden  >$data[0]</td>
    <td  width='%' >$data[1]</td>  
     <td width='%'>$data[2]</td>   
     <td width='%'>$data[3]</td>              
     <td width='%'>$data[4]</td>";

      if ($data[4] > 0) {
        echo "<td>Paid</td>";
      } else {
        echo "<td style='cursor: pointer' >
     <input class='checkbox-round checkBoxClass'   type='checkbox'/ onclick='LoadID();' </td>";
      }


      echo "</tr>";


      //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
      //echo "<br>";
      $SerialNo = $SerialNo + 1;
    }
    echo "</tbody></table>";
  }
}


?>