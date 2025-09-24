<?php
// the message
session_cache_limiter(FALSE);
session_start();
   include("../connect.php"); 
  if(isset($_POST["DoctorName"]))
{
 $DoctorName = mysqli_real_escape_string($connection, ($_POST["DoctorName"]));   
  $mobileno = mysqli_real_escape_string($connection, ($_POST["mobileno"]));   
   $DoctorEmail = mysqli_real_escape_string($connection, ($_POST["DoctorEmail"]));
   $PaitentName = mysqli_real_escape_string($connection, ($_POST["PaitentName"]));
   $TherapyDate = mysqli_real_escape_string($connection, ($_POST["TherapyDate"]));
   $TherapyTime = mysqli_real_escape_string($connection, ($_POST["TherapyTime"]));
  
  $length = strrpos($TherapyDate," ");
$newDate = explode( "-" , substr($TherapyDate,$length));
$TherapyDateNew = $newDate[2]."/".$newDate[1]."/".$newDate[0];


 $headers = "From: Sugamgunam";
 $msg = "Hi ".$DoctorName. ", Therapy is booked on ".$TherapyDateNew. " at ".$TherapyTime.", to ".$PaitentName  ;
 
 
 // use wordwrap() if lines are longer than 70 characters
// $msg = wordwrap($msg,70);
 
// send email
 mail($DoctorEmail,"Therapy Confirmation",$msg,$headers);
// mail("saravanakumar3@gmail.com","Therapy Confirmation",$msg,$headers);
}
else
	
	{
		echo "NO";
	}
?>