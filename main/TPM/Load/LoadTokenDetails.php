<script>
$(document).ready(function(){
  $("#txtDoctor").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#indextable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Location"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
  $LocationCode = $_SESSION['SESS_LOCATION'];
   $currenttime = date("His");  
    $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
    $TokenStatus = mysqli_real_escape_string($connection, $_POST["TokenStatus"]); 
    $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]); 
  
   
  if($Location=='All')
  {
	  $Location='%';
  }
  
  
  
  if($currenttime<140001)
  {
	  $result = mysqli_query($connection, "SELECT tokennumber,b.paitentname,
d.consultationname,
CASE c.consultationid
	WHEN 6 THEN 'New'
        WHEN 17 THEN 'New'         
        ELSE 'Followup'
	END customerType ,paitentcode, invoicenumber,tokenstatus,tokenid
 FROM tokenmaster AS a JOIN `paitentmaster` AS b ON a.`paitentcode`=b.`paitentid`
JOIN  `consultingdetails` AS c ON a.`invoicenumber`=c.`consultationuniquebill` 
JOIN `consultationmaster` AS d ON c.consultationid=d.consultationid
WHERE DATE = CURRENT_DATE and locationcode like('$Location')  and a.createdon < 140001  
and tokenstatus  IN ('$TokenStatus') and a.doctorid ='$DoctorCode' order by tokennumber ");
  }
  else
  {
	   $result = mysqli_query($connection, "SELECT tokennumber,b.paitentname,
d.consultationname,
CASE c.consultationid
	WHEN 6 THEN 'New'
        WHEN 17 THEN 'New'         
        ELSE 'Followup'
	END customerType ,paitentcode,invoicenumber,tokenstatus,tokenid
 FROM tokenmaster AS a JOIN `paitentmaster` AS b ON a.`paitentcode`=b.`paitentid`
JOIN  `consultingdetails` AS c ON a.`invoicenumber`=c.`consultationuniquebill` 
JOIN `consultationmaster` AS d ON c.consultationid=d.consultationid
WHERE DATE = CURRENT_DATE and locationcode like('$Location') and a.createdon > 140000 and tokenstatus
   IN ('$TokenStatus') and a.doctorid ='$DoctorCode' order by tokennumber ");
  }
    
 //echo "<table id='tblProject' class='tblMasters'>";
 while($data = mysqli_fetch_row($result))
{
 
 echo "<div class='col-md-3 col-sm-6'>";
 
					if( $data[3] == 'New')
					{
					echo "<div class='widget widget-stats bg-purple'>";	
					}
					else
					{
					echo "<div class='widget widget-stats bg-blue'>";	
					} 
					if($data[6]=='Open')
					{
							echo "
							<label style='float:right;color:yellow'>
							<a style='float:right;color:yellow' href='#myModalReturn'   data-toggle='modal' 
							onclick='GetTokenNo($data[7]);'>
							Change Doctor</a></label>";
					}
						echo "<div class='stats-info'>
						
							<p>Token: <b>";
							  
							echo $data[0];
							echo "</b> </p>";
							echo "<h4>";
							echo ucwords(strtolower($data[1]));
							echo "</h4>";
							echo "<h4>";
							echo ucwords(strtolower($data[2]));
							echo "</h4>";
						echo "</div>";
						
						 if($data[6]=='Open')
						{
							echo "<div class='stats-link'> 
							<a href='PaitentHistory.php?PID=$data[4]&INV=$data[5]&TID=$data[0]&S=O&MID=31' > <i class='fa fa-arrow-circle-o-right'></i> View Details (Open) </a>
						</div>";
						}
						else if($data[6]=='Completed')
						{ 
							echo "<div class='stats-link'> 
							<a href='PaitentHistory.php?PID=$data[4]&INV=$data[5]&TID=$data[0]&S=C&MID=31' ><i class='fa fa-check-circle-o'></i> View Details (Completed) </a>
						</div>";
						}
						else if($data[6]=='Cancelled')
						{
							echo "<div class='stats-link'> 
							<a href='PaitentHistory.php?PID=$data[4]&INV=$data[5]&TID=$data[0]&S=X&MID=31' ><i class='fa fa-times-circle-o'></i> View Details (Cancelled) </a>
						</div>";
						}
						
						
					echo "</div>
				</div>";
}
				  
  
    
}

?>