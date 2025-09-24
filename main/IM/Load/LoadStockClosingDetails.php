<style>
#tblBillingItems tr:nth-of-type(1) td {
    /* 1st row */
    background-color: #33c481;
}
</style>

<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["StockTakeID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $StockTakeID = mysqli_real_escape_string($connection, $_POST["StockTakeID"]);
 $Status = mysqli_real_escape_string($connection, $_POST["Status"]);
 $StockTakeFromDate = mysqli_real_escape_string($connection, $_POST["StockTakeFromDate"]);
 $StockTakeToDate = mysqli_real_escape_string($connection, $_POST["StockTakeToDate"]);
  
if($Status=='%')
{
  $Status=" closedstatus like'%' ";
} else if($Status=='0')
{
  $Status=" closedstatus like'0' ";
}
else
{
  $Status=" closedstatus like'1' ";
}

 if($StockTakeID=='All')
 {
  $StockTakeID='%';
 }
 ?>


<form class="form-horizontal">
    <?php 
 
                            
                            
                            $result = mysqli_query($connection, "  
                            SELECT DATE_FORMAT(a.createdon,'%d-%m-%Y') createdon,id,b.locationname,c.username,
                            IFNULL(d.scanqty,0) AS Scannqty,closedstatus,a.stocktakelocation,e.productshortcode,
                            a.productcode
                             FROM  stocktakearea AS a 
                            JOIN locationmaster AS b ON a.stocktakelocation = b.locationcode
                            JOIN usermaster AS c ON a.incharge=c.userid
                            join productmaster as e on a.productcode = e.productid
                            LEFT JOIN (SELECT stocktakeuniqueno,SUM(scanqty) AS scanqty FROM stocktakeitems 
                            GROUP BY stocktakeuniqueno) AS d ON a.id=d.stocktakeuniqueno where id like ('$StockTakeID') and
                            $Status and  a.createdon between '$StockTakeFromDate 00:00:01' and '$StockTakeToDate 23:59:00'
                            order by a.createdon desc   ");
                            
                            
 

		echo"	<table id='data-table' class='table table-striped table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Location</th>
                                            <th>Incharge</th> 
                                            <th>Scann Qty</th>  
                                            <th>Status</th>  
                                            <th hidden>Locationcode</th>  
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    
									   $SerialNo = 1;
									   while($data = mysqli_fetch_row($result))
									   {
										 echo "<tr>
                                         		<td>$data[0]</td>
												<td>$data[1]</td>
												<td>$data[7]</td>
												<td>$data[2]</td>
												<td>$data[3]</td> 
												<td>$data[4]</td>";
												if($data[5]==0)		 
                        {
                          echo "<td  onclick='LoadStockTakesummayDetails($data[1],$data[5],$data[6],$data[8])' >
                          <button type='button' class='btn btn-primary btn-xs'>In Progress</button>
                          </td>";
                        }
                        else
                        {
                          echo "<td onclick='LoadStockTakesummayDetails($data[1],$data[5],$data[6],$data[8])' >
                          <button type='button' class='btn btn-success btn-xs'>Completed</button>                     
                          </td>";
                        }
                      echo "<td hidden>$data[6]</td> 
                     <td hidden>$data[8]</td> 
                      </tr>";
	
									   }

                                    echo "</tbody>
                                </table> ";
		 ?>



</form>
<?php

                             
}
    

?>