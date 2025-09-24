
<?php 
include("../../connect.php");

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

 $to = mysqli_real_escape_string($connection, $_POST["EmaiID"]); 

// $to = 'saravanakumar3@gmail.com';
$subject = "Medicine Invoice";

$htmlContent = file_get_contents("Bill.html");
 

// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: SugamGunam<info@sugamgunam.com>' . "\r\n";

// echo $to;

// Send email
if(mail($to,$subject,$htmlContent,$headers)):
    $Msg = 'Email has sent successfully.';
else:
    $Msg = 'Email sending fail.';
endif;
echo $Msg;
  
?>