<!DOCTYPE HTML>
<html>
<head>
<?php 
include("j.php");
?>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
var dataPoints = [];
var chart = new CanvasJS.Chart("chartContainer",{
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Top Oil Reserves"
	},
	axisY: {
		title: "Sales(Rs)",
		valueFormatString:  "#,##0.##",
	},
	 axisX:{
   valueFormatString: "#,##0.##",
    interval: 1,
 },
 
	data: [{
		type: "column",
		 indexLabel: "{y}",
         indexLabelPlacement: "outside",  
         indexLabelOrientation: "horizontal",		
		dataPoints : dataPoints,
	}]
});
$.getJSON("1.json", function(data) {  
	$.each(data, function(key, value){
		dataPoints.push({x: value[0], y: parseInt(value[1])});
	});	
	chart.render();
});
}
</script>

</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>
