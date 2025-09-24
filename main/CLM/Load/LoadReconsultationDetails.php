<script>
$(document).ready(function() {
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
if (isset($_POST["Location"])) {

	// echo "1";
	include("../../../connect.php");
	$currentdate = date("Y-m-d");
	$LocationCode = $_SESSION['SESS_LOCATION'];
	$currenttime = date("His");
	$Location = mysqli_real_escape_string($connection, $_POST["Location"]);
	$TokenStatus = mysqli_real_escape_string($connection, $_POST["TokenStatus"]);
	$DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);


	if ($Location == 'All') {
		$Location = '%';
	}

	if ($TokenStatus == 'Open') {
		$ReconsultationStatus = '0';
	}
	else
	{
		$ReconsultationStatus = '1';
	}


	$result = mysqli_query($connection, " 
	SELECT DATE_FORMAT(f.bookingdate,'%d-%m-%Y') BookintDate ,
	DATE_FORMAT(reviseddate,'%d-%m-%Y') AS reviseddate,
	c.username AS Therapist, 
	IFNULL(d.timeslot,'Open'), b.consultationname, 
	 g.`paitentname` AS Paitent,g.gender,
	 TIMESTAMPDIFF(YEAR,g.dob, CURRENT_DATE()) AS Age,   
	a.bookingstatus,IF(a.bookingstatus='Closed',DATE_FORMAT(a.closingdate,'%d-%m-%Y'),'') AS Closingdate,
	h.Balance,timevalue,a.paitentid,CONCAT('9',a.bookinguniqueid),a.bookingid
	FROM therapybookingdetails AS a 
	JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
	JOIN usermaster AS c ON a.doctorid=c.userid 
	LEFT JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot,c.timevalue FROM timeslotallocation AS a 
	LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id  
	LEFT JOIN timeslotlist AS c ON timeslot = c.timedescription
	GROUP BY bookingitemid ) AS d ON  a.bookingid =d.bookingitemid 
	
	JOIN usermaster AS e ON a.referedbydoctorid=e.userid   
	   JOIN therapybookingmaster AS f ON a.bookinguniqueid = f.bookinguniqueid
	  JOIN paitentmaster AS g ON a.paitentid=g.paitentid
	  
	  JOIN ( SELECT invoicegrn,SUM(debitamount) AS TotalFee,SUM(creditamount) AS Received,
	  SUM(debitamount)-SUM(creditamount) AS Balance FROM transactionledger  
	  GROUP BY invoicegrn) AS h ON h.invoicegrn=f.bookinguniqueid
	
	  where a.`reviseddate` between '$currentdate' and '$currentdate' and
	  a.doctorid like ('$DoctorCode') and a.bookingstatus not in ('Cancelled') and
	    reconsultationstatus ='$ReconsultationStatus'
	
	GROUP BY a.bookingid,a.therapyid,b.consultationname,reviseddate,c.username, a.rate,a.discount,a.nettamount ,d.timeslot,
	e.username,a.bookingstatus,a.closingdate
	ORDER BY reviseddate ,timevalue,a.paitentid,CONCAT('9',a.bookinguniqueid),a.bookingid");

 

	//echo "<table id='tblProject' class='tblMasters'>";
	while ($data = mysqli_fetch_row($result)) { 

		
		echo "<div class='col-md-3 col-sm-6'>";
		echo "<div class='widget widget-stats bg-green'>";
 
 
		echo "<div class='stats-info'>
						
							<p style='font-size:20px'>  <b>"; 
		echo $data[5];
		echo "</b> </p>";  

		echo "<p style='font-size:13px'>  <b>"; 
		echo $data[6];
		echo "(";
		echo $data[7];
		echo ")";
		echo "</b> </p>";

		echo " 
		<a style='float:left;color:#c1da48'   href='#' >
        <i style='float:right;color:#c1da48' onclick='SaveReconsultationClosure($data[14]);'
		 class='fa fa-2x fa-check-circle-o'></i></a>";
		
		echo "<br><br><p style='font-size:15px'>";

		echo ucwords(strtolower($data[4]));
 
		echo "</p>";
 

		echo "<h4>";
		echo ucwords(strtolower($data[2]));

		echo "</h4>";

		echo "</div>";

	 

			echo "<div class='stats-link'> 
			 <a href='ConsultingView.php?PID=$data[12]&INV=$data[13]&TID=0&S=O&MID=31' > ";
		 
			echo "<i class='fa fa-arrow-circle-o-right'>
							
							</i> View Details (Open) </a>
							
						</div>";
		 


		echo "</div>
				</div>";
	}
}

?>