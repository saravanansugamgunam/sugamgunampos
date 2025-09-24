  <?php

  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php"); 
  $currentdate =date("Y-m-d");  
  $currentdatetime = date("Y-m-d H:i:s");
  $currenttime = date("His"); 
  $userid = $_SESSION['SESS_MEMBER_ID'];

  if(isset($_POST["ReviewID"]))
  {  

  $Remarks = mysqli_real_escape_string($connection,$_POST["Remarks"]);  
  $Status = mysqli_real_escape_string($connection,$_POST["Status"]);  
  $ReviewID = mysqli_real_escape_string($connection,$_POST["ReviewID"]);  

  $AddReview = "update customerreviewdetails set status='$Status', reviewdate='$currentdate', remarks='$Remarks' where id='$ReviewID' "; 

  if (mysqli_multi_query($connection, $AddReview)) {
  echo "1";
  } else {
  echo "Error: " . $AddReview . "" . mysqli_error($connection);
  } 
  }
  else
  {
  echo "0";
  }


  ?> 