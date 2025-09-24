<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
 
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 // $Courier = mysqli_real_escape_string($connection, strtoupper($_POST["Courier"]));    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   $qty = 10000;
  try {
	  
	  $mysql_qry ="SELECT max(incrementid) as incrementid FROM lopptable ";
		
		$res = mysqli_query($connection,$mysql_qry);
		
		$id = 0;
		
		
		while($row = mysqli_fetch_array($res)){
			
				$id = $row['incrementid'];
				
		};
		
  
  $values = array();
for ($x=0; $x<$qty; $x++){
	$values[] = "('sara','$id')";
	$id=$id+1;
	}

$sql = "INSERT INTO lopptable (name,incrementid) VALUES";
$sql .= implode(",",$values);
echo "$sql";
 
 mysqli_query($connection, $sql); 


   
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
    

?>