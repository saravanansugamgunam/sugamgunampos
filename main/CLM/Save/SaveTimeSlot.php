<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DoctorCode"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");   

  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);      
 
  
  $SlotActive1ID1 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID1"]);      
  $SlotActive1ID2 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID2"]);      
  $SlotActive1ID3 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID3"]);      
  $SlotActive1ID4 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID4"]);      
  $SlotActive1ID5 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID5"]);      
  $SlotActive1ID6 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID6"]);      
  $SlotActive1ID7 = mysqli_real_escape_string($connection, $_POST["SlotActive1ID7"]);      
  $TotalToken1D1 = mysqli_real_escape_string($connection, $_POST["TotalToken1D1"]);      
  $TotalToken1D2 = mysqli_real_escape_string($connection, $_POST["TotalToken1D2"]);      
  $TotalToken1D3 = mysqli_real_escape_string($connection, $_POST["TotalToken1D3"]);      
  $TotalToken1D4 = mysqli_real_escape_string($connection, $_POST["TotalToken1D4"]);      
  $TotalToken1D5 = mysqli_real_escape_string($connection, $_POST["TotalToken1D5"]);      
  $TotalToken1D6 = mysqli_real_escape_string($connection, $_POST["TotalToken1D6"]);      
  $TotalToken1D7 = mysqli_real_escape_string($connection, $_POST["TotalToken1D7"]);    
 
  $SlotActive2ID1 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID1"]);      
  $SlotActive2ID2 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID2"]);      
  $SlotActive2ID3 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID3"]);      
  $SlotActive2ID4 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID4"]);      
  $SlotActive2ID5 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID5"]);      
  $SlotActive2ID6 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID6"]);      
  $SlotActive2ID7 = mysqli_real_escape_string($connection, $_POST["SlotActive2ID7"]);      
  $TotalToken2D1 = mysqli_real_escape_string($connection, $_POST["TotalToken2D1"]);      
  $TotalToken2D2 = mysqli_real_escape_string($connection, $_POST["TotalToken2D2"]);      
  $TotalToken2D3 = mysqli_real_escape_string($connection, $_POST["TotalToken2D3"]);      
  $TotalToken2D4 = mysqli_real_escape_string($connection, $_POST["TotalToken2D4"]);      
  $TotalToken2D5 = mysqli_real_escape_string($connection, $_POST["TotalToken2D5"]);      
  $TotalToken2D6 = mysqli_real_escape_string($connection, $_POST["TotalToken2D6"]);      
  $TotalToken2D7 = mysqli_real_escape_string($connection, $_POST["TotalToken2D7"]);    
 
  $SlotActive3ID1 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID1"]);      
  $SlotActive3ID2 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID2"]);      
  $SlotActive3ID3 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID3"]);      
  $SlotActive3ID4 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID4"]);      
  $SlotActive3ID5 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID5"]);      
  $SlotActive3ID6 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID6"]);      
  $SlotActive3ID7 = mysqli_real_escape_string($connection, $_POST["SlotActive3ID7"]);      
  $TotalToken3D1 = mysqli_real_escape_string($connection, $_POST["TotalToken3D1"]);      
  $TotalToken3D2 = mysqli_real_escape_string($connection, $_POST["TotalToken3D2"]);      
  $TotalToken3D3 = mysqli_real_escape_string($connection, $_POST["TotalToken3D3"]);      
  $TotalToken3D4 = mysqli_real_escape_string($connection, $_POST["TotalToken3D4"]);      
  $TotalToken3D5 = mysqli_real_escape_string($connection, $_POST["TotalToken3D5"]);      
  $TotalToken3D6 = mysqli_real_escape_string($connection, $_POST["TotalToken3D6"]);      
  $TotalToken3D7 = mysqli_real_escape_string($connection, $_POST["TotalToken3D7"]);    
 
  try {  
   $SaveSaleMaster='';  
   $SaveSaleMaster.= "delete from onlineschedule where doctorcode='$DoctorCode';"; 

   if($SlotActive1ID1=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Sunday','1','$TotalToken1D1');"; 
   }
   if($SlotActive1ID2=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Monday','1','$TotalToken1D2');"; 
   }
   if($SlotActive1ID3=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Tuesday','1','$TotalToken1D3');"; 
   }
   if($SlotActive1ID4=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Wednesday','1','$TotalToken1D4');"; 
   }
   if($SlotActive1ID5=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Thursday','1','$TotalToken1D5');"; 
   }
   if($SlotActive1ID6=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Friday','1','$TotalToken1D6');"; 
   }
   if($SlotActive1ID7=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Saturday','1','$TotalToken1D7');"; 
   }



   
   if($SlotActive2ID1=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Sunday','2','$TotalToken2D1');"; 
   }
   if($SlotActive2ID2=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Monday','2','$TotalToken2D2');"; 
   }
   if($SlotActive2ID3=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Tuesday','2','$TotalToken2D3');"; 
   }
   if($SlotActive2ID4=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Wednesday','2','$TotalToken2D4');"; 
   }
   if($SlotActive2ID5=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Thursday','2','$TotalToken2D5');"; 
   }
   if($SlotActive2ID6=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Friday','2','$TotalToken2D6');"; 
   }
   if($SlotActive2ID7=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Saturday','2','$TotalToken2D7');"; 
   }



   
   if($SlotActive3ID1=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Sunday','3','$TotalToken3D1');"; 
   }
   if($SlotActive3ID2=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Monday','3','$TotalToken3D2');"; 
   }
   if($SlotActive3ID3=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Tuesday','3','$TotalToken3D3');"; 
   }
   if($SlotActive3ID4=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Wednesday','3','$TotalToken3D4');"; 
   }
   if($SlotActive3ID5=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Thursday','3','$TotalToken3D5');"; 
   }
   if($SlotActive3ID6=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Friday','3','$TotalToken3D6');"; 
   }
   if($SlotActive3ID7=='Yes')
   {
      $SaveSaleMaster.= "insert into onlineschedule (doctorcode,dayname,sessionid,totaltoken) values 
      ('$DoctorCode','Saturday','3','$TotalToken3D7');"; 
   }


 
   if (mysqli_multi_query($connection, $SaveSaleMaster)) {
         echo "1"; 
   } else {
      echo "Error: " . $SaveSaleMaster . "" . mysqli_error($connection);
   }  

     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>