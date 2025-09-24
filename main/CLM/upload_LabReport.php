<?php 
 include("../connect.php");
$upload = 'err'; 
	// $PaitentId=$_GET['PAI'];

if(!empty($_FILES['file_LabReport'])){ 

$PaitentID = mysqli_real_escape_string($connection, $_POST["txtPaitentID_LabReport"]); 
$DocumentName = mysqli_real_escape_string($connection, $_POST["txtDocumentName_LabReport"]);

if($DocumentName=="")
{
	$DocumentName='-';
}	

// echo $PaitentId;

$targetDir = "uploads/"; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
$fileName = basename($_FILES['file_LabReport']['name']); 

$fileName =  time().'_'.$fileName;
$fileName = preg_replace("/'/", '_', $fileName);
$fileName = preg_replace('/\s+/', '_', $fileName);


$targetFilePath = $targetDir.$fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
if(in_array($fileType, $allowTypes)){
if(move_uploaded_file($_FILES['file_LabReport']['tmp_name'], $targetFilePath)){ 
$upload = '1'; 
 
	$UploadImange = "insert into paitentdocumentmaster  (paitentid,documentname,documentpath,documenttype,referenceid) values 
	('$PaitentID','$DocumentName','$targetFilePath','Lab Reports',0)";    
	 mysqli_query($connection, $UploadImange);


} 
} 
} 
// echo $UploadImange; 
echo $upload; 
?>