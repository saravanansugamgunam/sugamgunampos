 


<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Dumy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $LocationCode = 3;
  $currentdate =date("Y-m-d H:i:s"); 							  
 $currenttime = date("His"); 
 
 if($currenttime<140001)
  {
$result = mysqli_query($connection, "

SELECT tokennumber,b.paitentname,(SELECT paitentnamedisplay FROM tokensettings  WHERE clientid ='$LocationCode' ) AS DisplayName  FROM tokenmaster AS a JOIN paitentmaster AS b 
ON a.paitentcode=b.paitentid  WHERE  locationcode='$LocationCode'  and  tokenid IN( 
SELECT tokenid FROM tokenmaster WHERE revisedtokennumber IN( 
SELECT MIN(revisedtokennumber)+1 FROM tokenmaster WHERE tokenstatus = 'Open'
AND  DATE =CURRENT_DATE() AND doctorid ='2'  AND createdon < 140001 
ORDER BY revisedtokennumber) AND  
tokenstatus = 'Open'
AND  DATE =CURRENT_DATE() AND doctorid ='2'  
) LIMIT 1  " ); 
  }
   else
  {
	  $result = mysqli_query($connection, "
SELECT tokennumber,b.paitentname,(SELECT paitentnamedisplay FROM tokensettings  WHERE clientid ='$LocationCode' ) AS DisplayName 
 FROM tokenmaster AS a JOIN paitentmaster AS b 
ON a.paitentcode=b.paitentid  WHERE  locationcode='$LocationCode'  and   tokenid IN( 
SELECT tokenid FROM tokenmaster WHERE  revisedtokennumber IN( 
SELECT MIN(revisedtokennumber)+1 FROM tokenmaster WHERE tokenstatus = 'Open'
AND  DATE =CURRENT_DATE() AND doctorid ='2'  AND createdon > 140000 
ORDER BY revisedtokennumber) AND  
tokenstatus = 'Open'
AND  DATE =CURRENT_DATE() AND doctorid ='2'  
) LIMIT 1 " ); 

  }
	  

	 $data = array();
   
    while($row=mysqli_fetch_assoc($result))
			{   
		if($row['DisplayName']==1)
		{
				$data[] = 'Next Token: '.$row['tokennumber']; 
				$data[] = 'Name: '.$row['paitentname']; 
		}
		else
		{
				  $data[] = 'Next Token: '.$row['tokennumber']; 
				   $data[] = ''; 
		}
		 
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
    
}

?>