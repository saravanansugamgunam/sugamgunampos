<form action="" method="post">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <?php
	// Start the buffering //
	ob_start();

	include("../../connect.php");

	session_cache_limiter(FALSE);
	session_start();
	$position = $_SESSION["SESS_LAST_NAME"];
	$LocationCode = $_SESSION['SESS_LOCATION'];

    function sanitize_my_email($field) {
        $field = filter_var($field, FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
     

    $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
    
    
    // $MobileNo ="9884589943";
    
    $PaitentName = mysqli_real_escape_string($connection, $_POST["PatientName"]); 
    $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]); 
   
   
    $res = $connection->query(" 
  
SELECT eprescriptionno FROM diseasemapping_paitent  WHERE  diseasemappinguniqueid = '$UniqueID' AND eprescriptionno IS NOT NULL LIMIT 1;"); 
	   
while($data = mysqli_fetch_row($res))
{

$ePrescriptionNo=$data[0]; 
}
 
 
     
    $Message1='Dear ';
    $Message2=', Thank you for Visiting Sugamgunam.To view your e-prescription Click : ';
    $Message3= 'https://sugamgunam.com/e-prescription/?i=';  
    $Message4= ' We would love to hear your feedback Click :';  
    $Message5= 'https://tinyurl.com/myv246da'; 
    $Message6= '&instance_id=665ADDF3AD53E&access_token=6631db3426f4c'; 
    
    $MessageOriginal =  $Message1.$PaitentName.$Message2.$Message3.$ePrescriptionNo.$Message4.$Message5;
     
    //   $InstanceID = '66331FAA3232F';
    // $AccessCode='6631db3426f4c'; 
    
  $InstanceID = '67CBE49D4241E';
  $AccessCode='67cabaed8eae1';
    
    
   // https://getleadconnector.com/api/send?.Dear+%2C+Thank+you+for+Visiting+Sugamgunam.To+view+your+e-invoice+Click+%3A+https%3A%2F%2Ftinyurl.com%2Fyc3dbn8c+We+would+love+to+hear+your+feedback+Click+%3Ahttps%3A%2F%2Ftinyurl.com%2Fmyv246da%26instance_id%3D663C91FF8C10B%26access_token%3D6631db3426f4c.
    $Message = urlencode($MessageOriginal);
    $MobileNumbers='91'.$MobileNo; 
    // $UR = "https://api.mylogin.co.in/api/v2/SendSMS?ApiKey=".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers."";
    // $ch = curl_init("https://getleadconnector.com/api/send?".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers.""); 
    //  $URL = "https://getleadconnector.com/api/send?number=".$MobileNumbers."&type=text&message=".$Message."&instance_id=".$InstanceID."&access_token=".$AccessCode."";
    
    $ch = curl_init("https://getleadconnector.com/api/send?number=".$MobileNumbers."&type=text&message=".$Message."&instance_id=".$InstanceID."&access_token=".$AccessCode.""); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch);  
        
         echo "Message Sent";
    
    // echo $URL;
    ?>