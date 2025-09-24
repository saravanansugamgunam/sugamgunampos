<?php include 'header.php'; ?>
<?php include('navfixed.php');?>
<?php
$Userid = $_SESSION['SESS_MEMBER_ID'];
        $res = $connection->query("
  SELECT password from user where id='$Userid';");
     
    while($data = mysqli_fetch_row($res))
    {

    $PasswordinDB=$data[0]; 
     
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <div class="container-fluid">
      <div class="row-fluid"> 
      <body class="page-login">
        <style> 
.Kilian2-styles-module--bg--1Bu3- {
    box-shadow: inset 0 1px 1px 0 hsl(0deg 0% 100% / 15%), 0 50px 100px -20px rgb(50 50 93 / 30%), 0 30px 60px -30px rgb(0 0 0 / 50%), -10px 10px 60px -10px rgb(103 178 111 / 30%);
    background: #fff;
    margin: 5rem auto -2rem;
    border-radius: 1rem;
    padding: 3rem 3rem 2rem;
}
            </style>
        <div class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-6 center  Kilian2-styles-module--bg--1Bu3- ">
                            <div class="login-box"  >
                                 
                                <p class="text-center m-t-md">Change Your password</p>
                                <input type ='hidden' id='txtUserid' name ='txtUserid' value ='<?php echo $_SESSION['SESS_MEMBER_ID']; ?>' />
                                <input type ='hidden' id='txtPasswordinDB' name ='txtPasswordinDB' value ='<?php echo $PasswordinDB; ?>' />
                                
                                <form class="m-t-md"  onsubmit="return false;">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name='txtCurrentPassword' id ='txtCurrentPassword' placeholder="Current Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name='txtNewPassword' id='txtNewPassword' placeholder="New Password" required>
                                    </div>
                                    <div class="form-group">
                                    <button type="buton" class="btn btn-success" onclick='ChagePassword();' >Change</button> 
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->

	
<script>
  
function ChagePassword()
{
 
	var CurrentPassword = document.getElementById("txtCurrentPassword").value; 
 
	var NewPassword = document.getElementById("txtNewPassword").value;
 
  var PasswordonDB = document.getElementById("txtPasswordinDB").value;
 
  var UserID = document.getElementById("txtUserid").value; 
 
	  
	 if(PasswordonDB != CurrentPassword )
   {
    alert("Password Mismatch")
   }
else
	 {
     if(NewPassword=="" || CurrentPassword=="" || UserID=="" )
     {
      alert("Please fill all details");
     }
     else
     {
      var datas = "&CurrentPassword="+CurrentPassword+
                  "&NewPassword="+NewPassword+
                  "&UserID="+UserID;	 
 
			$.ajax({
		   url:"UpdatePassword.php",
		   method:"POST",
		   data:datas,	 
		   success:function(data)
		   {	 
		  // document.getElementById("txtQuery").value=data;  
		   
		    alert(data); 
        window.open("index.php","_self")
		    }
		  }); 
     }
       

   }

		
		  
}
	 

  </script>
 
</body>
<br>
<br>
<br>
<br>
<br>
<?php include('footer.php'); ?>
</html>
