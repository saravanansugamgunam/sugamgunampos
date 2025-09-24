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
   $LocationCode = $_SESSION['SESS_LOCATION'];
  

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
  
$query = mysqli_query($connection, " 

 SELECT ROUND(SUM( topay -  paid),0) as TotalBalance FROM  
 supliers  
  WHERE   (topay -  paid)> 1 ");
  
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
      $data[] = formatMoney(round($row['TotalBalance']),false);
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>