<?php 
  
  include("../../connect.php");
  $result = mysqli_query($connection, "
  SELECT a.id,a.emailid,b.subject,b.message,IFNULL(path,'-') FROM bulkemailusermapping AS a JOIN bulkemail  AS b  
  ON a.messageid = b.id
  LEFT JOIN bulkemailattachment AS c ON b.uniqueid=c.uniqueid -- WHERE a.status='WIP' LIMIT 10 
   "); 
 $Sno=1;
while($data = mysqli_fetch_row($result))
{
      
    ${'id'.$Sno}= $data[0];
    ${'email'.$Sno} = $data[1];
    $subject = $data[2];
    // $file = $data[4];
    $htmlContent= $data[3];
    $Sno=$Sno+1;
} 
  


// Recipient 
// $to1 = 'saravanakumar3@gmail.com';  - From DB
 
// Sender 
$from = 'Info@Sugamgunam.com'; 
$fromName = 'Sugamgunam Health Center'; 
 
// Email subject 
// $subject = 'PHP Email with Attachment by CodexWorld';    - From DB
 
// Attachment file 
 $file = "slide1.jpg";   //- From DB
 
// Email body content 
// $htmlContent = ' 
//     <h3>PHP Email with Attachment by CodexWorld</h3> 
//     <p>This email is sent from the PHP script with attachment.</p> 
// ';   - From DB
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">"; 
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . ";\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 
 
echo $message;

// Send email 
// $mail1 = @mail($email1, $subject, $message, $headers, $returnpath);  
// $mail2 = @mail($email2, $subject, $message, $headers, $returnpath);  
// $mail3 = @mail($email3, $subject, $message, $headers, $returnpath);  
// $mail4 = @mail($email4, $subject, $message, $headers, $returnpath);  
// $mail5 = @mail($email5, $subject, $message, $headers, $returnpath);  
// $mail6 = @mail($email6, $subject, $message, $headers, $returnpath);  
// $mail7 = @mail($email7, $subject, $message, $headers, $returnpath);  
// $mail8 = @mail($email8, $subject, $message, $headers, $returnpath);  
// $mail9 = @mail($email9, $subject, $message, $headers, $returnpath);  
// $mail10 = @mail($email10, $subject, $message, $headers, $returnpath);  

$currentdate =date("Y-m-d H:i:s"); 			
$UpdateMessageStatus= "update bulkemailusermapping set status='Sent', 
mailedon='$currentdate' where id in('$id1','$id2','$id3','$id4','$id5','$id6','$id7','$id8','$id9','$id10')  ";
     
mysqli_query($connection, $UpdateMessageStatus); 

// Email sending status 
// echo $mail?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>"; 
  echo $mail1?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>"; 
 



?>