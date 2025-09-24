<script>
$(document).ready(function() {
    $("#txtCategory").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#indextable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>


<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));


  $result = mysqli_query($connection, "SELECT a.disgnosisitemid,b.diagnosisname,a.rate FROM diagnosisitems AS a JOIN disagnosismaster  AS b ON a.diagnosisid=b.id  where diagnosisuniqueid='$InvoiceNo'
 ");
  //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblCategoryMaster'   >";
  echo " <thead><tr>  
		<th>S. No</th>   
		<th hidden ><a href=\"javascript:SortTable(2,'T');\">ID</a></th>     
		<th  ><a href=\"javascript:SortTable(2,'T');\">Test Name</a></th>     
		<th  ><a href=\"javascript:SortTable(3,'T');\">Rate</a></th>     
		 
		</tr> </thead> <tbody id='ProjectTable'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td  >$SerialNo</td>
  <td hidden id='LedgerID'>$data[0]</td>
  <td id='Ledger' >$data[1]</td>  
  <td id='LedgerStatus' >$data[2]</td>   
  
  <td   onclick='DeleteTest($data[0]);' style='color:red;cursor:pointer'> <i class='fa fa-trash'></i></td>  
  
  
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}

?>