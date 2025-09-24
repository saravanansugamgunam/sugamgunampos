<?php 
 include("../connect.php");
$upload = 'err'; 
	// $PaitentId=$_GET['PAI'];

if(!empty($_FILES['file'])){ 

$UniqueID = mysqli_real_escape_string($connection, $_POST["txtUniqueID"]); 
 
	$DocumentName='-'; 

// echo $PaitentId;

$targetDir = "../../files/"; 
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

$targetDirforDB = "files/"; 
$targetFilePathforDB = $targetDirforDB.$fileName;
	$UploadImange = "insert into bulkemailattachment  (uniqueid,path) values 
	('$UniqueID','$targetFilePathforDB')";    
	 mysqli_query($connection, $UploadImange);


} 
} 
} 
// echo $UploadImange; 
echo $upload; 
?>