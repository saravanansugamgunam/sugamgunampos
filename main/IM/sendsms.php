 <?php
 
 include("../connect.php");
 session_cache_limiter(FALSE);
 session_start();

 $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);
 $TotalSaleAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);
 $BalanceAmount = mysqli_real_escape_string($connection, $_POST["BalanceAmount"]);
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
 $PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]); 

 
 $Message1='Dear ';
 $Message2=', thanks for buying at Sugamgunam! Your bill amount is Rs. ';
 $Message3= $TotalSaleAmount.' Your outstanding is Rs.'.$BalanceAmount;
 $Message4='. Please call 9488228603 for queries.'; 

 $MessageOriginal =  $Message1.$PaitentName.$Message2.$Message3.$Message4;
 
 // Dear {#var#}, thanks for buying at Sugamgunam! Your bill amount is Rs. {#var#}. Please call {#var#} for queries.


$SenderId='SUGAMT';
$ApiKey='95M55QkhjOsEGr5hqBU4NJNCbSBexhqX+bBXdDp1YIY=';
$ClientId='570924ec-f1ec-4df5-b217-d3d5a0f9eaa6';

 
$Message = urlencode($MessageOriginal);
$MobileNumbers='91'.$MobileNo; 
// $UR = "https://api.mylogin.co.in/api/v2/SendSMS?ApiKey=".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers."";

$ch = curl_init("https://api.mylogin.co.in/api/v2/SendSMS?ApiKey=".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers.""); 
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);      
    curl_close($ch);  

 // echo $UR;
?>