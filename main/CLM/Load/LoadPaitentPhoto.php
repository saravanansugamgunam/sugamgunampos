 <?php

  session_cache_limiter(FALSE);
  session_start();

  //insert.php
  if (isset($_POST["PaitentID"])) {
   
    // echo "1";
    include("../../../connect.php"); 

    // Get image data from database 
$result = mysqli_query($connection, "SELECT patientphoto FROM paitentmaster where paitentid ='5121'"); 
?>

 <!-- Display images with BLOB data from database -->
 <?php if($result->num_rows > 0){ ?>
 <div class="gallery">
     <?php while($row = $result->fetch_assoc()){ ?>
     <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['patientphoto']); ?>" />
     <?php } ?>
 </div>
 <?php }else{ ?>
 <p class="status error">Image(s) not found...</p>
 <?php } } ?>