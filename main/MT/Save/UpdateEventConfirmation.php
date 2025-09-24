 <?php
  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php");
  $currentdate = date("Y-m-d");

  if (isset($_POST["Paitentid"])) {

    $userid = $_SESSION['SESS_MEMBER_ID'];
    $Paitentid = mysqli_real_escape_string($connection, $_POST["Paitentid"]); 



    $AddLead = "update campdata set attended ='1' where id='$Paitentid' ";

    if (mysqli_query($connection, $AddLead)) {

      echo "1";
    } else {
      echo "Error: " . $AddLead . "" . mysqli_error($connection);
    }
  } else {
    echo "0";
  }

  ?>