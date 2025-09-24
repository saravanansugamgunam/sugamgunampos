 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


 <script>
// function myFunction() {
// var input, filter, table, tr, td, i, txtValue;
// input = document.getElementById("txtItemSearch");
// filter = input.value.toLowerCase();
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// alert(1);
// }

// $(document).ready(function(){
// $("#txtItemSearch").on("keyup", function() {
// var value = $(this).val().toLowerCase();
// alert(2);
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// });
 </script>

 <style>
table,
th,
td {
    border: 1px solid #e7e9eb;
    border-collapse: collapse;
    padding: 3px;
}
 </style>

 <?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php");  
 
 $Staff = mysqli_real_escape_string($connection, $_POST["Staff"]); 
 $Month = mysqli_real_escape_string($connection, $_POST["Month"]);
 $CurrentDateNumber = date("d");
 $currentdate = date("Y-m-d");

//  $FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
//  $ToPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
 
   $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod = date('Y-m-t', strtotime($currentdate));
  

//  $FromPeriod = date('Y-m-d');
//  $ToPeriod = date('Y-m-d');
  
 
 $result = mysqli_query($connection, " 
 select taskname, 
MAX(CASE WHEN DateNumber = '1' THEN Completed END) '1',
MAX(CASE WHEN DateNumber = '2' THEN Completed END) '2',
MAX(CASE WHEN DateNumber = '3' THEN Completed END) '3',
MAX(CASE WHEN DateNumber = '4' THEN Completed END) '4',
MAX(CASE WHEN DateNumber = '5' THEN Completed END) '5',
MAX(CASE WHEN DateNumber = '6' THEN Completed END) '6',
MAX(CASE WHEN DateNumber = '7' THEN Completed END) '7',
MAX(CASE WHEN DateNumber = '8' THEN Completed END) '8',
MAX(CASE WHEN DateNumber = '9' THEN Completed END) '9',
MAX(CASE WHEN DateNumber = '10' THEN Completed END) '10',
MAX(CASE WHEN DateNumber = '11' THEN Completed END) '11', 
MAX(CASE WHEN DateNumber = '12' THEN Completed END) '12',
MAX(CASE WHEN DateNumber = '13' THEN Completed END) '13', 
MAX(CASE WHEN DateNumber = '14' THEN Completed END) '14', 
MAX(CASE WHEN DateNumber = '15' THEN Completed END) '15', 
MAX(CASE WHEN DateNumber = '16' THEN Completed END) '16', 
MAX(CASE WHEN DateNumber = '17' THEN Completed END) '17', 
MAX(CASE WHEN DateNumber = '18' THEN Completed END) '18', 
MAX(CASE WHEN DateNumber = '19' THEN Completed END) '19', 
MAX(CASE WHEN DateNumber = '20' THEN Completed END) '20', 

MAX(CASE WHEN DateNumber = '21' THEN Completed END) '21',
MAX(CASE WHEN DateNumber = '22' THEN Completed END) '22', 
MAX(CASE WHEN DateNumber = '23' THEN Completed END) '23', 
MAX(CASE WHEN DateNumber = '24' THEN Completed END) '24', 
MAX(CASE WHEN DateNumber = '25' THEN Completed END) '25', 
MAX(CASE WHEN DateNumber = '26' THEN Completed END) '26', 
MAX(CASE WHEN DateNumber = '27' THEN Completed END) '27', 
MAX(CASE WHEN DateNumber = '28' THEN Completed END) '28', 
MAX(CASE WHEN DateNumber = '29' THEN Completed END) '29', 
MAX(CASE WHEN DateNumber = '30' THEN Completed END) '30',  
MAX(CASE WHEN DateNumber = '31' THEN Completed END) '31'

                  FROM (SELECT  taskname, DateNumber, IFNULL(Completed,0) AS Completed FROM 
                   (SELECT DateNumber,userid,taskname,id FROM taskmaster, datemaster 
WHERE `Date_col` BETWEEN '$FromPeriod' AND '$ToPeriod') AS a LEFT JOIN 
(SELECT taskid,completeddate,DATE_FORMAT(completeddate,'%d') AS DNumber,
COUNT(taskid) AS Completed 
FROM taskmasterlog WHERE completeddate BETWEEN  '$FromPeriod' AND '$ToPeriod'
GROUP BY taskid,completeddate ) AS b ON a.id=b.`taskid` AND 
a.DateNumber = b.DNumber
JOIN usermaster AS c ON a.userid = c.`userid` AND c.`activestatus`='Active' AND a.userid='$Staff') AS a 
GROUP BY taskname
 ");
  
 
   
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='     '>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> Routine &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></th>    
		<th  width='%'> 01 </th>    
		<th  width='%'> 02 </th>    
		<th  width='%'> 03 </th>    
		<th  width='%'> 04 </th>    
		<th  width='%'> 05 </th>    
		<th  width='%'> 06 </th>    
		<th  width='%'> 07 </th>    
		<th  width='%'> 08 </th>    
		<th  width='%'> 09 </th>    
		<th  width='%'> 10 </th>   
		<th  width='%'> 11 </th> 
		<th  width='%'> 12 </th>    
		<th  width='%'> 13 </th>    
		<th  width='%'> 14 </th>    
		<th  width='%'> 15 </th>    
		<th  width='%'> 16 </th>    
		<th  width='%'> 17 </th>    
		<th  width='%'> 18 </th>    
		<th  width='%'> 19 </th>    
		<th  width='%'> 20 </th>    
		<th  width='%'> 21 </th>    
		<th  width='%'> 22 </th>    
		<th  width='%'> 23 </th>    
		<th  width='%'> 24 </th>    
		<th  width='%'> 25 </th>    
		<th  width='%'> 26 </th>    
		<th  width='%'> 27 </th>    
		<th  width='%'> 28 </th>    
		<th  width='%'> 29 </th>    
		<th  width='%'> 30 </th>    
		<th  width='%'> 31 </th>      
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
   
    echo "
  <tr>
  <td width='%'>$SerialNo </td>
  <td  width='30%'>$data[0] &nbsp;<i class='fa fa-pencil' style='font-size:12px;color:blue'></i> &nbsp;
  <i class='fa fa-trash' style='font-size:12px;color:orange'></i> </td>";
  if($CurrentDateNumber>=1)
  {

  if($data[1]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>";} 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>";} 
  
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=2)
  {
    if($data[2]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=3)
  {
    if($data[3]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=4)
  {
    if($data[4]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=5)
  {
    if($data[5]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=6)
  {
    if($data[6]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }


  if($CurrentDateNumber>=7)
  {
    if($data[7]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=8)
  {
    if($data[8]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=9)
  {
    if($data[9]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }
 
  if($CurrentDateNumber>=10)
  {
    if($data[10]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=11)
  {
    if($data[11]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=12)
  {
    if($data[12]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=13)
  {
    if($data[13]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=14)
  {
    if($data[14]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=15)
  {
    if($data[15]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=16)
  {
    if($data[16]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=17)
  {
    if($data[17]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=18)
  {
    if($data[18]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=19)
  {
    if($data[19]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=20)
  {
    if($data[20]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=21)
  {
    if($data[21]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=22)
  {
    if($data[22]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=23)
  {
    if($data[23]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=24)
  {
    if($data[24]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=25)
  {
    if($data[25]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=26)
  {
    if($data[26]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=27)
  {
    if($data[27]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=28)
  {
    if($data[28]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=29)
  {
    if($data[29]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=30)
  {
    if($data[30]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

  if($CurrentDateNumber>=31)
  {
    if($data[31]==0)
  {echo "<td style='text-align:center'><i class='fa fa-close' style='font-size:12px;color:red'></i></td>"; } 
  else 
  {echo "<td style='text-align:center'><i class='fa fa-check' style='font-size:12px;color:green'></i></td>"; } 
  }
  else
  {
    echo "<td style='text-align:center'></td>"; 
  }

   
  echo "</tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 
	 

?>