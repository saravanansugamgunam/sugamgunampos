<?php 
 include("../connect.php");
if (isset($_FILES['file']['name'])) {
	$targetDir = "uploads/"; 
			$fileName = basename($_FILES['file']['name']); 
			$fileNameforDB =basename($_FILES['file']['name']); 
			$fileName =  time().'_'.$fileName;
			$fileName = preg_replace("/'/", '_', $fileName);
			$fileName = preg_replace('/\s+/', '_', $fileName);
			$targetFilePath = $targetDir.$fileName;

			//$DocumentName=$_GET['d'];
			  $DocumentName = mysqli_real_escape_string($connection, $_POST["txtDocumentName"]);
			  $UserID = mysqli_real_escape_string($connection, $_POST["txtEmployeeCode"]);

	if (0 < $_FILES['file']['error']) {
		echo '<span style="color:red;">Error during file upload ' . $_FILES['file']['error'] . '</span>';
	} else {
		  
			move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);
			echo '<span style="color:green;">File successfully uploaded to uploads/' . $_FILES['file']['name'] . '</span>';

			
	$UploadImange = "insert into hrdocumentmaster (employeecode,documentname,documentpath) values 
	('$UserID','$DocumentName','$targetFilePath')";    
	 mysqli_query($connection, $UploadImange);

		 
	}
} else {
	echo '<span style="color:red;">Please choose a file</span>';
}
echo nl2br("\n");
?>