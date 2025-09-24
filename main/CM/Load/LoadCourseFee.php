<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CourseCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CourseCode = mysqli_real_escape_string($connection, $_POST["CourseCode"]);     
   $sqli = "select coursefee from coursemaster where coursecode ='$CourseCode'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                            
                             echo  $row['coursefee'];
                              }	
    
}

?>