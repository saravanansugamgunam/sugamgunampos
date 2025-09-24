 <?php

  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php");
  $currentdate = date("Y-m-d");

  if (isset($_POST["PaitentCode"])) {

    // $Status=1;
    $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
    $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);


    $AddLead = "update paitentmaster  set barcode='$Barcode'  where paitentid ='$PaitentCode'";

    mysqli_query($connection, $AddLead);


    echo "1";
    // echo $AddLead;

    // echo "Sucess";

  } else {
    echo "0";
  }



  ?>