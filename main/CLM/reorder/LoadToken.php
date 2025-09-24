<?php 		 
include("../../../connect.php"); 
			echo "<div class='gallery'>
			<ul class='reorder-gallery'>";
			
			$sql_query = "SELECT tokenid, paitentname,tokennumber FROM tokenmaster AS a JOIN paitentmaster AS b ON a.paitentcode = b.paitentid  WHERE DATE ='2020-10-06' ORDER BY revisedtokennumber";
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
						 
					</div>
				 
				 
				 </li>
			<?php } ?>
			</ul></div>