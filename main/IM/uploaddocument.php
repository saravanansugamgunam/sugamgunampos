<?php 
 include("../connect.php");
 
$ClientID = 1;//$_SESSION['SESS_LOCATION']; 
$UserID = 1; //$_SESSION['SESS_SMS_UserID'] ; 
$upload = 'err'; 
	// $PaitentId=$_GET['PAI'];

if(!empty($_FILES['file'])){ 

$DocumentReferenceNo = mysqli_real_escape_string($connection, $_POST["txtGRNNumber"]); 
$DocumentName = mysqli_real_escape_string($connection, $_POST["txtDocumentName"]);


if($DocumentName=="")
{
	$DocumentName='-';
}	

// echo $PaitentId;

$targetDir = "uploaddocuments/"; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
$fileName = basename($_FILES['file']['name']); 

$fileName =  time().'_'.$fileName;
$fileName = preg_replace("/'/", '_', $fileName);
$fileName = preg_replace('/\s+/', '_', $fileName);


$targetFilePath = $targetDir.$fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

if(in_array($fileType, $allowTypes)){
 
if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
  $upload = '1'; 
 
	$UploadImange = "insert into documentmaster  (documentname,documentfor,documentreference,documentpath,
	addedby) value 
	('$DocumentName','Purchase','$DocumentReferenceNo','$targetFilePath','$UserID')";    
	 mysqli_query($connection, $UploadImange); 

} 
} 
} 
// echo $UploadImange; 
echo $UploadImange; 
?>