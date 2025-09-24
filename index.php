<?php
include 'connect.php';
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<html>
<head>
<title>
POS
</title>
    <link rel="shortcut icon" href="main/images/pos.jpg">

  <link href="main/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="main/css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="main/css/bootstrap-responsive.css" rel="stylesheet">

<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body style="background-image: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/dark_embroidery.png);">
    <div class="container-fluid">
      <div class="row-fluid">
		<div class="span4">
		</div>
	
</div>

<style>
  /* Reset CSS */
 
html {
  background: #95a5a6;
  background-image: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/dark_embroidery.png);
  font-family: 'Helvetica Neue', Arial, Sans-Serif;
}
.clearfix:after,
form:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
} 
#content {
    background: #f9f9f9;
    background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
    -webkit-box-shadow: 0 1px 0 #fff inset;
    -moz-box-shadow: 0 1px 0 #fff inset;
    -ms-box-shadow: 0 1px 0 #fff inset;
    -o-box-shadow: 0 1px 0 #fff inset;
    box-shadow: 0 1px 0 #fff inset;
    border: 1px solid #c4c6ca;
    margin: 0 auto;
    padding: 25px 0 0;
    position: relative;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    width: 400px;
}
 #login {
    background: #ecf0f1;
    color: #34495e;
    width: 400px;
    margin: auto;
    margin-top: 90px;
    padding: 30px;
	
    border-radius: 10px;
    text-align: center;
	
	box-shadow: 3px 3px 10px #333;
	
	
	
}
</style>
 
        
<div id="login" class="login">
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
	foreach($_SESSION['ERRMSG_ARR'] as $msg) {
		echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	}
	unset($_SESSION['ERRMSG_ARR']);
}
?>
   
<form action="login.php" method="post">

			<font style=" font:bold 25px 'Helvetica Neue'; color:#34495e;"><center>Login Panel  </center></font>
		<br>
<div class="input-prepend" >
		<span style="height:30px; width:25px; background-color:#93b5ec;" class="add-on"><i class="icon-building icon-2x"></i></span> 

    <select   id='cmbLocation' name='cmbLocation'  style="height:40px;   width: 210px;" > 
                 <?php  
                            $sqli = "  SELECT locationcode,locationname FROM locationmaster where  locationcode <>0 and activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                            while ($row = mysqli_fetch_array($result)) {
                            	# code...

                             echo ' <option value='.$row['locationcode'].'>'.$row['locationname'].'</option>';
                              }	
                            ?>
                                            
                                        </select>
 
</select>
    
    <br>
</div>

<div class="input-prepend">
		<span style="height:30px; width:25px;  background-color:#93b5ec;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:40px;" type="text" name="username" Placeholder="Username" required/><br>
</div>
<div class="input-prepend">
	<span style="height:30px; width:25px;  background-color:#93b5ec;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;" name="password" Placeholder="Password" required/><br>
		</div>
		<div class="qwe">
		 <button class="btn btn-large btn-primary btn-block pull-right" href="dashboard.html" type="submit"><i class="icon-signin icon-large"></i> LOGIN</button>
</div>
		 </form>
</div>
</div>
</div>
<!--Brought To You by code-projects.org-->
</div>
</body>
</html>