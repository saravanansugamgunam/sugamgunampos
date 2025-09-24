 <?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Dumy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
  
 echo "<table class='table table-fixed table-striped'   >";

 echo "  <tr><td><input type='text' name='myInput' id='myInput' class='form-control'  
 placeholder='Search...'  /></td>
 <td><a href='#' class='btn btn-primary' onclick='LoadPatient()'>Search</a></td>
 <td> 
  
 <a href='#modal-addnewpatient' data-toggle='modal'
 style='color:white' class='btn btn-xs btn-info'>
 <i class='fa fa-2x fa-plus-circle'></i></a>  
 </td>
 
 </tr>";   
echo "</table>";
 
 $result = mysqli_query($connection, "SELECT paitentid, paitentname,gender, 
 mobileno  FROM   paitentmaster order by paitentname limit 100
   ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblPatientMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='0%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>     
		<th width='0%'><a href=\"javascript:SortTable(2,'T');\">Gender</a></th>    
		<th width='0%'><a href=\"javascript:SortTable(3,'T');\">Mobile No</a></th>    
		<th width='0%'><a href=\"javascript:SortTable(5,'T');\"></a></th>       
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='PatientID'>$data[0]</td>
  <td id='Patient' width='0%'>$data[1]</td>  
  <td id='PaitentGender' width='0%'>$data[2]</td>  
  <td nowrap id='PaitentDOB' width='0%'>$data[3]</td>   
  
  <td width='0%'  onclick='LoadPaitentDetails($data[0]);' >


  <a href='#' class='btn btn-sm btn-success btn-xs' data-toggle='modal'>  
  <i class='fa fa-eye' title='View'></i></a> </td>
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>