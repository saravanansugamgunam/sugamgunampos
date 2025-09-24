<?php
  
session_cache_limiter(FALSE);
session_start();
 
if(isset($_POST["DoctorCode"]))
{
   
     
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);
 
$query=mysqli_query($connection, " 
SELECT 
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Sunday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day1,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Monday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day2,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Tuesday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day3,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Wednesday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day4,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Thursday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day5,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Friday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day6,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Saturday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Day7, 
 
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Sunday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token1,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Monday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token2,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Tuesday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token3,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Wednesday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token4,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Thursday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token5,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Friday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token6,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Saturday' AND sessionid='1' AND doctorcode ='$DoctorCode') AS S1Token7,
 
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Sunday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day1,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Monday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day2,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Tuesday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day3,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Wednesday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day4,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Thursday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day5,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Friday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day6,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Saturday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Day7, 
 
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Sunday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token1,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Monday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token2,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Tuesday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token3,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Wednesday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token4,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Thursday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token5,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Friday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token6,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Saturday' AND sessionid='2' AND doctorcode ='$DoctorCode') AS S2Token7,
 
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Sunday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day1,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Monday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day2,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Tuesday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day3,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Wednesday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day4,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Thursday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day5,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Friday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day6,
 (SELECT DAYNAME FROM onlineschedule WHERE DAYNAME='Saturday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Day7, 
 
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Sunday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token1,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Monday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token2,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Tuesday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token3,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Wednesday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token4,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Thursday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token5,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Friday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token6,
 (SELECT totaltoken FROM onlineschedule WHERE DAYNAME='Saturday' AND sessionid='3' AND doctorcode ='$DoctorCode') AS S3Token7
  ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
       $data[] = $row['S1Day1']; 
       $data[] = $row['S1Day2']; 
       $data[] = $row['S1Day3']; 
       $data[] = $row['S1Day4']; 
       $data[] = $row['S1Day5']; 
       $data[] = $row['S1Day6']; 
       $data[] = $row['S1Day7']; 

       $data[] = $row['S1Token1']; 
       $data[] = $row['S1Token2']; 
       $data[] = $row['S1Token3']; 
       $data[] = $row['S1Token4']; 
       $data[] = $row['S1Token5']; 
       $data[] = $row['S1Token6']; 
       $data[] = $row['S1Token7']; 

       $data[] = $row['S2Day1']; 
       $data[] = $row['S2Day2']; 
       $data[] = $row['S2Day3']; 
       $data[] = $row['S2Day4']; 
       $data[] = $row['S2Day5']; 
       $data[] = $row['S2Day6']; 
       $data[] = $row['S2Day7']; 

       $data[] = $row['S2Token1']; 
       $data[] = $row['S2Token2']; 
       $data[] = $row['S2Token3']; 
       $data[] = $row['S2Token4']; 
       $data[] = $row['S2Token5']; 
       $data[] = $row['S2Token6']; 
       $data[] = $row['S2Token7']; 

       $data[] = $row['S3Day1']; 
       $data[] = $row['S3Day2']; 
       $data[] = $row['S3Day3']; 
       $data[] = $row['S3Day4']; 
       $data[] = $row['S3Day5']; 
       $data[] = $row['S3Day6']; 
       $data[] = $row['S3Day7']; 

       $data[] = $row['S3Token1']; 
       $data[] = $row['S3Token2']; 
       $data[] = $row['S3Token3']; 
       $data[] = $row['S3Token4']; 
       $data[] = $row['S3Token5']; 
       $data[] = $row['S3Token6']; 
       $data[] = $row['S3Token7']; 
        
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>