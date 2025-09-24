<?php
 include("../../connect.php");
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];



$StudentCode = mysqli_real_escape_string($connection, strtoupper($_POST["txtStudentCode"]));
$ImageFileName = $StudentCode.".jpg";

  

$targetPath = "StudentImages/".time().'_'.$_FILES['userImage']['name'];
$targetPath = preg_replace("/'/", '_', $targetPath);
$targetPath = preg_replace('/\s+/', '_', $targetPath);
 
  
if(move_uploaded_file($sourcePath,$targetPath)) {
	
		$UploadImange = "update studentmaster  set studentimagepath ='$targetPath' 
						where studentcode='$StudentCode' ;";    
						mysqli_query($connection, $UploadImange);

  echo "Image Added";
?>
<!-- <img class="image-preview" src="< echo $targetPath; ?>" class="upload-preview" /> -->



<?php
}
}
}
?>