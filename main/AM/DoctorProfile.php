<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
  <![endif]-->
  <!--[if !IE]>
  <!-->
    <html lang="en">
    	<!--
    	<![endif]-->
  <?php 
  
    include("../connect.php");
    // $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start();
	   $LocationCode = $_SESSION['SESS_LOCATION'];
   $LocationName = $_SESSION['SESS_LOCATIONNAME'];
   $GroupID = $_SESSION['SESS_GROUP_ID'];
  $userid=$_GET['DID'];
    ?>
  <head>
    <meta charset="utf-8" />
    <title>Valviyal Academy</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/style.min.css" rel="stylesheet" />
    <link href="../assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
    <link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="../assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
		<link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet"/>
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <style>
      body {
      background: #f5f5f5 url('../assets/img/bg.png') left top repeat;
      }
      #f1_upload_process{
      z-index:100;
      visibility:hidden;
      position:absolute;
      text-align:center;
      width:400px;
      }
      .msg {
      text-align:left;
      color:#666;
      background-repeat: no-repeat;
      margin-left:30px;
      margin-right:30px;
      padding:5px;
      padding-left:30px;
      }
      .emsg {
      text-align:left;
      margin-left:30px;
      margin-right:30px;
      color:#666;
      background-repeat: no-repeat;
      padding:5px;
      padding-left:30px;
      }
    </style>
     
  </head>
  <body>
    <!-- begin #page-loader -->
    
    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
      <!-- begin #header -->
      <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
          <!-- begin mobile sidebar expand / collapse button -->
          <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">
            <img src="../assets/img/logo.png" class="media-object"   width="150" alt="" />
            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
          </div>
          <!-- end mobile sidebar expand / collapse button -->
          <!-- begin header navigation right -->
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown navbar-user">
             <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							
							<i class="fa fa-bell-o"></i> 
						</a>
            </li>
            
            <li class="dropdown navbar-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/img/user-13.jpg" alt="" />
              <span class="hidden-xs">
               <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
              </span>
               
              </a>
			   <li class="divider"></li>
				<li>
                  <a href="../../index.php">Log Out</a>
                </li>
              <ul class="dropdown-menu animated fadeInLeft">
                <li class="arrow"></li>
                <li>
                  <a href="PasswordChange.php">Change Password</a>
                </li> 
				 <li class="divider"></li>
				<li>
                  <a href="logout.php">Log Out</a>
                </li>
              </ul>
            </li>
          </ul>
          <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
      </div>
      <!-- end #header -->
      
      <div id="wait" style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
        <img src='../assets/img/demo_wait.gif' width="64" height="64" />
        <br>Loading...
      </div>
      <!-- begin #sidebar -->
     <div id="sidebar" class="sidebar">
     <?php include("CLMSidePanel.php") ?>
      </div>
      <!-- end #sidebar -->
      <!-- begin #content -->
	  <script>
  
  function LoadProfile()
  {
	 
  }
  function LoadCourseDetails()
  {
  }
  function LoadPaymentHistory()
  {
  }
  function LoadPayementSchedule()
  {
  }
  
	  
	  
  </script>
	<?php
	
	
	  $res = $connection->query(" 
	  
	  
SELECT username, doctorphone, alternateno, doctoremail, 
gender,DATE_FORMAT(dob, '%d-%b-%Y') AS doctordob,maritalstatus,qualification,previousorg,
referedby,address,address,doctorimagepath,biometricstatus FROM doctormaster
 WHERE userid ='$userid' ;"); 

echo " 
	  
	  
SELECT username, doctorphone, alternateno, doctoremail, 
gender,DATE_FORMAT(dob, '%d-%b-%Y') AS doctordob,maritalstatus,qualification,previousorg,
referedby,address,address,doctorimagepath,biometricstatus FROM doctormaster
 WHERE userid ='$userid'";
 
while($data = mysqli_fetch_row($res))
{

$StudentName=$data[0];
$StudentMobileNo=$data[1];
$StudentAltMobileNo=$data[2]; 
$StudentEmail=$data[3]; 
$StudentGender=$data[4]; 
$StudentDOB=$data[5]; 
$StudentMaritalStatus=strtoupper($data[6]); 
$StudentQualification=strtoupper($data[7]); 
$StudentOccupation=strtoupper($data[8]); 
$StudentGuardian=strtoupper($data[9]); 
$StudentAddress=strtoupper($data[10]); 
$StudentAltAddress=strtoupper($data[11]); 
$StudentImage=$data[12]; 
$BiometricStatus=$data[13]; 
 

}



	?>
 <div id="content" class="content">
        <div class="row">
		
		
		
		<div class="modal fade"   id="modal-Biometric">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Add Biometric</h4>
											 <input type ='hidden' id='UserID' name ='UserID' value="<?php echo $userid; ?>" />
										</div>
										<div class="modal-bod">
											 <div class="col-md-12">
			        <!-- begin panel -->
					 
                        <div class="panel-body">
                            <form class="form-horizontal">
                              
								  
 
    <style type="text/css">
         

        .img {
            min-width: 125px;
            min-height: 155px;
            width: 125px;
            height: 155px;
            border: 1px solid #CCC;
            border-radius: 4px;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
            background-color: #FFFFFF;
        }
    </style>
    <script src="jquery-1.8.2.js"></script>
    <script src="mfs100-9.0.2.6.js"></script>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">


function AutoCapture(){
    // do whatever you like here

    setTimeout(Capture, 5000);
}
 


        var quality = 60; //(1 to 100) (recommanded minimum 55)
        var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )

        function GetInfo() {
            document.getElementById('tdSerial').innerHTML = "";
            document.getElementById('tdCertification').innerHTML = "";
            document.getElementById('tdMake').innerHTML = "";
            document.getElementById('tdModel').innerHTML = "";
            document.getElementById('tdWidth').innerHTML = "";
            document.getElementById('tdHeight').innerHTML = "";
            document.getElementById('tdLocalMac').innerHTML = "";
            document.getElementById('tdLocalIP').innerHTML = "";
            document.getElementById('tdSystemID').innerHTML = "";
            document.getElementById('tdPublicIP').innerHTML = "";


            var key = document.getElementById('txtKey').value;

            var res;
            if (key.length == 0) {
                res = GetMFS100Info();
            }
            else {
                res = GetMFS100KeyInfo(key);
            }

            if (res.httpStaus) {

                document.getElementById('txtStatus').value = "ErrorCode: " + res.data.ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                if (res.data.ErrorCode == "0") {
                    document.getElementById('tdSerial').innerHTML = res.data.DeviceInfo.SerialNo;
                    document.getElementById('tdCertification').innerHTML = res.data.DeviceInfo.Certificate;
                    document.getElementById('tdMake').innerHTML = res.data.DeviceInfo.Make;
                    document.getElementById('tdModel').innerHTML = res.data.DeviceInfo.Model;
                    document.getElementById('tdWidth').innerHTML = res.data.DeviceInfo.Width;
                    document.getElementById('tdHeight').innerHTML = res.data.DeviceInfo.Height;
                    document.getElementById('tdLocalMac').innerHTML = res.data.DeviceInfo.LocalMac;
                    document.getElementById('tdLocalIP').innerHTML = res.data.DeviceInfo.LocalIP;
                    document.getElementById('tdSystemID').innerHTML = res.data.DeviceInfo.SystemID;
                    document.getElementById('tdPublicIP').innerHTML = res.data.DeviceInfo.PublicIP;
                }
            }
            else {
                alert(res.err);
            }
            return false;
        }
		
		function ResetBiometric()
		{
			document.getElementById('imgFinger').src = "../assets/img/Biometric.jpg";
                document.getElementById('txtImageInfo').value = "";
                document.getElementById('txtIsoTemplate').value = "";
                document.getElementById('txtAnsiTemplate').value = "";
                document.getElementById('txtIsoImage').value = "";
                document.getElementById('txtRawData').value = "";
                document.getElementById('txtWsqData').value = "";
		}

        function Capture() {
            try {
				 
                // document.getElementById('txtStatus').value = "4";
				 
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtImageInfo').value = "";
                document.getElementById('txtIsoTemplate').value = "";
                document.getElementById('txtAnsiTemplate').value = "";
                document.getElementById('txtIsoImage').value = "";
                document.getElementById('txtRawData').value = "";
                document.getElementById('txtWsqData').value = "";
 
                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) {
 
                    document.getElementById('txtStatus').value = "ErrorCode: " + res.data.ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                    if (res.data.ErrorCode == "0") {
                        document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.data.BitmapData;
                        var imageinfo = "Quality: " + res.data.Quality + " Nfiq: " + res.data.Nfiq + " W(in): " + res.data.InWidth + " H(in): " + res.data.InHeight + " area(in): " + res.data.InArea + " Resolution: " + res.data.Resolution + " GrayScale: " + res.data.GrayScale + " Bpp: " + res.data.Bpp + " WSQCompressRatio: " + res.data.WSQCompressRatio + " WSQInfo: " + res.data.WSQInfo;
                        document.getElementById('txtImageInfo').value = imageinfo;
                        document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                        document.getElementById('txtAnsiTemplate').value = res.data.AnsiTemplate;
                        document.getElementById('txtIsoImage').value = res.data.IsoImage;
                        document.getElementById('txtRawData').value = res.data.RawData;
                        document.getElementById('txtWsqData').value = res.data.WsqImage;
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
				 
                alert(e);
            }
            return false;
        }

         
		</script>
 

    <table width="100%" style="padding-top:0px;">
        
        
        <tr>
             
            <td width="150px" height="190px" align="center" class="img">
                <img src="../assets/img/Biometric.jpg"  id="imgFinger" width="145px" height="188px" alt="Finger Image" />
            </td>
            <td>
                <table align="left" border="0" style="width:30%; padding-right:2px;">
                  
                    <tr>
                        <td align="left" style="width: 100px;">S.No:</td>
                        <td align="left" style="width: 150px;" id="tdSerial"></td>
						</tr>
						<tr>
                        <td align="left">IP</td>
                        <td align="left" id="tdLocalIP"></td>
						</tr>
						<tr>
                        <td align="left">MAC:</td>
                        <td align="left" id="tdLocalMac"></td>
                    </tr>
                    <tr hidden>
					 <input type="hidden" value="" id="txtKey" class="form-control" />
                        <td align="left">Make:</td>
                        <td align="left" id="tdMake"></td>
                        <td align="left">Model:</td>
                        <td align="left" id="tdModel"></td>
                    
                        <td align="left">Width:</td>
                        <td align="left" id="tdWidth"></td>
                        <td align="left">Height:</td>
                        <td align="left" id="tdHeight"></td>
                     
                        <td align="left">Public IP</td>
                        <td align="left" id="tdPublicIP"></td>
                        <td align="left">System ID</td>
                        <td align="left" id="tdSystemID"></td>
                   
					 <td align="left" style="width: 100px;">Certification:</td>
                        <td align="left" id="tdCertification"></td>
					</tr>
                </table>
            </td>
        </tr>
    </table>
	 
	 
        <table hidden width="100%">
            <tr>
                <td width="220px">
                    Status:
                </td>
                <td>
                    <input type="text" value="" id="txtStatus" class="form-control" />
                </td>
            </tr>
            <tr>
                <td>
                    Quality:
                </td>
                <td>
                    <input type="text" value="" id="txtImageInfo" class="form-control" />
                </td>
            </tr>
            <!--<tr>
                <td>
                    NFIQ:
                </td>
                <td>
                    <input type="text" value="" id="txtNFIQ" class="form-control" />
                </td>
            </tr>-->
            <tr>
                <td>
                    Base64Encoded ISO Template
                </td>
                <td>
                    <textarea id="txtIsoTemplate" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Base64Encoded ANSI Template
                </td>
                <td>
                    <textarea id="txtAnsiTemplate" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Base64Encoded ISO Image
                </td>
                <td>
                    <textarea id="txtIsoImage" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Base64Encoded Raw Data
                </td>
                <td>
                    <textarea id="txtRawData" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Base64Encoded Wsq Image Data
                </td>
                <td>
                    <textarea id="txtWsqData" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Encrypted Base64Encoded Pid/Rbd
                </td>
                <td>
                    <textarea id="txtPid" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Encrypted Base64Encoded Session Key
                </td>
                <td>
                    <textarea id="txtSessionKey" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Encrypted Base64Encoded Hmac
                </td>
                <td>
                    <input type="text" value="" id="txtHmac" class="form-control" />

                </td>
            </tr>
            <tr>
                <td>
                    Ci
                </td>
                <td>
                    <input type="text" value="" id="txtCi" class="form-control" />
                </td>
            </tr>
            <tr>
                <td>
                    Pid/Rbd Ts
                </td>
                <td>
                    <input type="text" value="" id="txtPidTs" class="form-control" />
                </td>
            </tr>
        </table>
    
	 
	<script>
	function SaveBiometric()
	{
		 var Status = document.getElementById("txtStatus").value; 
		 var UserID = document.getElementById("UserID").value; 
		   var ImaegInfo = document.getElementById("txtImageInfo").value;
		    var ISOTemplate = document.getElementById("txtIsoTemplate").value;
			
			// var Status = 1;
		   // var ImaegInfo = 2;
		    // var ISOTemplate = 3;
			
	if( Status=="" || UserID=="" || ImaegInfo=="" || ISOTemplate=="" )
	{
		 swal("Alert!", "Kindly provide the details!", "warning");
		 // alert(1);
	}
	else
	{
		 var datas = "&Status="+Status+"&ImaegInfo="+ImaegInfo+"&UserID="+UserID+"&ISOTemplate="+encodeURIComponent(ISOTemplate);	
			   // alert(datas);
			    $.ajax({
		   url:"Save/SaveStudentBiometric.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {
			if(data==1)
			{
				// swal("Biometric!", "Biometric details added, "success");
				swal("Biometric!", "Kindly provide valid details!", "success");
				  setTimeout(function () {
        location.reload()
    }, 1000); 
			}
			else
			{
				 // swal("Biometric!", "Error Saving Biometric, "alert");
				 swal("Alert!", "Kindly provide valid details!", "warning");
				  setTimeout(function () {
        location.reload()
    }, 1000); 
			}
				
		   
		   }
		  });
	}
		
			
			
			
		  
	}
	
	function GetBiometric()
	{
		 // var UserID = document.getElementById("txtInvoiceNo").value;
		 var UserID = 1;
		 
		var datas = "&UserID="+UserID;	
	  	   // alert(datas);
		 $.ajax({
		   url:"LoadBiometric.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {	
		     // alert(data);
		   $("#txtIsoTemplate").val(data[0]);  
		
		   }
		  });
		   
	}
	
	</script>
    
