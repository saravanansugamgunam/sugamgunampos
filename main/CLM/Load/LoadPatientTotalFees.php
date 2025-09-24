<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["EntryDate"]))
{	
  
 // echo "1";
 							  
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]); 
  $currentdate =date("Y-m-d H:i:s"); 					 
  $EntryDate = explode('/', $EntryDate); 
$EntryDate = $EntryDate[2].'-'.$EntryDate[1].'-'.$EntryDate[0];

   


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
				

$query=mysqli_query($connection,  "  
 SELECT ROUND(IFNULL(SUM(COUNT),0),0) AS TotalPatient ,ROUND(IFNULL(SUM(total),0),0) AS TotalFees  FROM patiententrydetails AS a 
JOIN  patienttypemaster AS b ON a.typeid=b.typeid
  WHERE entrydate ='$EntryDate' AND a.clientid ='$LocationCode'");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['TotalPatient'];
      $data[] = formatMoney($row['TotalFees'],false);
    
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>