<?php
  
session_cache_limiter(FALSE);
session_start();
   include("../../../connect.php");
   
//insert.php
if(isset($_POST["Dummy"]))
{
	
	 $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);   
  
 // echo "1";
  							   
   $LocationCode = $_SESSION['SESS_LOCATION'];
  $currenttime = date("His");  
    if($currenttime<140001)
  {
	  
$query=mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE =CURRENT_DATE() AND
createdon < 140001 AND tokenstatus NOT IN ('Cancelled') and   doctorid ='$DoctorCode' AND locationcode ='$LocationCode'
 
 ");
  }
  else
	  
	  {
		  $query=mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE =CURRENT_DATE() AND
createdon > 140000 AND tokenstatus NOT IN ('Cancelled') AND doctorid ='$DoctorCode' AND locationcode ='$LocationCode'
  ");
	  }
	 // echo  " 
// SELECT IFNULL(MAX(tokennumber),1) AS  TokenNo FROM consultingbillmaster WHERE billdate =CURRENT_DATE() ";

	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['TokenNo']; 
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
  }

?>