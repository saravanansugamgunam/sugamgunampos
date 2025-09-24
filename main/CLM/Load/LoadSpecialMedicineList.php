 <style>
table.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 20%;
    text-align: left;
    border-collapse: collapse;
}

table.blueTable td,
table.blueTable th {
    border: 1px solid #AAAAAA;
    padding: 2px 2px;
    text-align: center;
}

table.blueTable tbody td {
    font-size: 13px;
    text-align: center;
}

table.blueTable tr:nth-child(even) {
    background: #D0E4F5;
}

table.blueTable thead {
    background: #83b3e4;
    background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    border-bottom: 1px solid #444444;
}

table.blueTable thead th {
    font-size: 14px;
    font-weight: normal;
    color: #FFFFFF;
    border-left: 1px solid #D0E4F5;
    padding: 5px 20px;

}

table.blueTable thead th:first-child {
    border-left: none;
}

table.blueTable tfoot {
    font-size: 14px;
    font-weight: bold;
    color: #FFFFFF;
    background: #D0E4F5;
    background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    border-top: 2px solid #444444;
}

table.blueTable tfoot td {
    font-size: 14px;
}

table.blueTable tfoot .links {
    text-align: right;
}

table.blueTable tfoot .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
}
 </style>
 <?php

  function formatMoney($number, $fractional = false)
  {
    if ($fractional) {
      $number = sprintf('%.2f', $number);
    }
    while (true) {
      $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
      if ($replaced != $number) {
        $number = $replaced;
      } else {
        break;
      }
    }
    return $number;
  }

  session_cache_limiter(FALSE);
  session_start();



  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d");


  $Status = mysqli_real_escape_string($connection, $_POST["Status"]); 
  
 if($Status=='All')
 {
  $Status='%';

 }

  echo "<br>";

  $result = mysqli_query($connection, "  

SELECT DATE_FORMAT(a.addedon,'%d-%m-%y'), d.`paitentname`,d.`mobileno`,b.`username`,
a.remarks,a.status,c.`username` FROM specialmedicine_patientmapping AS a JOIN usermaster AS b ON a.doctorcode=b.`userid`
JOIN usermaster AS c ON  a.addedby = c.`userid`
JOIN paitentmaster AS d ON a.patientcode = d.`paitentid` 
where a.status like '$Status' 
 ORDER BY addedon DESC
  

 ");





  //echo "<table id='tblProject' class='tblMasters'>";

  echo "  	<table id='data-table' class='table table-bordered'>";
  echo " <thead><tr>  
		<th>S.No</th>              
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>           

		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Paitent</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Doctor</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Description</a></th>   
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Status</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Updated By</a></th>  
		 
		</tr> </thead> <tbody id='ProjectTable'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  > $data[0]</td>
  <td  > $data[1] <br>$data[2]</td>  
   <td  width='%'>$data[3]</td>  
   <td  width='%'>$data[4]</td>  
   <td  width='%'>$data[5]</td>  
   <td  width='%'>$data[6]</td> 
 ";

 echo "</tr>";

 $SerialNo = $SerialNo + 1;
 }
 echo "</tbody>
 </table>";



 ?>


 <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
 <script src="../assets/js/table-manage-default.demo.min.js"></script>

 <script>
$(document).ready(function() {

    TableManageDefault.init();
});
 </script>