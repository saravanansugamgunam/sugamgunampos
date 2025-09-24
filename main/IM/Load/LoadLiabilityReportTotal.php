<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Type"]))
{	
  
 // echo "1"; 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
 $LocationCode = mysqli_real_escape_string($connection, $_POST["Location"]); 
//   $LocationCode = $_SESSION['SESS_LOCATION'];
  

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
				

// $query=mysqli_query($connection, "  
// SELECT SUM(newbalance) AS TotalBalance FROM salemaster WHERE newbalance > 0  and locationcode ='$LocationCode'
  // ");

  if($LocationCode=='All')
  {
	$LocationCode='%';
  }
  
$query = mysqli_query($connection, " 

 SELECT round(SUM(d.topay - d.receipt),0)*-1  as TotalBalance FROM  paitentmaster  as d where  d.topay < d.receipt ");
  
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
      $data[] = formatMoney($row['TotalBalance'],false);
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>