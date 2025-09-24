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
     
    $result = mysqli_query($connection, "
    SELECT consultationid,consultationname,IFNULL(b.therapyid,0) FROM consultationmaster AS a 
LEFT JOIN ( SELECT therapyid,therapistid FROM therapytherapistmapping WHERE therapistid='$userid') AS b 
ON a.consultationid=b.therapyid
 WHERE consultingtype ='Therapy' AND activestatus ='Active' ORDER BY consultationname 


     ");

    //echo "<table id='tblProject' class='tblMasters'>";
    echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
    echo " <thead><tr>  
      <th>S. No</th>             
      <th hidden width='%'>Consultation ID</th>     
      <th width='%'>Therapy Name</th>   
       <th><input type='checkbox' id='ckbCheckAll' name='ckbCheckAll'  /> Select All </th>
       <th> </th>
       
      </tr> </thead> <tbody id='ProjectTable'>";

    $SerialNo = 1;
    while ($data = mysqli_fetch_row($result)) {
      echo "
    <tr>
    <td width='10%'>$SerialNo</td>
    <td hidden >$data[0]</td>
    <td width='%' >$data[1]</td>   ";

      if ($data[2] > 0) {
        echo "<td>Assigned</td>
        <td onclick='RemoveSelectedTherapy($userid,$data[0])'>  <a href='#' data-toggle='modal'  >
        <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>";
      } else {
        echo "<td style='cursor: pointer' >
     <input class='checkbox-round checkBoxClass'   type='checkbox'/ onclick='LoadID();'> </td>
     <td></td>";
      }


      echo "</tr>";


      //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
      //echo "<br>";
      $SerialNo = $SerialNo + 1;
    }
    echo "</tbody></table>";
  
}


?>