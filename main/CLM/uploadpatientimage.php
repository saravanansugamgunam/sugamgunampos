<?php 	 
$img = $_POST['base64image'];
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
// $file ='uploads/'.time().'image.jpeg';
$file =$_POST['finalfilename'];
$success = file_put_contents($file, $data);


//$b64 =$data;
///$bin = base64_encode($b64); 
$img_file = 'uploads/filename.jpeg';
 // imagepng($img_file, 0);
 
?>