
<?php 	 
  
session_cache_limiter(FALSE);
session_start();
 include("../connect.php"); 
 if(isset($_POST["base64image"]))
{
	
$img = $_POST['base64image'];

$PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);     
 $userid = mysqli_real_escape_string($connection, $_POST["userid"]);   
 
 
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file ='PrescriptionImages/'.time().'image.png';
$success = file_put_contents($file, $data);

$SavePrescription = "insert into prescriptionmaster (paitentid,doctorid,prescription,documentlink ) values 
	('$PaitentID','$userid','-','$file');"; 
	
 mysqli_query($connection, $SavePrescription); 

//$b64 =$data;
///$bin = base64_encode($b64); 
$img_file = 'PrescriptionImages/filename.png';

echo $SavePrescription;

 // imagepng($img_file, 0);
}
 
?>