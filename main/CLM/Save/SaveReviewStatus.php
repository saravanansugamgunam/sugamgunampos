  <?php

  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php"); 
  $currentdate =date("Y-m-d");  
  $currentdatetime = date("Y-m-d H:i:s");
  $currenttime = date("His"); 
  $userid = $_SESSION['SESS_MEMBER_ID'];

  if(isset($_POST["PaitentID"]))
  {  

  $PaitentID = mysqli_real_escape_string($connection,$_POST["PaitentID"]);  

  $AddReview = "insert into customerreviewdetails (patientid,reviewiniatedate,reviewdate,createdby,remarks)
  values ('$PaitentID','$currentdate','$currentdate','$userid','-')"; 

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