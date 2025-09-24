 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);   
  $ClientID = $_SESSION["SESS_LOCATION"];
 
  $result = mysqli_query($connection, "
  
   
SELECT   SUM(IFNULL(CEILING(totalqty/packsize) ,1)*c.mrp) as EstimateAmount
     FROM diseasemapping_paitent AS a 
   JOIN productmaster AS b ON a.conceptid=b.`productid` AND a.conceptname='Medicine' 
    AND a.paitientid='$PaitentID' 
    LEFT JOIN (SELECT barcode,MAX(mrp) AS mrp,COUNT(barcode) FROM newstockdetails_3 GROUP BY barcode  ORDER BY stockitemid DESC ) AS c ON b.`uniquebarcode`=c.barcode
   WHERE  diseasemappinguniqueid ='$UniqueID'");
  
   
   
	 $data = array();
   
   while($row=mysqli_fetch_assoc($result))
   {  
     $data[] = $row['EstimateAmount']; 
   }
   
echo json_encode($data);

  ?>