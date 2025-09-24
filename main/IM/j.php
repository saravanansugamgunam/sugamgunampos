<?php  
 //  
 function get_data()  
 {  

      $connect = mysqli_connect("localhost", "u675828376_lazo", "Lazo@min0!", "u675828376_db_lazo");  
      
   //   $connection = mysqli_connect('localhost','u675828376_lazo','Lazo@min0!') or die(mysqli_error());
  //     $database = mysqli_select_db($connection,'u675828376_db_lazo') or die(mysqli_error());


	  // $query = "SELECT DATE_FORMAT(saledate ,'%d') as d,ROUND(SUM(nettamount),0) as sale FROM salemaster 
// WHERE transactiontype IN ('Sale','Return') 
// AND  saledate BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW()) 
// GROUP BY DATE_FORMAT(saledate ,'%d')";  
      
	  	     date_default_timezone_set("Asia/Calcutta");  
			 
	  $query = "SELECT DATE_FORMAT(saledate ,'%d') as d,ROUND(SUM(nettamount),0) as sale FROM salemaster 
WHERE transactiontype IN ('Sale','Return') 
AND  saledate  =CURRENT_DATE
GROUP BY DATE_FORMAT(saledate ,'%d')";  

      $result = mysqli_query($connect, $query);  
      $employee_data = array();  
      while($row = mysqli_fetch_array($result))  
      {  
           $employee_data[] = array(  
                  $row["d"],  
                   $row["sale"] 
           );  
      }  
      return json_encode($employee_data);  
 }  
 $file_name ="1.json";  
 if(file_put_contents($file_name, get_data()))  
 {  
      // echo $file_name . ' File created';  
 }  
 else  
 {  
      // echo 'There is some error';  
 }  
 ?>