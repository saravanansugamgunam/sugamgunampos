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
     

 // $receiverNumber = '9884589943';
   $receiverNumber = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
$receiverNumber = '+91' . $receiverNumber;
    $PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]); 
    $eInvoiceNo = mysqli_real_escape_string($connection, $_POST["eInvoiceNo"]); 
   
  
     
    $Message1='Dear ';
    $Message2=', Thank you for Visiting Sugamgunam. To view your e-invoice Click : ';
    $Message3= 'https://sugamgunam.com/e-invoice/?i=';  
    $Message4= ' We would love to hear your feedback Click :';  
    $Message5= 'https://tinyurl.com/myv246da'; 
    $Message6= '                                                                                                         '; 
    $Message7= '';
    $messageContent =  $Message1.$PaitentName.$Message2.$Message3.$eInvoiceNo.$Message4.$Message5.$Message6.$Message7;
    
 
    $appkey  = '5e56a7b0-0cef-4a79-a969-95b9a653de8f';
    $authkey = 'iwtJfZjJWzIGSgSl4FOPLbi5rn9cu5iSo4vBWvgTnJAO7UNEgk';
    



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://appchatbot.com/api/create-message',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
    'appkey'   => $appkey,
    'authkey'  => $authkey,
    'to'       => $receiverNumber,
    'message'  => $messageContent,
    'sandbox'  => 'false' // Change to 'true' if testing in sandbox
  ),
));

$response = curl_exec($curl);
$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$error = curl_error($curl);
curl_close($curl);

// Handle response
if ($error) {
    echo 'cURL Error: ' . $error;
} else {
    echo "HTTP Status Code: $http_status\n";
    echo "Response:\n$response";
}


    
    
    
    ?>