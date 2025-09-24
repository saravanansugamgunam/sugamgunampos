<style>
 .checkbox-round {
    width: 1.3em;
    height: 1.3em;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #ddd;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
}

.checkbox-round:checked {
    background-color: gray;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<script>
  function LoadMorningID() {
        //Assign Click event to Button. 
		var message='';
		var Value = 0;
 
            //Loop through all checked CheckBoxes in GridView.
            $("#tblTimeSlotDetailsMorning input[type=checkbox]:checked").each(function () {
                var row = $(this).closest("tr")[0];
			    message += "'";
                message += row.cells[1].innerHTML; 
                message += "',";
				 
				
            }); 
			var str= message;
			var ItemId = str.substring(0, str.length-1);
			 
			document.getElementById("txtMorningTimeSlotID").value = ItemId; 
         
    }

    function LoadEveningID() {
        //Assign Click event to Button. 
		var message='';
		var Value = 0;
 
            //Loop through all checked CheckBoxes in GridView.
            $("#tblTimeSlotDetailsEvening input[type=checkbox]:checked").each(function () {
                var row = $(this).closest("tr")[0];
			    message += "'";
                message += row.cells[1].innerHTML; 
                message += "',";
				 
				
            }); 
			var str= message;
			var ItemId = str.substring(0, str.length-1);
			 
			document.getElementById("txtEveningTimeSlotID").value = ItemId; 
         
    }


</script>
<?php
 
session_cache_limiter(FALSE);
session_start();
  
// echo "1";
include("../../../connect.php"); 
 $currentdate =date("Y-m-d"); 					 
 $currentdateprint =date("d-m-Y"); 
 

$TherapyDate =   mysqli_real_escape_string($connection, $_POST["TherapyDate"]);  
$Doctor =   mysqli_real_escape_string($connection, $_POST["userid"]); 

$result = mysqli_query($connection, "  SELECT a.timeslot,a.id,a.TotalPercent,   b.timeslot,b.id ,b.TotalPercent FROM 
(
SELECT a.id,a.timeslot,IFNULL(SUM(totaltime),0) AS AllotedTime, ROUND((IFNULL(SUM(totaltime),0)/60)*100,0) AS TotalPercent,
row_number() over (ORDER BY id) AS seqnum
FROM timeslotdetails AS a LEFT JOIN timeslotallocation AS b ON a.id =b.timeslotid
WHERE a.assigneddate ='$TherapyDate ' AND a.doctorid='$Doctor' AND a.starttime < 14 GROUP BY a.id,a.timeslot  ) AS a
RIGHT  JOIN

(SELECT a.id,a.timeslot,IFNULL(SUM(totaltime),0) AS AllotedTime, ROUND((IFNULL(SUM(totaltime),0)/60)*100,0) AS TotalPercent,
row_number() over (ORDER BY id) AS seqnum
FROM timeslotdetails AS a LEFT JOIN timeslotallocation AS b ON a.id =b.timeslotid
WHERE a.assigneddate ='$TherapyDate ' AND a.doctorid='$Doctor' AND a.starttime > 13 GROUP BY a.id,a.timeslot) AS b 
ON a.seqnum = b.seqnum
"); 

 
echo "<div class='row'>
  <div class='column'>";
echo "  <table id='tblTimeSlotDetailsMorning' class='table   table-condensed'>";
echo " <thead>
<tr><th colspan=3>Morning Slot</th></tr>
<tr>    
       
   <th width='%'> Slot</th>
   <th width='%'> ID</th> 
       <th width='%'> % </th>  

   </tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
 echo "
 <tr>
 
 <td> $data[0]</td>
 <td >$data[1]</td>";
 if($data[2]==0)
 {
echo "<td bgcolor='#7cd342'  width='%'    onclick='GetTimeSlotMorning(this);' style='cursor: pointer' >
<input class='checkbox-round'   type='checkbox'/ onclick='LoadMorningID();'>
Open

</td>  ";
 }
 else
 {
   
    echo "<td bgcolor='#ff8f6b' width='%'>Booked</td> ";
  }
   
    
 echo "</tr>";
  
 
 //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
 //echo "<br>";
$SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";


echo "</div>";



$result = mysqli_query($connection, "  SELECT a.timeslot,a.id,a.TotalPercent,   b.timeslot,b.id ,b.TotalPercent FROM 
(
SELECT a.id,a.timeslot,IFNULL(SUM(totaltime),0) AS AllotedTime, ROUND((IFNULL(SUM(totaltime),0)/60)*100,0) AS TotalPercent,
row_number() over (ORDER BY id) AS seqnum
FROM timeslotdetails AS a LEFT JOIN timeslotallocation AS b ON a.id =b.timeslotid
WHERE a.assigneddate ='$TherapyDate ' AND a.doctorid='$Doctor' AND a.starttime < 14 GROUP BY a.id,a.timeslot  ) AS a
RIGHT  JOIN

(SELECT a.id,a.timeslot,IFNULL(SUM(totaltime),0) AS AllotedTime, ROUND((IFNULL(SUM(totaltime),0)/60)*100,0) AS TotalPercent,
row_number() over (ORDER BY id) AS seqnum
FROM timeslotdetails AS a LEFT JOIN timeslotallocation AS b ON a.id =b.timeslotid
WHERE a.assigneddate ='$TherapyDate ' AND a.doctorid='$Doctor' AND a.starttime > 13 GROUP BY a.id,a.timeslot) AS b 
ON a.seqnum = b.seqnum
"); 

echo "<div class='column'>";

echo "  <table id='tblTimeSlotDetailsEvening' class='table   table-condensed'>";
echo " <thead> 
<tr><th colspan=3>Evening Slot</th></tr>
<tr>   
   <th width='%'> Slot</th>
   <th width='%'> ID</th> 
       <th width='%'> % </th>  

   </tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
 echo "
 <tr>
  
  <td width='%'>$data[3]</td>          
  <td width='%'>$data[4]</td>";
  if($data[5]==0)
  {
 echo "<td  bgcolor='#7cd342' onclick='GetTimeSlotEvening(this);' style='cursor: pointer' width='%'>
 <input class='checkbox-round'   type='checkbox'/ onclick='LoadEveningID();'>
 Open</td> ";
  }
  else
  {
    
     echo "<td bgcolor='#ff8f6b' width='%'>Booked</td> ";
   }
   
              
  
   
 echo "</tr>";
  
 
 //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
 //echo "<br>";
$SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";



echo "</div></div>";     

 

?>

 