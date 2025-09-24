
<?php 	 
$img = $_POST['base64image'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file ='tmp/'.time().'image.png';
$success = file_put_contents($file, $data);


//$b64 =$data;
///$bin = base64_encode($b64); 
$img_file = 'tmp/filename.png';
 // imagepng($img_file, 0);
 
?>