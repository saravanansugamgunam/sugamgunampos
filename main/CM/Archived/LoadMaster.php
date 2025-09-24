<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	   
 <script>
$(document).ready(function(){
  $("#txtCourse").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#ProjectTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  $("#txtBatch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#ClientTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  
   $("#txtStudent").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#SubProjectTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  
  
   $("#txtTag").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#TagTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  
  
});
</script>
<style>
                                                .vl {
                                                border-left: 1px solid #eeeeee;
                                                height: 175px;
                                                position: absolute;
                                                left: 25%;
                                                margin-left: -3px;
                                                top: 50;
                                                }
                                                .MasterInput {
                                                border-style: solid;
                                                border-radius: 5px; 
                                                border-width: 1px;
                                                border-color: #CCCCCC;
                                                background-color: #FFFFFF;
                                                text-align: left;
												padding: 5px 5px 5px 5px;
                                                }
                                                .MasterSelect {
                                                border-style: solid;
                                                border-radius: 5px; 
                                                border-width: 1px;
                                                border-color: #CCCCCC;
                                                background-color: #FFFFFF;
                                                text-align: center;
												padding: 4px 4px 4px 4px;
                                                }
												  .MasterButton {
                                                border-style: solid;
                                                border-radius: 5px; 
                                                border-width: 1px;
                                                border-color: #CCCCCC;
                                                background-color: #337ab7;
                                                text-align: center;
													color: white;
												padding: 5px 5px 5px 5px;
                                                }
                                                .MasterDate {
                                                border-style: solid;
                                                border-radius: 5px; 
                                                border-width: 1px;
                                                border-color: #CCCCCC;
                                                background-color: #FFFFFF;
											
                                                text-align: left;
                                                }
                                             </style>
											 

											 

<?php
include("dataconfig.php");
session_cache_limiter(FALSE);
session_start();
 $CompanyID = $_SESSION['RMS_CompanyID'];
   
   $MasterType = mysqli_real_escape_string($connection,$_POST["MasterType"]); 
    
