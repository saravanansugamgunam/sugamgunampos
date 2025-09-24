 <?php
  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php");
  $currentdate = date("Y-m-d");

  if (isset($_POST["Enquiry"])) {

    $userid = $_SESSION['SESS_MEMBER_ID'];
    $AppointmentDate = mysqli_real_escape_string($connection, $_POST["AppointmentDate"]);
    $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
    $Enquiry = mysqli_real_escape_string($connection, $_POST["Enquiry"]);
    $Name = mysqli_real_escape_string($connection, $_POST["Name"]);
    $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
    $Reference = mysqli_real_escape_string($connection, $_POST["Reference"]);
    $Stakeholder = mysqli_real_escape_string($connection, $_POST["Stakeholder"]);
    $Priority = mysqli_real_escape_string($connection, $_POST["Priority"]);
    $Pincode = mysqli_real_escape_string($connection, $_POST["Pincode"]);
    $Location = mysqli_real_escape_string($connection, $_POST["$Location"]);
  
    if ($AppointmentDate == '') {
      $AppointmentDate = $currentdate;
    } 
    $AddLead ='';
    $AddLead.= "INSERT INTO newenquirydetails (name,mobileno,enquiryid,remarks,followupdate,addedby,addeddate,reference,
    stakeholderid,priority,location,pincode) 
    VALUES ('$Name','$MobileNo','$Enquiry','$Remarks','$AppointmentDate',
    '$userid','$currentdate','$Reference','$Stakeholder','$Priority','$Location','$Pincode')";
   


    if (mysqli_multi_query($connection, $AddLead)) {

      $LeadNewID = $connection->insert_id; 

       
    $NewLeadLog= "INSERT INTO leadlog (leadid,leadlog,followupdate,leadstatus,createdby) 
    VALUES ('$LeadNewID','$Remarks','$AppointmentDate','Captured','$userid');";
  mysqli_query($connection, $NewLeadLog);
  
      echo "1";
    } else {
      echo "Error: " . $AddLead . "" . mysqli_error($connection);
    }
  } else {
    echo "0";
  }

  ?>