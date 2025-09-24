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
  
    include("../../connect.php");
    $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start(); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
      if(isset($_SESSION['SESS_LAST_NAME']))
    {
    //echo 'Session Active';
    
    }
    else
    {
    //echo 'Session In Active';
    $url='../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; '.$url.'">';
    }    ?>
  <head>
    <meta charset="utf-8" />
    <title>SugamGunam</title>
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
	<link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
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
  <body onload="GetBiometricTabel();">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in">
      <span class="spinner"></span>
    </div>
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
                   <a href="../logout.php">Log Out</a>
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
        <!-- begin sidebar scrollbar --> 
          <!-- begin sidebar user -->
          <!-- end sidebar user -->
          <!-- begin sidebar nav -->
            <?php include("CLMSidePanel.php") ?>
      </div> 
       

                        
							
 <div id="content" class="content"> 
       <div class="col-md-12">
			       
			        
					
					 
<html xmlns="http://www.w3.org/1999/xhtml">

    <link href="../assets/Custom/sweetalert.css" rel="stylesheet"/>
    <script src="../assets/Custom/sweetalert2.min.js"></script>
	 
    <title>MFS100 Web Test</title>
    <style type="text/css">
        body {
            font-family: 'Segoe UI';
            background-color: #DDDDDD;
            margin: 0px 5px 5px 5px;
            padding: 0px 5px 5px 5px;
            color: #555;
            font-size: 12px;
        }

        .panel {
            background-color: #FFFFFF;
            -moz-user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            margin: 12px 12px;
            padding: 6px 12px;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            -moz-user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn-50 {
            width: 50px;
        }
        .btn-100 {
            width: 100px;
        }

        .btn-150 {
            width: 150px;
        }

        .btn-200 {
            width: 205px;
        }

        .btn-primary {
            color: #FFF;
            background-color: #428BCA;
            border-color: #357EBD;
        }

            .btn-primary:hover {
                color: #FFF;
                background-color: #357EBD;
                border-color: #428BCA;
            }

        .form-control {
            display: block;
            width: 100%;
            height: 24px;
            padding: 3px 6px;
            font-size: 12px;
            /*line-height: 1.42857;*/
            color: #555;
            background-color: #FFF;
            background-image: none;
            border: 1px solid #bdbdbd;
            border-radius: 4px;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
            transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        }

        textarea.form-control {
            height: auto;
        }

        .text-bold {
            font-weight: bold;
        }

        .img {
            min-width: 300px;
            min-height: 300px;
            width: 300px;
            height: 300px;
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

        function Capture() {
            try {
				// alert(1)
                // document.getElementById('txtStatus').value = "4";
				// alert(2)
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtImageInfo').value = "";
                document.getElementById('txtIsoTemplate').value = "";
                document.getElementById('txtAnsiTemplate').value = "";
                document.getElementById('txtIsoImage').value = "";
                document.getElementById('txtRawData').value = "";
                document.getElementById('txtWsqData').value = "";
// alert(3)
                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) {
// alert(4)
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
				// alert(5)
                alert(e);
            }
            return false;
			
			
        }

        function Verify() {
            try {
                var isotemplate = document.getElementById('txtIsoTemplate').value;
                var isotemplateData = document.getElementById('txtIsoTemplatefromData').value;
                var res = VerifyFinger(isotemplate, isotemplateData);

                if (res.httpStaus) {
                    if (res.data.Status) {
                        // alert("Finger matched");
						document.getElementById("txtMatchStatus").value = 1;
                    }
                    else {
                        if (res.data.ErrorCode != "0") {
                            alert(res.data.ErrorDescription);
                        }
                        else {
                            // alert("Finger not matched");
                        }
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

        function Match() {
            try {
                var isotemplate = document.getElementById('txtIsoTemplate').value;
                var res = MatchFinger(quality, timeout, isotemplate);

                if (res.httpStaus) {
                    if (res.data.Status) {
                        alert("Finger matchede");
                    }
                    else {
                        if (res.data.ErrorCode != "0") {
                            alert(res.data.ErrorDescription);
                        }
                        else {
                            alert("Finger not matched");
                        }
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

        function GetPid() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array(); // You can add here multiple FMR value
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "UNKNOWN", "", "");

                var res = GetPidData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.PidData.Pid
                        document.getElementById('txtSessionKey').value = res.data.PidData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.PidData.Hmac
                        document.getElementById('txtCi').value = res.data.PidData.Ci
                        document.getElementById('txtPidTs').value = res.data.PidData.PidTs
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
        function GetProtoPid() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array(); // You can add here multiple FMR value
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "UNKNOWN", "", "");

                var res = GetProtoPidData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.PidData.Pid
                        document.getElementById('txtSessionKey').value = res.data.PidData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.PidData.Hmac
                        document.getElementById('txtCi').value = res.data.PidData.Ci
                        document.getElementById('txtPidTs').value = res.data.PidData.PidTs
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
        function GetRbd() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array();
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "LEFT_INDEX", 2, 1);
                Biometrics["1"] = new Biometric("FMR", isoTemplateFMR, "LEFT_MIDDLE", 2, 1);
                // Here you can pass upto 10 different-different biometric object.


                var res = GetRbdData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.RbdData.Rbd
                        document.getElementById('txtSessionKey').value = res.data.RbdData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.RbdData.Hmac
                        document.getElementById('txtCi').value = res.data.RbdData.Ci
                        document.getElementById('txtPidTs').value = res.data.RbdData.RbdTs
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

        function GetProtoRbd() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array();
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "LEFT_INDEX", 2, 1);
                Biometrics["1"] = new Biometric("FMR", isoTemplateFMR, "LEFT_MIDDLE", 2, 1);
                // Here you can pass upto 10 different-different biometric object.


                var res = GetProtoRbdData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.RbdData.Rbd
                        document.getElementById('txtSessionKey').value = res.data.RbdData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.RbdData.Hmac
                        document.getElementById('txtCi').value = res.data.RbdData.Ci
                        document.getElementById('txtPidTs').value = res.data.RbdData.RbdTs
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
		
		function tet()
		{
			document.getElementById('txtStatus').value = "4";
		}

		</script>
 

    <table width="100%" style="padding-top:0px;">
          
        <tr>
             
            <td width="300px" height="300px" align="center" class="img">
                <img src="../assets/img/Biometric.jpg"  id="imgFinger" width="300px" height="300px" alt="Finger Image" />
            </td>
            <td>
               
            </td>
        </tr>
    </table>
	<br>
	<a href="javascript:;" class="btn btn-sm btn-success" onclick= "CaptureAndValidate();">Punch Attendace</a>
	
	<div style="display:none;" class="panel"> 
	
	 
	
	
	<input type='text' id='txtCurrentRow' name ='txtCurrentRow'  value =1  />
	<input type='text' id='txtMatchStatus' name ='txtMatchStatus'  value =0 />
	 
        
		
		<div id='DivBioCode'></div>
		
		
    </div>
	
	
	<div style="display:none;">
	
	 <table align="left" border="0" style="width:100%; padding-right:20px;">
                    <tr>
                        <td style="width: 100px;">Key:</td>
                        <td colspan="3">
                            <input type="text" value="" id="txtKey" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="width: 100px;">Serial No:</td>
                        <td align="left" style="width: 150px;" id="tdSerial"></td>
                        <td align="left" style="width: 100px;">Certification:</td>
                        <td align="left" id="tdCertification"></td>
                    </tr>
                    <tr>
                        <td align="left">Make:</td>
                        <td align="left" id="tdMake"></td>
                        <td align="left">Model:</td>
                        <td align="left" id="tdModel"></td>
                    </tr>
                    <tr>
                        <td align="left">Width:</td>
                        <td align="left" id="tdWidth"></td>
                        <td align="left">Height:</td>
                        <td align="left" id="tdHeight"></td>
                    </tr>
                    <tr>
                        <td align="left">Local IP</td>
                        <td align="left" id="tdLocalIP"></td>
                        <td align="left">Local MAC:</td>
                        <td align="left" id="tdLocalMac"></td>
                    </tr>
                    <tr>
                        <td align="left">Public IP</td>
                        <td align="left" id="tdPublicIP"></td>
                        <td align="left">System ID</td>
                        <td align="left" id="tdSystemID"></td>
                    </tr>
                </table>
				
	<table width="100%">
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
                    Captured for Matching
                </td>
                <td>
                    <textarea id="txtIsoTemplate" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
			 <tr>
                <td>
                    FromDatanase
                </td>
                <td>
                    <textarea id="txtIsoTemplatefromData" style="width: 100%; height:50px;" class="form-control"> </textarea>
                </td>
            </tr>
			
			
            <
        </table>
		
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
	</div>
	
	
	<?php
   
  
 // echo "1";
 include("../../connect.php");
 ?>
	<script>
	function SaveBiometric()
	{
		 var Status = document.getElementById("txtStatus").value; 
		   var ImaegInfo = document.getElementById("txtImageInfo").value;
		    var ISOTemplate = document.getElementById("txtIsoTemplate").value;
			  
			 var datas = "&Status="+Status+"&ImaegInfo="+ImaegInfo+"&ISOTemplate="+encodeURIComponent(ISOTemplate);	
			   alert(datas);
			    $.ajax({
		   url:"SaveBio.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		    alert(data);
		   }
		  });
		  
	}
	
	
	function UpdateAttendance(x)
	{
		 var UserID = x;  
			  
			 var datas = "&UserID="+UserID;	
			   // alert(datas);
			    $.ajax({
		   url:"Save/UpdateAttendance.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		    // alert(data);
		   }
		  });
		  
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
	
	
	function LoadDataForVerification()
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
	 
	 function ValidateFingerPrint()
{
	  
	  var i;
	  var TotalRecord =  document.getElementById("txtTotalData").value;
 
		for (i = 0; i < TotalRecord; i++) {
	 
		var MatchStatus = document.getElementById("txtMatchStatus").value;
		
		if(MatchStatus==0)
		{
		var SelectedRow = document.getElementById("txtCurrentRow").value;  
		 // alert(document.getElementById("tblBioCode").rows[SelectedRow].cells[2].innerHTML)
		var Id = document.getElementById("tblBioCode").rows[SelectedRow].cells[3].innerHTML;  
		document.getElementById("txtIsoTemplatefromData").value = Id; 
		document.getElementById("txtCurrentRow").value= (SelectedRow * 1) +1;
		Verify();
		}
		else
		{
		var UserName=document.getElementById("tblBioCode").rows[SelectedRow].cells[2].innerHTML;  
		var UserID=document.getElementById("tblBioCode").rows[SelectedRow].cells[1].innerHTML;  
		 
	 
				UpdateAttendance(UserID);
				
				swal({
    title: "Hi, Welcome",
    text: UserName,
    type: "success"
}).then(function() {
    // window.location = "redirectURL";
    window.location.reload(1);
});

		break; 

		} 
		// alert(MatchStatus);
}

 // alert(MatchStatus);

if(MatchStatus==0)
{
	// swal("Please try again!!","Finger Not Matching with Database","warning");
	  swal({
    title: "Please try again!!!",
    text: "Finger Not Matching with Database!",
    type: "warning"
}).then(function() {
    // window.location = "redirectURL";
    window.location.reload(1);
});
	
	  
	  // setTimeout(function(){
   // window.location.reload(1);
// }, 1000);
}
 
}
	
	function CaptureAndValidate()
	{
		Capture();
		ValidateFingerPrint();
	}
	
	function GetBiometricTabel()
	{
		 // var UserID = document.getElementById("txtInvoiceNo").value;
		 var UserID = 1;
		 
		var datas = "&UserID="+UserID;	
	  	   // alert(datas);
		 $.ajax({
		   url:"Load/LoadBiometricTable.php",
		   method:"POST",
		   data:datas,	 
		   success:function(data)
		   {	
		   
			 $( '#DivBioCode' ).html(data); 
		
		   }
		  });
		   
	}
	
	</script>
    
</body>
</html>

					
					
					
					
					
					
					
					
					
					
					
					
					
					
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
                     
                    </div>
                    </div>
  </div>
	
  <!-- end col-10 -->
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
  <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="../assets/plugins/DataTables/js/dataTables.fixedColumns.js"></script>
	<script src="../assets/js/table-manage-fixed-columns.demo.min.js"></script>
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
	<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="../assets/plugins/DataTables/js/dataTables.tableTools.js"></script>
	<script src="../assets/plugins/DataTables/js/dataTables.colVis.js"></script>
	<script src="../assets/js/table-manage-colvis.demo.min.js"></script>
	<script src="../assets/js/table-manage-tabletools.demo.min.js"></script>
	<script src="../assets/js/table-manage-combine.demo.min.js"></script>
	
  <script src="../assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  <script>
    $(document).ready(function() {
    	App.init();
    	Inbox.init();
    	FormPlugins.init(); 
    FormSliderSwitcher.init();
	FormWizard.init(); 
	
	TableManageFixedColumns.init();
	 
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>