if ($MasterType=="Project")
{
		
							
	echo "<div class='row'>";
	echo "  
<div id='ModalProject' class='modal-window'>
  <div>
    <a href='#modal-close' title='Close' class='modal-close'>&times;</a>
	<input type ='hidden' id='txtProjectId' name ='txtProjectId' />
	
    <h1>Change Project Stage</h1>
    <div> 
	<select id='cmbProjectStageNew' name ='cmbProjectStageNew' class='MasterSelect' > 
	<option value='1'>LMS</option>
	<option value='2'>PMS</option>
	<option value='3'>CRM</option>
	</select>
	<button type='button' class='MasterButton' onclick='SaveProjectStage();' data-dismiss='modal' >  Change Stage </button> 
	 
	<a href='#modal-close' title='Close'  class='btn btn-secondary modal-closebutton'  >Close</a>
	</div>
	 
  </div>
 
		
</div>";


 echo" <div class='modal fade' id='ModalProject1'>
    <div class='modal-dialog   modal-sm '>
      <div class='modal-content'>
      
        <!-- Modal Header -->
        <div class='modal-header'>
          <h4 class='modal-title'>Modal Heading</h4>
           <input type ='hidden' id='txtProjectId' name ='txtProjectId' />
		   
        </div>
        
        <!-- Modal body -->
        <div class='modal-body'>
    <select id='cmbProjectStageNew' name ='cmbProjectStageNew' class='MasterSelect' > 
	<option value='1'>LMS</option>
	<option value='2'>PMS</option>
	<option value='3'>CRM</option>
	</select>
	<button type='button' class='MasterButton' onclick='SaveProjectStage();' data-dismiss='modal' >  Change Stage </button> 
        </div>
        
        <!-- Modal footer -->
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        </div>
        
      </div>
    </div>
  </div>";
							
	echo "<h4>Project Master</h4>
	 
	<br>
	<input  id='txtCourse' class='MasterInput' name ='txtCourse' placeholder='Project Name' type='text' />
	<select id='cmbProjectStage' name ='cmbProjectStage' class='MasterSelect' > 
	<option value='1'>LMS</option>
	<option value='2'>PMS</option>
	<option value='3'>CRM</option>
	</select>
	 
	<button type='button' class='MasterButton' onclick='SaveProject();'  >  Add Project </button> 
	
	</div><br>
	";
$result = mysqli_query($connection, "SELECT projectid, projectname,stagename, projectstatus FROM   projectmaster AS a JOIN pms_stagemaster AS b ON a.stageid=b.stageid  WHERE companyid='$CompanyID' ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblProjectMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>ProjectCode</th>    
		<th width='50%'><a href=\"javascript:SortTable(2,'T');\">Project Name</a></th>    
		<th width='20%'> <a href=\"javascript:SortTable(3,'T');\">Stage</a></th>   
		<th width='10%'><a href=\"javascript:SortTable(4,'T');\">Status</a></th>   
		<th width='10%'></th>   
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='ProjectCode'>$data[0]</td>
  <td width='50%'>$data[1]</td>  
   <td width='20%'>$data[2]</td>  
   <td width='10%'>$data[3]</td>  
   <td width='10%' id='login' onclick='GetPointID(this)'><a href='#ModalProject'  ><i class='fa fa-edit'></i></a></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}



if ($MasterType=="SubProject")
{
	echo "<div class='row'>
	<h4>Subproject Master</h4>
	";
	?>
	 <select   class='MasterSelect' id="SelectProject"  name="SelectProject"  data-size="10" data-live-search="true" data-style="btn-white">
      <option value='' selected>Select Project</option>
       <?php   
		 $CompanyID = $_SESSION['RMS_CompanyID'];
		 $sqli = "SELECT projectid,projectname FROM  projectmaster  WHERE companyid ='$CompanyID' AND projectstatus='Active' order by projectname";
		 $result = mysqli_query($connection, $sqli);
		 while ($row = mysqli_fetch_array($result)) {
		echo '<option value='.$row['projectid'].'>'.$row['projectname'].'</option>';
			  }	
			 ?>
           </select>
		   
		   <?php  echo " 
			 
	 
	<br>
	<br>
	<input  id='txtStudent' class='MasterInput' name ='txtStudent' placeholder='Subproject Name' type='text' />
	 
	<button type='button' class='MasterButton' onclick='SaveSubProject();'  >  Add Subproject </button> 
	
	</div><br>
	";
$result = mysqli_query($connection, "SELECT subprojectid, subproject, subprojectstatus FROM subprojectmaster where  clientid ='$CompanyID' ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>SubProjectCode</th>    
		<th width='70%'><a href=\"javascript:SortTable(2,'T');\">Subproject Name</a></th>    
		<th><a href=\"javascript:SortTable(3,'T');\">Status</a></th>   
		</tr> </thead> <tbody id='SubProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden>$data[0]</td>
  <td width='70%'>$data[1]</td>  
   <td width='20%'>$data[2]</td>  
  </tr>";
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}




if ($MasterType=="Client")
{
	echo "<div class='row'>
	<h4>Client Master</h4>
	 
	<br>
	<input  id='txtBatch' class='MasterInput' name ='txtBatch' placeholder='Client Name' type='text' />
	<button type='button' class='MasterButton' onclick='SaveClient();'  >  Add Client </button> 
	
	</div><br>
	";
$result = mysqli_query($connection, "SELECT clientid,childcompany,activestatus FROM `clientmaster`  WHERE clientcode='$CompanyID' ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable'  >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden >clientid</th> 
		<th width='70%'><a href=\"javascript:SortTable(2,'T');\">Client Name</a></th>
		<th><a href=\"javascript:SortTable(3,'T');\">Status</a></th>  
		</tr> </thead> <tbody id='ClientTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden>$data[0]</td>
  <td width='70%'>$data[1]</td> 
   <td width='20%'>$data[2]</td>   
  </tr>";
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}


if ($MasterType=="Tag")
{
	echo "<div class='row'>
	<h4>Tag Master</h4>
	 
	<br>
	<input  id='txtTag' class='MasterInput' name ='txtTag' placeholder='Tag Name' type='text' />
	<button type='button' class='MasterButton' onclick='SaveTag();'  >  Add Tag </button> 
	
	</div><br>
	";
$result = mysqli_query($connection, "SELECT tagid,tagname,'Active' FROM `tagmaster`  WHERE clientid='$CompanyID' ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable'  >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden >clientid</th> 
		<th width='70%'><a href=\"javascript:SortTable(2,'T');\">Tag</a></th>
		<th><a href=\"javascript:SortTable(3,'T');\">Status</a></th>  
		</tr> </thead> <tbody id='TagTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden>$data[0]</td>
  <td width='70%'>$data[1]</td> 
   <td width='20%'>$data[2]</td>   
  </tr>";
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}



if ($MasterType=="User")
{
	echo "<div class='row'>
	<h4>Client Master</h4>
	<label >
	Client Name
	</label>
	<br>
	<input  id='txtBatch' class='MasterInput' name ='txtBatch' placeholder='Client Name' type='text' />
	<button type='button' class='MasterButton'  >  Add </button> 
	
	</div><br>
	";
$result = mysqli_query($connection, "SELECT clientid,childcompany,activestatus FROM `clientmaster`  WHERE clientcode='1' ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable'  >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden >clientid</th> 
		<th width='70%'><a href=\"javascript:SortTable(2,'T');\">Client Name</a></th>
		<th><a href=\"javascript:SortTable(3,'T');\">Status</a></th>  
		</tr> </thead> <tbody>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden>$data[0]</td>
  <td width='70%'>$data[1]</td> 
   <td width='20%'>$data[2]</td>   
  </tr>";
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
 


?> 

<style>
.modal-window {
  position: fixed;
  background-color: rgba(200, 200, 200, 0.75);
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 999;
  opacity: 0;
  pointer-events: none;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transition: all 0.3s;
}

.modal-window:target {
  opacity: 1;
  pointer-events: auto;
}

.modal-window>div {
  width: 400px;
  position: relative;
  margin: 10% auto;
  padding: 2rem;
  background: #fff;
  color: #444;
}

.modal-window header {
  font-weight: bold;
}

.modal-close {
  color: #aaa;
  line-height: 50px;
  font-size: 80%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  width: 70px;
  text-decoration: none;
}

.modal-closebutton {
  color: #aaa;
  line-height: 50px;
  font-size: 80%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 50;
  width: 70px;
  text-decoration: none;
}
.modal-close:hover {
  color: #000;
}

.modal-window h1 {
  font-size: 150%;
  margin: 0 0 15px;
}
</style>