<?php 
 include("../../../connect.php"); 
include('header.php');
?>
<title>Sugamgunam</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" src="reorder.js"></script>
<link rel="stylesheet" href="style.css">
 
 
<div class="container">
	<h2>Drag the Token to move</h2>
	
	<div>		
		<div class="gallery">
			<ul class="reorder-gallery">
			<?php 			
			$sql_query = "SELECT tokenid, invoicenumber FROM tokenmaster WHERE DATE ='2020-10-06' ORDER BY revisedtokennumber";
			$resultset = mysqli_query($connection, $sql_query) or die("database error:". mysqli_error($connection));
			$data_records = array();
			while( $row = mysqli_fetch_assoc($resultset)) {				
			?>
				<li id="<?php echo $row['tokenid']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);"> 
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>TOTAL VISITORS</h4>
							<p>3,291,922</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				
				<?php echo $row['invoicenumber']; ?> 
				
				</a></li>
			<?php } ?>
			</ul>
		</div>
	</div>
	 		
</div> 


