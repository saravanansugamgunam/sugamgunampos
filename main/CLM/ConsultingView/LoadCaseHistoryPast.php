<?php
  include("../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();



  // echo "1";
  if (isset($_POST["PaitentID"])) {


    $currentdate = date("Y-m-d H:i:s");

    $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);
    $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

    $result = mysqli_query($connection, "
SELECT b.username,DATE_FORMAT(consultingdate,'%d-%m-%y') AS consultingdatee,height,weight,pulse,bp,temperature,shn,
chiefcompliant,presentillness,pastillness,
    disgnosis,rx,diet,testsrequired,medicineid,consultinguniqueid,consultingdate,createdby,a.id 
 FROM casehistory AS a JOIN usermaster AS b ON a.createdby=b.userid WHERE paitentid ='$PaitentID'  
 order by consultingdate desc
  
"); 

    while ($data = mysqli_fetch_row($result))
      {
        
        echo " <strong> Date: $data[1] <br>By: $data[0]</strong>  ";
      echo "  
     <div > 

        <button class='btn btn-success btn-xs' href='#modelPreviousCaseSheet' data-toggle='modal'
                                    onclick='LoadPreviousCaseSheetReport($data[16])'> View
                                </button>


 
 
      <button class='btn btn-primary btn-xs' onclick='LoadFromPreviousVisit($data[16])' >Load
      </button> 
       <button class='btn btn-warning btn-xs' onclick='SendPrescription($data[16])' style='float:right' >Share
     
     </button> 
</div><hr>";
  }
}
  ?>