
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
 $Mobileno = mysqli_real_escape_string($connection, $_POST["MobileNo"]); 
 $Name = mysqli_real_escape_string($connection, $_POST["PaitentName"]); 
 $Outstanding = mysqli_real_escape_string($connection, $_POST["OutstandingAmount"]); 

// $to = 'saravanakumar3@gmail.com';

$subject = "Outstanding Remainder";
$htmlContent ="Dear ".$Name.","."<br>"."&nbsp;&nbsp;&nbsp;Your Outstanding Amount is"."<b>".$Outstanding."</b>".". Kindly pay it as soon as possible."."<br>"."Regards,"."<br>"." Sugamgunam"."<br>"." +91 91766 06308";
 

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
// echo $htmlContent;
  
?>