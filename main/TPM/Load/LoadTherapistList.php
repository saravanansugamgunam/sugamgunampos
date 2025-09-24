 <?php
  
session_cache_limiter(FALSE);
session_start();
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y");  
     
  $ServiceID = mysqli_real_escape_string($connection, $_POST["ServiceID"]);  
  
 
  $SQLQuery =   "
  SELECT therapistid AS id,b.username AS servicename 
  FROM therapytherapistmapping AS a JOIN (
  SELECT userid,username FROM usermaster WHERE designationid IN('9' ,'8') AND activestatus ='Active') AS b 
  ON a.therapistid=b.userid  WHERE therapyid ='$ServiceID' ORDER BY 2   "; 

  $data = array();
      
  $result = mysqli_query($connection,$SQLQuery);
  
  while( $row = mysqli_fetch_array($result) ){
      $id = $row['id'];
      $servicename = $row['servicename'];
  
      $data[] = array("id" => $id, "servicename" => $servicename);
  }
 
      
  echo json_encode($data); 
  // echo $ClientID; 
  ?>