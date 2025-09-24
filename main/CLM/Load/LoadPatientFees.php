<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["PatientType"]))
{	
  
 // echo "1";
 							  
 $PatientType = mysqli_real_escape_string($connection, $_POST["PatientType"]); 
 
   


function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				

$query=mysqli_query($connection, "SELECT(SELECT ROUND(IFNULL(SUM(fees),0),0)  AS Fee  FROM patienttypemaster WHERE typeid='$PatientType'    ) AS Fee;");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
       $data[] = $row['Fee'];
    
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>