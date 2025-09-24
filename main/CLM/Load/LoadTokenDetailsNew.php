<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $("#txtDoctor").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tblTokenList tr").filter(function() {
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
	$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
	 $Session =   mysqli_real_escape_string($connection, $_POST["Session"]);

   if($Session=='Evening')
   {
	$SessionTime = ' and a.createdon > 140000 ';
   }
   else
   {
	$SessionTime = ' and a.createdon < 140001 ';  
   }

	if ($Location == 'All') {
		$Location = '%';
	} 



	if($Type=='Consultation'){
		$result = mysqli_query($connection, "SELECT paitentcode, invoicenumber,tokenstatus,tokenid,onlinetokenflag, 
		a.createdon,a.doctorchangeflag,
		tokennumber,CONCAT(b.paitentname,' (',b.`mobileno`,')','<br>',b.gender,'<br>', 
				CONCAT
        (
            FLOOR((TIMESTAMPDIFF(MONTH, b.dob, CURDATE()) / 12)), ' Yrs ',
            MOD(TIMESTAMPDIFF(MONTH, b.dob, CURDATE()), 12) , ' Mth'
        ) 
		), e.username,
		d.consultationname,a.patientarivalstatus, IF(b.`patientphoto`='-','uploads/noimg.png',b.`patientphoto`) AS e
		 FROM tokenmaster AS a JOIN `paitentmaster` AS b ON a.`paitentcode`=b.`paitentid`
		JOIN  `consultingdetails` AS c ON a.`invoicenumber`=c.`consultationuniquebill` 
		JOIN `consultationmaster` AS d ON c.consultationid=d.consultationid
		JOIN usermaster AS e ON e.userid=a.doctorid
		WHERE DATE = CURRENT_DATE   and locationcode like('$Location')  
and tokenstatus  IN ('$TokenStatus') and a.doctorid ='$DoctorCode' $SessionTime order by tokennumber ");

echo "<input class='form-control' type='text' id='txtDoctor' name='txtDoctor' placeholder='Search...' ><br>";

echo "  <table id='tblTokenList' class='table table-bordered'>";
echo " <thead><tr>  
<th>S.No</th>           
<th  width='%'></th>    
<th  width='%'> Name</a></th>    
<th   width='%'>Doctor</th>   
<th   width='%'>Consultation</th>   
<th   width='%'>Patient Status</th>   
<th   width='%'>Call Token</th> 
<th   width='%'>Status</th>  
</tr></thead>";  
$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
	echo " <tr> <td width='%'> $SerialNo </td> ";
	echo "<td>   <img src='$data[12]' width='120'> 

                       
						</td>";
// 	if($data[5]== '150000' || $data[5] == '100000')
// 		{
// 			echo " <td width='%'> <i style=' color:#727cb6' class='fa fa-3x fa-laptop'></i> </td>"; 
// 		} else  
// 		{
// 			echo " <td width='%'> <i style=' color:#348fe2' class='fa fa-3x fa-male'></i> </td>"; 
// 		}

		if($Type=='Consultation'){
			if($data[2]=='Completed')
			{
				echo " <td> <label style=' font-size: 20px;color: blue;'>
				<a href='ConsultingView.php?PID=$data[0]&INV=$data[1]&TID=$data[7]&S=C&MID=31' >
				<i class='fa fa-book '></i> Token No: $data[7] </a></label>
				 <br>
				$data[8]</td>";
		
			}
			else
			{
				echo " <td> <label style=' font-size: 20px;color: blue;'>
				<a href='ConsultingView.php?PID=$data[0]&INV=$data[1]&TID=$data[7]&S=O&MID=31' >
				<i class='fa fa-book '></i> Token No: $data[7] </a></label>
				 <br>
				$data[8]</td>";
		
			}
			

		}

		if ($data[6]=='1'){
			echo "<td bgcolor='#f59c1a'>$data[9] <br><br><a style='float:left;color:blue' href='#myModalReturn'   data-toggle='modal' 
			onclick='GetTokenNo($data[3],$data[1]);'>
			Change Doctor</a>
			</td>";
		}
			else
		{

		echo "<td >$data[9] <br><br><a style='float:left;color:blue' href='#myModalReturn'   data-toggle='modal' 
		onclick='GetTokenNo($data[3],$data[1]);'>
		Change Doctor</a>
		</td>";
		}


		echo "<td>$data[10]</td>";

		if ($data[2]=='Open')
		{
			if ($data[11] == '1') {
			echo "<td >
					<a href='#modalConfirmPatientINtime'   data-toggle='modal' 
					onclick='GetTokenNo($data[3],$data[1]);'>	
					 <i style=' color:lightgreen'  class='fa fa-3x fa-circle'></i></a>
	  </td>";  }
				else {
					echo "<td >
					<a href='#modalConfirmPatientINtime'   data-toggle='modal' 
					onclick='GetTokenNo($data[3],$data[1]);'>	<i style=' color:orange'  class='fa fa-3x fa-circle'></i></a>
	  </td>"; }
		} else if($data[2]=='Completed')
		{if ($data[11] == '1') {
			echo "<td > <i style=' color:lightgreen' class='fa fa-3x fa-circle'></i> </td>";
		}
		else
		{
			echo "<td > <i style=' color:orange' class='fa fa-3x fa-circle'></i> </td>";

		}
		} else if($data[2]=='Cancelled')
		{
			if ($data[11] == '1') {
				echo "<td > <i style=' color:lightgreen' class='fa fa-3x fa-circle'></i> </td>";
			}
			else
			{
				echo "<td > <i style=' color:orange' class='fa fa-3x fa-circle'></i> </td>";
	
			}
		}

		if($data[2]=='Open')
		{
echo "<td  onclick='PlaySound($data[7]);'><a style=' color:yellow'   href='#'  >
        <i style=' color:orange'  class='fa fa-3x fa-bullhorn'></i></a></td>";
		echo "<td><a style=' color:#c1da48'   href='#' >
        <i style=' color:#c1da48' onclick='SaveConsultingClosure($data[0],$data[1],$data[7],$data[3]);' class='fa fa-3x fa-check-circle-o'></i></a>
		</td>";
	
		}
		else if($data[2]=='Completed')
		{
			echo "<td >
			<i style=' color:orange'  class='fa fa-3x fa-bullhorn'></i></td>";
			echo "<td>
			
			Completed</td>";
		}
		else if($data[2]=='Cancelled')
		{
			echo "<td >
			<i style=' color:orange'  class='fa fa-3x fa-bullhorn'></i></td>";
			echo "<td>Cancelled</td>";
		}

		echo " <tr> ";
		$SerialNo = $SerialNo + 1;
}
echo "</table>";
} 
else 
if($Type=='ReConsultation'){
 
	if($TokenStatus=='Open')
	{
		$TokenStatus = '0';
	} else if($TokenStatus=='Completed')
	{
		$TokenStatus = '1';
	}
	else if($TokenStatus=='Cancelled')
	{
		$TokenStatus = '3';
	}

 
$result = mysqli_query($connection, "SELECT a.paitentid,
CONCAT('9',a.bookinguniqueid),a.bookingstatus,a.bookingid,'2' AS Onlineflag,
0 Createdon,0 Doctorchangeflag,
0 TokenNumber,CONCAT(g.paitentname,' (',g.`mobileno`,')','<br>',g.gender,'<br>', 
				CONCAT(
            FLOOR((TIMESTAMPDIFF(MONTH, g.dob, CURDATE()) / 12)), ' Yrs ',
            MOD(TIMESTAMPDIFF(MONTH, g.dob, CURDATE()), 12) , ' Mth') 
		) AS Paitent,
c.username AS Therapist, b.consultationname,a.patientarivalstatus,a.reconsultationstatus, 

IF(g.`patientphoto`='-','uploads/noimg.png',g.`patientphoto`) AS e
 
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
  JOIN usermaster AS i ON a.reconsultationby=i.userid   

  WHERE a.`reviseddate` =CURRENT_DATE AND a.bookingstatus NOT IN ('Cancelled') and reconsultationstatus in('$TokenStatus')  
and a.bookingstatus like ('%') 
GROUP BY a.bookingid,a.therapyid,b.consultationname,reviseddate,c.username, a.rate,a.discount,a.nettamount ,d.timeslot,
e.username,a.bookingstatus,a.closingdate
ORDER BY patientarivalstatus desc, patientarivaltime  ");


echo "<input class='form-control' type='text' id='txtDoctor' name='txtDoctor' placeholder='Search...' ><br>";

echo "  <table id='tblTokenList' class='table table-bordered'>";
echo " <thead><tr>  
<th>S.No</th>          
<th  width='%'></th>     
<th  width='%'> Name</a></th>    
<th   width='%'>Therapist</th>   
<th   width='%'>Therapy</th>   
<th   width='%'>Patient Status</th>   
<th   width='%'>Call Reconsulting Patient</th> 
<th   width='%'>Status</th>  
</tr></thead>";  
$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
	echo " <tr> <td width='%'> $SerialNo </td> ";
		echo "<td>   <img src='$data[13]' width='120'>  </td>"; 
	echo " <td> <label style=' font-size: 20px;color: blue;'>
	<a href='ConsultingView.php?PID=$data[0]&INV=$data[1]&TID=$data[3]&S=R&MID=31' >
	<i class='fa fa-book '></i>  Reconsultation </a></label>
	 <br>
	$data[8]</td>";
	echo "<td >$data[9]  
		</td>
			<td>$data[10]</td>";

			if ($data[11] == '0') {
				echo "<td >
				
				<a href='#modalConfirmPatientINtime_therapy'   data-toggle='modal' 
	onclick='GetTokenNo($data[3],$data[1]);'>	<i style=' color:orange'  class='fa fa-3x fa-circle'></i></a>
 
				</td>"; }
				else {

					echo "<td >
				
				 <i style=' color:lightgreen'  class='fa fa-3x fa-circle'></i></a>
 
				</td>";
					 
		}
					 

	  echo "<td  onclick='PlaySound($data[7]);'><a style=' color:yellow'   href='#'  >
        <i style=' color:orange'  class='fa fa-3x fa-bullhorn'></i></a></td>";
		if($data[12]=='0')
		{
			echo "<td>
			<a style=' color:#c1da48'   href='#' >
			<i style=' color:#c1da48' onclick='SaveConsultingClosure($data[0],$data[1],$data[7],$data[3]);' class='fa fa-3x fa-check-circle-o'></i></a>
			</td>";
 
		}
		else if($data[12]=='1')
		{
			echo "<td> 
			  Completed
			</td>";
		}
	
		echo " <tr> ";
		$SerialNo = $SerialNo + 1;
}
}



else if($Type=='Diagnosis'){

	if($TokenStatus=='Open')
	{
		$TokenStatus = " in ('0','1')";
		$CancelledStatus = '0';
		$Closuredate = "   ";
	} else if($TokenStatus=='Completed')
	{
		$TokenStatus = " in ('2')";
		$CancelledStatus = '0';
		$Closuredate = " and reconsultingdate = '$currentdate' ";

	}
	else if($TokenStatus=='Cancelled')
	{
		$TokenStatus = " in('0','1','2')";
		$CancelledStatus = '1';
		$Closuredate = " and reconsultingdate = '$currentdate' ";


	}

	$result = mysqli_query($connection, "
 SELECT a.paitentid,a.diagnosisuniqueno,'Booked',a.id,0,0,0,0, 
CONCAT(c.paitentname,' (',c.mobileno,')','<br>',c.gender,'<br>',CONCAT(
FLOOR((TIMESTAMPDIFF(MONTH, c.dob, CURDATE()) / 12)), ' Yrs ',
MOD(TIMESTAMPDIFF(MONTH, c.dob, CURDATE()), 12) , ' Mth') 
) AS Paitent,b.centername,'-',a.reconsultingstatus
FROM diagnosissalemaster AS a JOIN 
diagnosticcentre AS b ON a.diagnosticcenter=b.centerid 
JOIN paitentmaster AS c ON a.paitentid=c.paitentid WHERE
reconsultingstatus $TokenStatus AND a.cancellstatus='$CancelledStatus' $Closuredate
order by a.reconsultingstatus desc");


	 echo "<input class='form-control' type='text' id='txtDoctor' name='txtDoctor' placeholder='Search...' ><br>";

echo "  <table id='tblTokenList' class='table table-bordered'>";
echo " <thead><tr>  
<th>S.No</th>          
<th  width='%'></th>    
<th  width='%'> Name</a></th>    
<th   width='%'>Center</th>    
<th   width='%'>Report Status</th>   
<th   width='%'>Call Diagnosis Patient</th> 
<th   width='%'>Complete</th>  
</tr></thead>";  
$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
	echo " <tr> <td width='%'> $SerialNo </td> ";
	echo " <td width='%'> <i style=' color:green' class='fa fa-3x fa-flask	'></i> </td>"; 
	echo " <td> <label style=' font-size: 20px;color: blue;'>
		<a href='ConsultingView.php?PID=$data[0]&INV=$data[1]&TID=$data[7]&S=O&MID=31' >
	<i class='fa fa-book '></i>  Diagnosis </a></label>
	 <br>
	$data[8]</td>
	<td>$data[9]</td> 
	";
	if ($data[11] == '1' || $data[11] == '2') {
		echo "<td > <i style=' color:lightgreen'  class='fa fa-3x fa-circle'></i>

		</td>"; }
		else {
			echo "<td > <i style=' color:orange'  class='fa fa-3x fa-circle'></i></td>";

			}

	echo "<td  onclick='PlaySound($data[1]);'><a style=' color:yellow'   href='#'  >
        <i style=' color:orange'  class='fa fa-3x fa-bullhorn'></i></a></td>";
		if ($data[11] == '1') {
		echo "<td><a style=' color:#c1da48'   href='#' >
        <i style=' color:#c1da48' onclick='SaveConsultingClosure($data[0],$data[1],$data[7],$data[3]);' class='fa fa-3x fa-check-circle-o'></i></a>
			</td>";
		} if ($data[11] == '0') {
		 
			echo "<td>Report Pending</td>";
		} else if ($data[11] == '2') {
		 
			echo "<td>Completed</td>";
		}
		echo " <tr> ";

}

echo "</table>";
}
 
	
}  
 

?>