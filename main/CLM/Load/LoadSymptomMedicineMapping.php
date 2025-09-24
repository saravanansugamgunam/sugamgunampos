 <?php
  include("../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();



  // echo "1";

  $currentdate = date("Y-m-d H:i:s");
  $SymptomID = mysqli_real_escape_string($connection, $_POST["SymptomID"]); 

  $result = mysqli_query($connection, "  SELECT symptommedicinemappingid,CONCAT(productshortcode,'-',productname) AS product
  FROM symptomsmedicinemapping AS a JOIN productmaster AS b ON a.medicineid=b.productid
  WHERE a.symptomid='$SymptomID' order by productshortcode ");

  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  
 
  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
  echo " <thead><tr>  
		<th  width='%'>S.No</th>      
		<th width='%'> Medicine </th>      
		<th width='%'>  Delete </th>      
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='%'>$SerialNo</td> 
  <td width='%' id='Name' >$data[1]</td>      
   <td width='%'>
   <a href='#'  onclick='DeleteMedicine($data[0]);' class='btn btn-sm btn-danger btn-xs' >Delete</a></td>    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
  ?>