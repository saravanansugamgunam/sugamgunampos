 <?php
  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php");
  $currentdate = date("Y-m-d");

  if (isset($_POST["LeadId"])) {

    $userid = $_SESSION['SESS_MEMBER_ID'];
  
    $FollowupDate = mysqli_real_escape_string($connection, $_POST["FollowupDate"]);
    $LeadStatus = mysqli_real_escape_string($connection, $_POST["LeadStatus"]);
    $FollowupRemarks = mysqli_real_escape_string($connection, $_POST["FollowupRemarks"]);
    $LeadId = mysqli_real_escape_string($connection, $_POST["LeadId"]); 
  
    if ($FollowupDate == '') {
      $FollowupDate = $currentdate;
    } 
 
    $AddLead ="";
    $AddLead.= "INSERT INTO leadlog (leadid,leadlog,followupdate,leadstatus,createdby) 
    VALUES ('$LeadId','$FollowupRemarks','$FollowupDate','$LeadStatus','$userid');";

    $AddLead.= "update newenquirydetails set leadstatus ='$LeadStatus', 
    remarks='$FollowupRemarks',followupdate='$FollowupDate' where id='$LeadId';";


    if (mysqli_multi_query($connection, $AddLead)) {

      echo "1";
    } else {
      echo "Error: " . $AddLead . "" . mysqli_error($connection);
    }
  } else {
    echo "0";
  }

  ?>