<?php 
 include("../../../connect.php"); 
 
?>
<title>Sugamgunam</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" src="reorder.js"></script>
<link rel="stylesheet" href="style.css">
 <style>
 .box {
  background: #F9F6F6;
  border: 1px solid #ECECEC;
  border-radius: 6px;
  width: 220px;
  height: 150px;
  padding: 9px;
  position: relative;
}
 </style>
 <br>
 <button onclick="window.location.href='index.php?ID=1&DR=Hr.Raja'">Hr. Raja</button>
 <button onclick="window.location.href='index.php?ID=2&DR=Hr.Sheba'">Hr. Sheba</button>
 
<div class="container">
	<h4>Drag the token to change the order</h4>
	<?php $DoctorID=$_GET['ID'];?>
	<?php $DoctorName=$_GET['DR'];
	$currenttime = date("His"); ?>
	<div>		
		<div class="gallery">
			<ul class="reorder-gallery">
			<?php
if($currenttime<140001)
{
	$sql_query = "SELECT tokenid, paitentname,tokennumber FROM tokenmaster AS a JOIN paitentmaster AS b ON a.paitentcode = b.paitentid  WHERE DATE =CURRENT_DATE()  and tokenstatus = 'Open' and
				doctorid ='$DoctorID' AND createdon < 140001  ORDER BY revisedtokennumber";
}
else
{
	$sql_query = "SELECT tokenid, paitentname,tokennumber FROM tokenmaster AS a JOIN paitentmaster AS b ON a.paitentcode = b.paitentid  WHERE DATE =CURRENT_DATE() and tokenstatus = 'Open' and 
				doctorid ='$DoctorID' AND createdon > 140000  ORDER BY revisedtokennumber";
}	
			
			$resultset = mysqli_query($connection, $sql_query) or die("database error:". mysqli_error($connection));
			$data_records = array();
			while( $row = mysqli_fetch_assoc($resultset)) {				
			?>
				<li id="<?php echo $row['tokenid']; ?>" class="ui-sortable-handle"> 
					<div class="box">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>Tonken: <?php echo $row['tokennumber'];?> </h4>
							<p><?php echo $row['paitentname'];?> </p>	
						</div>
						<hr>
						 <?php echo $DoctorName; ?>
					</div>
				 
				 
				 </li>
			<?php } ?>
			</ul>
		</div>
	</div>
	 		
</div> 


