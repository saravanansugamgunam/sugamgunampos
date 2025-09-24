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

if (isset($_POST["CenterID"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $CenterID = mysqli_real_escape_string($connection, $_POST["CenterID"]);
  $ShareFor = mysqli_real_escape_string($connection, $_POST["ShareType"]);
  $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
  $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
  $Status = mysqli_real_escape_string($connection, $_POST["Status"]);
  $DoctorTherapist = mysqli_real_escape_string($connection, $_POST["DoctorTherapist"]);

  if ($Status == '0') {
    $Status = '    ';
    $StatusInventory = ' ';
  } else if ($Status == '1') {
    $Status = '   and consultationuniquebill NOT IN (SELECT billuniqueid FROM diagnosticcenterbillsharedetails)  '; 
  } else {
    $Status = '  and  consultationuniquebill  IN (SELECT billuniqueid FROM diagnosticcenterbillsharedetails)  '; 
  }

 
    $result = mysqli_query($connection, "
    SELECT diagnosisuniqueno,DATE_FORMAT(saledate,'%d-%m-%y'), c.paitentname,ROUND((nettamount),0), 
    IFNULL(d.`paidamount`,0)
    FROM diagnosissalemaster  AS a  JOIN diagnosticcentre AS b ON a.diagnosticcenter=b.centerid 
    JOIN paitentmaster AS c ON a.paitentid=c.paitentid
    LEFT JOIN diagnosticcenterbillsharedetails AS d ON a.diagnosisuniqueno=d.billuniqueid 
    WHERE saledate > '2022-08-01'    AND saledate   BETWEEN '$FromDate' AND '$ToDate'   
     AND   a.locationcode LIKE('%') 
      AND a.cancellstatus =0  and nettamount > 0 AND a.diagnosticcenter LIKE ('$CenterID')    
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
     
       <th hidden ><input type='checkbox' id='ckbCheckAll' name='ckbCheckAll'  /> Select All </th>
       
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
 
      $SerialNo = $SerialNo + 1;
    }
    echo "</tbody></table>";
  
}


?>