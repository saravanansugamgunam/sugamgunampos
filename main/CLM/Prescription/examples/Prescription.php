
<!DOCTYPE html>

<head>
<meta charset="utf-8">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
<style>
body {
font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
}
</style>
<link href="../assets/jquery.signaturepad.css" rel="stylesheet">
<!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->

</head>
<body>
  
<form method="post" action="">
 


<div class="sigPad" id="smoothed" name="smoothed" style="width:1000px;">
 
<ul class="sigNav"> 
<li class="clearButton"><a href="#clear">Clear</a></li>
</ul>

<div id="html-content-holder" >
       
<canvas class="pad" width="1000" height="350"></canvas>
<input type="hidden" name="output-2" class="output">
 
</div> 

	 
    </div>
	
    <input id='btn-Preview-Image' type="button" value="Ok"/> 
	 
	
    <a id="btn-Convert-Html2Image" href="#">Save</a>
     
	
    <h3>Preview :</h3>
	

    <div id="previewImage">
    </div>
	 <img id="myImg"  width="107" height="98">  
<script>



$(document).ready(function(){

	
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable
 
    $("#btn-Preview-Image").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });

	$("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png"); 
	 document.getElementById("myImg").src = imgageData; 
	Upload();
 

	 
    // Now browser starts downloading it instead of just showing it
	
	
  //  var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
  //  $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
	
	
	});

});
 

function Upload()
{
	var base64image = $('#myImg').attr('src');
	var datas = "&base64image="+base64image;
	
	alert(datas);
	
	 $.ajax({
		   url:"upload.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	 
		// LoadPaymentDetails();
		  // CalculatePaymentTotal();
		   }
		  });
		  
}
</script>



</form> 

 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../assets/numeric-1.2.6.min.js"></script> 
<script src="../assets/bezier.js"></script> 
<script src="../jquery.signaturepad.js"></script> 
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
<script>
    $(document).ready(function() {
      $('#linear').signaturePad({drawOnly:true, lineTop:200});
      $('#smoothed').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:500});
      $('#smoothed-variableStrokeWidth').signaturePad({drawOnly:true, drawBezierCurves:true, variableStrokeWidth:true, lineTop:200});
    });
  </script> 
<script src="../assets/json2.min.js"></script>
  

</body>
