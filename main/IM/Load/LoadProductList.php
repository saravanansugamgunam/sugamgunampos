	<script>
$(document).ready(function() {
    // $("#myInput").on("keyup", function() {
    $("#txtProductName").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        // $("#txtProductName").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
	</script>

	<?php

  session_cache_limiter(FALSE);
  session_start();


  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");

  $Category = mysqli_real_escape_string($connection, $_POST["Category"]);
  $WeightStatus = mysqli_real_escape_string($connection, $_POST["WeightStatus"]);
  $ActiveStatus = mysqli_real_escape_string($connection, $_POST["ActiveStatus"]);

  if ($Category == '') {
    $Category = '%';
  }
  if ($WeightStatus == 'Yes') {
    $WeightStatus = 'and weight > 0';
  } else if ($WeightStatus == 'No') {
    $WeightStatus = 'and weight = 0';
  } else {
    $WeightStatus = ' ';
  }

  if ($ActiveStatus == 'Active') {
    $ActiveStatus = " and status = 'Active' ";
  } else if ($ActiveStatus == 'InActive') {
    $ActiveStatus = " and status = 'In Active' ";
  } else {
    $ActiveStatus = ' ';
  }


  echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";
  $result = mysqli_query($connection, "SELECT productid, productshortcode, 
category,SUBSTRING(productname , 1, 15),gstpercentage,hsncode,weight,
status,ismrp,uniquebarcode,productname  FROM  `productmaster` AS a LEFT JOIN category AS b ON a.category = b.name
where b.name like '$Category'  $WeightStatus $ActiveStatus 
 
 ");

  //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='data-table' class='table table-striped table-bordered'>";
  echo " <thead><tr>  
		<th>S. No</th>    
		<th width='%' hidden> <a href=\"javascript:SortTable(3,'T');\"> Code</a></th>   
		<th  style='width:100px' ><a href=\"javascript:SortTable(2,'T');\">Short Code</a></th>    
		<th width='%'><a href=\"javascript:SortTable(3,'T');\">Category</a></th>    
		<th width='%'><a href=\"javascript:SortTable(5,'T');\">Product</a></th>  
		<th width='%'><a href=\"javascript:SortTable(5,'T');\">Barcode</a></th>  
		<th width='%'><a href=\"javascript:SortTable(5,'T');\">GST %</a></th>  
    <th width='%'><a href=\"javascript:SortTable(5,'T');\">HSN</a></th>  
    <th width='%'><a href=\"javascript:SortTable(5,'T');\">Weight</a></th>  
    <th width='%'><a href=\"javascript:SortTable(5,'T');\">Status</a></th>  
    <th hidden width='%'><a href=\"javascript:SortTable(5,'T');\">isMRP</a></th>  
<th></th>		
		
		  
		 
		</tr> </thead> <tbody id='myTable'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td id='ProductID' hidden> $data[0]</td>
  <td   style='width:100px' >";
    echo substr($data[1], 0, 20);
    echo "</td>  
  <td hidden id='ShortCode' width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td id='' width='%'>$data[3]...</td> 
   <td hidden id='Product' width='%'>$data[10]</td> 
   <td id='Barcode' width='%'>$data[9]</td>  
   <td id='GSTUpdatName' width='%'>$data[4]</td>     
   <td id='HSNCodeUpdateName' width='%'>$data[5]</td>";
    if ($data[6] == 0) {
      echo "<td id='Weight' width='%' style=' background-color: #f0721f;'>$data[6]</td> ";
    } else {
      echo "<td id='Weight' width='%'>$data[6]</td> ";
    }
    echo " 
   <td id='ProductStatus' width='%'>$data[7]</td>   
   <td id='isMRP' hidden width='%'>$data[8]</td> 
     <td width='%' onclick='GetRowID(this);'>
     <a href='#myModalEdit' class='btn btn-sm btn-info btn-xs' data-toggle='modal'>Edit</a></td> 
    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";



  ?>