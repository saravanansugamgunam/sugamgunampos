<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["MobileNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d H:i:s"); 	 
 $Name = mysqli_real_escape_string($connection, $_POST["Name"]);    
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);   
 $Gender = mysqli_real_escape_string($connection, $_POST["Gender"]);   
 $MaritalStatus = mysqli_real_escape_string($connection, $_POST["MaritalStatus"]);   
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);   
 $AlternateContactNo = mysqli_real_escape_string($connection, $_POST["AlternateContactNo"]);   
 $Address = mysqli_real_escape_string($connection, $_POST["Address"]);    
 $DOJ = mysqli_real_escape_string($connection, $_POST["DOJ"]);    
 $Salary = mysqli_real_escape_string($connection, $_POST["Salary"]);    
 $BiometricID = mysqli_real_escape_string($connection, $_POST["BiometricID"]);    
 $Designation = mysqli_real_escape_string($connection, $_POST["Designation"]);    

 $Qualification = mysqli_real_escape_string($connection, $_POST["Qualification"]);    
 $YearofExp = mysqli_real_escape_string($connection, $_POST["YearofExp"]);    
 $StaffID = mysqli_real_escape_string($connection, $_POST["UserID"]);    
 $Status = mysqli_real_escape_string($connection, $_POST["Status"]);    
 $Password = mysqli_real_escape_string($connection, $_POST["Password"]);
 $HRDocID = mysqli_real_escape_string($connection, $_POST["HRDocID"]);
 $Mobilecode = mysqli_real_escape_string($connection, $_POST["Mobilecode"]);
 
  
 if($Designation=='9')
{
$Category ='Doctor';
}
else
{$Category ='Staff';
}
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {
   if($StaffID!='')
   {
      $AddTimeLog = "update usermaster set username='$Name',dob='$DOB',doj='$DOJ',gender='$Gender',maritalstatus='$MaritalStatus',
      mobileno='$MobileNo',altcontact='$AlternateContactNo',address1='$Address',salary='$Salary',addedby='$userid',
      activestatus='$Status',category='$Category',biometricid='$BiometricID',
      designationid='$Designation',qualification='$Qualification',yoe='$YearofExp',
      activestatus='$Status',password='$Password',hrdocumentid='$HRDocID',accesscode='$Mobilecode'
       where  userid ='$StaffID' "; 
   }
   else
   {
      $AddTimeLog = "insert into usermaster (clientid,username,dob,doj,gender,maritalstatus,mobileno,altcontact,
      address1,salary,addedby,category,biometricid,designationid,qualification,yoe,
      activestatus,password,hrdocumentid,accesscode) values
      ('$ClientID','$Name','$DOB','$DOJ','$Gender','$MaritalStatus','$MobileNo','$AlternateContactNo','$Address',
      '$Salary','$userid','$Category','$BiometricID','$Designation',
      '$Qualification','$YearofExp','$Status','$Password','$HRDocID','$Mobilecode')"; 
   }
    

   
   if (mysqli_multi_query($connection, $AddTimeLog)) {
                
       
      echo "1";
     
            } else {
               echo "Error: " . $AddTimeLog . "" . mysqli_error($connection);
            } 
 
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}