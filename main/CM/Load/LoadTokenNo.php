<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Dummy"]))
{
  
 // echo "1";
 include("../../../connect.php");  							   
   $LocationCode = $_SESSION['SESS_LOCATION'];
  $currenttime = date("His");  
    if($currenttime<140001)
  {
	  
$query=mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE =CURRENT_DATE() AND
createdon < 140001 AND tokenstatus NOT IN (5) AND locationcode ='$LocationCode'
 
 ");
  }
  else
	  
	  {
		  $query=mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE =CURRENT_DATE() AND
createdon > 140000 AND tokenstatus NOT IN (5) AND locationcode ='$LocationCode'
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