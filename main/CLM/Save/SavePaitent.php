<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PatientMobileNo"]))
{
        
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $MobileNo = mysqli_real_escape_string($connection, strtoupper($_POST["PatientMobileNo"]));    
 $PatientEmail = mysqli_real_escape_string($connection, strtoupper($_POST["PatientEmail"]));    
 $Name = mysqli_real_escape_string($connection, strtoupper($_POST["Name"])); 
 
 $Whatsapp = mysqli_real_escape_string($connection, strtoupper($_POST["Whatsapp"]));    
 $AlternateNo = mysqli_real_escape_string($connection, strtoupper($_POST["AlternateNo"]));    
 $ReferenceNo = mysqli_real_escape_string($connection, strtoupper($_POST["ReferenceNo"]));    
 $Sex = mysqli_real_escape_string($connection, $_POST["Sex"]);    
 $DOB = mysqli_real_escape_string($connection, strtoupper($_POST["DOB"]));    
 $Address = mysqli_real_escape_string($connection, strtoupper($_POST["Address"]));    
 $PatientBarcode = mysqli_real_escape_string($connection, strtoupper($_POST["PatientBarcode"]));    
 

 $City = mysqli_real_escape_string($connection, $_POST["City"]); 
 $Pincode = mysqli_real_escape_string($connection, $_POST["Pincode"]); 
 $State = mysqli_real_escape_string($connection, $_POST["State"]); 
 $Device = mysqli_real_escape_string($connection, $_POST["Device"]);  
  
 $ActiveStatus = mysqli_real_escape_string($connection, $_POST["ActiveStatus"]);  
 $ReferenceCode = mysqli_real_escape_string($connection, $_POST["ReferenceCode"]);  

 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);  
 $PatientImage = mysqli_real_escape_string($connection, $_POST["PatientImage"]);  
 $RelationShip = mysqli_real_escape_string($connection, $_POST["RelationShip"]);  
 $NewFamily = mysqli_real_escape_string($connection, $_POST["NewFamily"]);  
 $MaritalStatus = mysqli_real_escape_string($connection, $_POST["MaritalStatus"]);  
 $Tag = mysqli_real_escape_string($connection, $_POST["Tag"]);  
 $Profession = mysqli_real_escape_string($connection, $_POST["Profession"]);  


 if($Device=='Mobile')
 {
  $Signature = mysqli_real_escape_string($connection, $_POST["Signature"]);  
 }
 else{
  $Signature = '-';
 }
 

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {

    if($NewFamily==0)
    {
      if($PaitentID>0)
      {
        $AddPaymentMode = "update paitentmaster set paitentname='$Name',
        mobileno='$MobileNo',email='$PatientEmail',whatsappno='$Whatsapp',alternateno='$AlternateNo',
        activestatus='$ActiveStatus', address='$Address', referenceno='$ReferenceNo',
        gender='$Sex',dob='$DOB',city='$City',statecode ='$State',pincode ='$Pincode',barcode='$PatientBarcode', 
        referenceid='$ReferenceCode',relationship='$RelationShip',patientphoto='$PatientImage',
        maritalstatus='$MaritalStatus',tag='$Tag',profession='$Profession'   where paitentid='$PaitentID'"; 
     
      }
      else
      { 
        $AddPaymentMode = "insert into paitentmaster (paitentname ,mobileno,email,whatsappno,alternateno,referenceno,
        address,dob,gender,barcode,city,statecode,pincode,device,signatureimage,
        referenceid,activestatus,patientphoto,relationship,maritalstatus,tag,profession) values
         ('$Name','$MobileNo','$PatientEmail','$Whatsapp',
        '$AlternateNo','$ReferenceNo','$Address','$DOB','$Sex','$PatientBarcode',
        '$City','$State','$Pincode','$Device','$Signature','$ReferenceCode',
        '$ActiveStatus','$PatientImage','$RelationShip','$MaritalStatus','$Tag','$Profession')"; 
      }
    }
    else
    {
      $AddPaymentMode = "insert into paitentmaster (paitentname ,mobileno,email,whatsappno,alternateno,referenceno,
      address,dob,gender,barcode,city,statecode,pincode,device,signatureimage,
      referenceid,activestatus,patientphoto,relationship,maritalstatus,tag,profession) values
       ('$Name','$MobileNo','$PatientEmail','$Whatsapp',
      '$AlternateNo','$ReferenceNo','$Address','$DOB','$Sex','$PatientBarcode',
      '$City','$State','$Pincode','$Device','$Signature','$ReferenceCode',
      '$ActiveStatus','$PatientImage','$RelationShip','$MaritalStatus','$Tag','$Profession')"; 
    }

    

 
    if (mysqli_query($connection, $AddPaymentMode)) {

      // echo "Service Requese has been registered, Request ID is " . $last_id;
      echo  1;
      // echo $SaveSaleMaster;
      } else {
      echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
      } 
 
       
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>