</body>
</html>



                                 
                            </form>
						</div>
                    
                </div>
										</div>
										<div class="modal-footer">
										<a href="javascript:;" class="btn btn-sm btn-warning"   onclick="return GetInfo()">Device Status</a>
										
										<a href="javascript:;" class="btn btn-sm btn-danger"   onclick="return Capture()">Capture</a>
										<a href="javascript:;" class="btn btn-sm btn-success"   onclick="SaveBiometric()">Save</a> 
	   
										</div>
									</div>
								</div>
							</div>
							
							
							
		 
		  <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin profile-left -->
                    <div class="profile-left">
                        <!-- begin profile-image -->
                        <div class="profile-image">
						<?php if($StudentImage=='-')
						{
							echo "<img src='../assets/img/profile-cover.jpg' />";
						}
						else
						{
							echo "<img src='".$StudentImage."' style='width: 200px;  object-fit: fill;' />";
						}
						?>
							
                            
                            <i class="fa fa-user hide"></i>
                        </div>
						 
                        <!-- end profile-image -->
                        <div class="m-b-10">
						
						<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
			location.reload();
		    },
		  	error: function() 
	    	{
				location.reload();
	    	} 	        
	   });
	}));
});
</script>
						
						<div class="bgColor">
<form id="uploadForm" action="upload.php" method="post">
<input type='hidden' id='txtStudentCode' name ='txtStudentCode'  value ='<?php echo $userid; ?>' />
<div id="targetLayer">No Image</div>
<div id="uploadFormLayer">
<input name="userImage" type="file" class="inputFile btn btn-warning btn-block btn-sm" /><br/>
<input type="submit" value="Submit" class="btnSubmit btn btn-info btn-block btn-sm" />
</form>
</div>
</div> 
                        </div>
                        
                        <!-- end profile-highlight -->
					<?php 
					if($BiometricStatus=='Yes')
					{
						
						echo "<center><img src='../assets/img/BiometricCompleted.jpg' 
						style='width:20%;' /></center>";
					}
					else
					{
						echo "<center>  <a href='#modal-Biometric' data-toggle='modal' style='color:white'>
						<img src='../assets/img/BiometricNotCompleted.jpg' 
						style='width:20%;' /></a>  </center>";
					}
					?>
						
						
						
                    </div>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div class="profile-right">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <h4><?php echo $StudentName; ?></h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Mobile</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <?php echo $StudentMobileNo; ?>  </td>
											 
                                        </tr>  
										<tr>
                                            <td class="field">Alt. Mobile</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <?php echo $StudentAltMobileNo; ?>  </td>
											 
                                        </tr>
										<tr>
                                            <td class="field">Email</td>
                                            <td> 
											<?php echo $StudentEmail; ?></td>
											 
                                        </tr>
										<tr>
                                            <td class="field">Gender</td>
                                            <td> <?php echo $StudentGender; ?>	</td>
											 
                                        </tr>
										<tr>
                                            <td class="field">DOB</td>
                                            <td><?php echo $StudentDOB; ?></td>
											 
                                        </tr>
										<tr>
                                            <td class="field">Martital Status</td>
                                            <td> <?php echo $StudentMaritalStatus; ?></td>
											 
                                        </tr>
										<tr>
                                            <td class="field">Qualification</td>
                                            <td> <?php echo $StudentQualification; ?></td>
											 
                                        </tr>
										<tr>
                                            <td class="field">Occupation</td>
                                            <td> <?php echo $StudentOccupation; ?></td>
											 
                                        </tr>
										
										<tr>
                                            <td class="field">Father / Gaurdian</td>
                                            <td> <?php echo $StudentGuardian; ?></td>
											 
                                        </tr>
										
                                        <tr>
                                            <td class="field">Home Address</td>
                                            <td><?php echo $StudentAddress; ?></td>
                                        </tr> 
                                         <tr>
                                            <td class="field">Documents</td>
                                            <td>...</td>
                                        </tr>
                                         
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <!-- end profile-right -->
                </div>
                <!-- end profile-section -->
                <!-- begin profile-section -->
                <div class="profile-section">
					
	
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-4">
                            <h4 class="title">Courses</h4>
                            <!-- begin scrollbar -->
                            <div data-scrollbar="true" data-height="280px" class="bg-silver">
                                <!-- begin chats -->
                                 <table class="table table-condensed">
									<thead>
										<tr>
											 
											<th>S. No</th>
											<th>Batch</th>
											<th>Balance</th>
										</tr>
									</thead>
									<tbody>
										<?php
	
	
	  $res = $connection->query(" 
	  
SELECT  CONCAT(b.batchname,' [',a.studentfees,']') AS Batch,a.studentfees - SUM(c.paymentamount)  AS Balance
 FROM studentbatchmapping AS a JOIN batchmaster AS b ON a.batchcode=b.batchcode 
 LEFT JOIN paymentdetails AS c ON b.batchcode=c.batchcode AND a.studentcode=c.studentcode  
 JOIN studentmaster AS d ON a.studentcode = d.studentcode
 WHERE a.studentcode ='$userid' ;"); 
	   $Sno = 1; 
				while($row = mysqli_fetch_row($res))
					{
						
				?>
				<tr class="record">
				<td><?php echo $Sno; ?></td>
				<td ><?php echo $row[0]; ?></td>
				<td ><?php echo $row[1]; ?></td>
				    
				
				</tr>
				<?php
				$Sno=$Sno+1;
					}



	?>
									</tbody>
								</table>
                                <!-- end chats -->
                            </div>
                            <!-- end scrollbar -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4">
                            <h4 class="title">Payment History</h4>
                            <!-- begin scrollbar -->
                            <div data-scrollbar="true" data-height="280px" class="bg-silver">
                                <!-- begin chats -->
                                 <table class="table table-condensed">
									<thead>
										<tr>
											 
											<th>S. No</th>
											<th>Date</th> 
											<th>Payment</th>
										</tr>
									</thead>
									<tbody>
										<?php
	
	
	  $res = $connection->query(" 
	  
	   SELECT DATE_FORMAT(a.paymentdate, '%d-%b-%y') as paymentdate, 
  paymentamount AS Payment FROM paymentdetails  AS a 
 JOIN studentbatchmapping AS b ON  a.studentcode = b.studentcode AND
 a.batchcode = b.batchcode JOIN batchmaster AS c ON a.batchcode = c.batchcode 
 JOIN `paymentmodemaster` AS d ON a.paymentmodeid = d.`paymentmodecode`
 WHERE b.`studentcode` ='$userid' ;"); 
	   $Sno = 1; 
				while($row = mysqli_fetch_row($res))
					{
						
				?>
				<tr class="record">
				<td><?php echo $Sno; ?></td>
				<td ><?php echo $row[0]; ?></td>
				<td ><?php echo $row[1]; ?></td> 
				<td ><i class='fa  fa-print  fa-lg m-r-5 '></i></td> 
				    
				
				</tr>
				<?php
				$Sno=$Sno+1;
					}



	?>
									</tbody>
								</table>
                                <!-- end chats -->
                            </div>
                            <!-- end scrollbar -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4">
                            <h4 class="title">Payment Schedule</h4>
                            <!-- begin scrollbar -->
                            <div data-scrollbar="true" data-height="280px" class="bg-silver">
                                <!-- begin todolist -->
                                 <table class="table table-condensed">
									<thead>
										<tr>
											<th></th>
											<th>Date</th>
											<th>Amount</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										 
									</tbody>
								</table>
                                <!-- end todolist -->
                            </div>
                            <!-- end scrollbar -->
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end profile-section -->
            </div>
			<!-- end profile-container -->
		</div>
		
			 </div>
			 
            <!-- end row -->
		</div>
                     
                   
                  
  
 
  <!-- end #content -->
  <!-- begin theme-panel -->
  <!-- end theme-panel -->
  <!-- begin scroll to top btn -->
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
  <i class="fa fa-angle-up"></i>
  </a>
  <!-- end scroll to top btn -->
  </div>
  <!-- end page container -->
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
  <script src="../assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
  <script src="../assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
  <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
  <script src="../assets/crossbrowserjs/html5shiv.js"></script>
  <script src="../assets/crossbrowserjs/respond.min.js"></script>
  <script src="../assets/crossbrowserjs/excanvas.min.js"></script>
  <![endif]-->
  <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
  <!-- ================== END BASE JS ================== -->
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="../assets/js/inbox.demo.min.js"></script>
  <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="../assets/plugins/bootstrap-daterangepicker/moment.js"></script>
  <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="../assets/js/form-plugins.demo.min.js"></script>
  <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="../assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
  <script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="../assets/plugins/masked-input/masked-input.min.js"></script>
  <script src="../assets/plugins/password-indicator/js/password-indicator.js"></script>
  <script src="../assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
  <script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
  <script src="../assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
  <script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
  <script src="../assets/plugins/switchery/switchery.min.js"></script>
  <script src="../assets/plugins/powerange/powerange.min.js"></script>
  <script src="../assets/js/form-slider-switcher.demo.min.js"></script>
  <script src="../assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="../assets/js/form-wizards.demo.min.js"></script>
  <script src="../assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  <script>
    $(document).ready(function() {
    	App.init();
    	Inbox.init();
    	FormPlugins.init(); 
    FormSliderSwitcher.init();
	FormWizard.init();
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>