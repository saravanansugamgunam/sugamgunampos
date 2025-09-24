<script>
$(document).ready(function(){
  // $("#myInputDocument").on("keyup", function() {
  $("#myInputDocument").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTableDocument tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<style>
p.ridge {border-style: ridge;}

</style>
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  $GroupID = $_SESSION['SESS_GROUP_ID'];
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);  
  $TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]);  
 
  
 // echo "1";

$currentdate = date("Y-m-d H:i:s");
$result = mysqli_query($connection, " 
				SELECT paitentname,mobileno,email, DATE_FORMAT(createdin,'%d-%m-%Y') AS createdin, 
				ROUND(DATEDIFF(CURRENT_DATE,dob) / 365.25,0) AS age,gender,discountstatus,
				referenceno,address,(topay-receipt), medicinediscount,consultingdiscount,therapydiscount,maritalstatus
				FROM paitentmaster  
				WHERE paitentid ='$PaitentID' 
");
  
 echo "<div>";
while($data = mysqli_fetch_row($result))
{
	echo "<table>";
	echo "<tr>";
	echo "<td><p>Token No:&nbsp;&nbsp;<b>"; echo  $TokenNo ; echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><p>Name:&nbsp;&nbsp;<b>"; echo  $data[0] ; echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Gender:&nbsp;&nbsp;<b>"; echo  $data[5] ; echo "</p></td>";
	echo "<td><p>Reference:&nbsp;&nbsp;<b>"; echo  $data[7] ; echo "
	<a  href='#ModalReference'  data-toggle='modal'  ><i class='fa fa-2x fa-pencil text-info'>   </i></a></p>

	</td> 
	";

	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	if($data[9]>0)
	{
		echo "<td><p style='font-size: 20px;color:red;'>Outstanding:&nbsp;&nbsp;<b>"; echo  $data[9] ; echo "</p></td>";
	}
	else if($data[9]<0)
	{
		echo "<td><p style='font-size: 20px;color:green;'>Outstanding:&nbsp;&nbsp;<b>"; echo  $data[9] ; echo "</p></td>";
	}
	else
	{
		echo "<td><p style='font-size: 20px;color:black;'>Outstanding:&nbsp;&nbsp;<b>"; echo  $data[9] ; echo "</p></td>";
	}
	
		echo "</tr>";
	echo "<tr>";
	echo "<td><p>Mobile:&nbsp;&nbsp;<b>"; echo  $data[1] ; echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Age:&nbsp;&nbsp;<b>"; if($data[4]>100) {echo "-"; } else {echo  $data[4] ;} echo "</p></td>";
	echo "<td><p>Address:&nbsp;&nbsp;<b>"; echo  $data[8] ; echo "</p></td>";
		echo "</tr>";
	echo "<tr>";
	echo "<td><p>Email:&nbsp;&nbsp;<b>"; echo  $data[2] ; 
	
echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Marital Status:&nbsp;&nbsp;<b>";
	echo  $data[13];
	echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Reg. Date:&nbsp;&nbsp;<b>";
	echo  $data[3];
	echo "</p></td>";
	echo "</tr>";
	echo "<tr>";

	
	
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "</table>";
	echo "</div>";
	
	echo "<div  style='float:right'>";
	echo "<table>";
if($data[6]=='YES')
	{
		echo "<tr><td style='font-size: 15px;color:red;'><b>
		Med: $data[10]%,Con: $data[11]%,Thy: $data[12]%</b>
		&nbsp;&nbsp;";
		if($GroupID==1)
		{
			echo "<a  href='#ModalConncession'  data-toggle='modal'  ><i class='fa  fa-pencil-square-o text-info'>   </i></a>";
		} 
		echo "</td></tr>";
	}
	else
	{
		echo "<tr><td>
		Med: $data[10]%,Con: $data[11]%,Thy: $data[12]%</b>
		&nbsp;&nbsp;";
		if($GroupID==1)
		{
			echo "<a  href='#ModalConncession'  data-toggle='modal'  ><i class='fa  fa-pencil-square-o text-info'>   </i></a>";
		} 
		echo "</td></tr>";
	} 


	echo "</table>";
	echo "</div>";
  
  

								?>

<div id="ModalConncession" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Discount Detail</h4>
                </div>

                <div class="modal-body">
 
                <label>Medicine Discount %</label>
                <input type='number' id='txtDiscountMedicine' name='txtDiscountMedicine' class='form-control' 
                style="width:50%;" value=<?php echo  $data[10] ;?> />

                <label>Consulting Discount %</label>
                <input type='number' id='txtDiscountConsulting' name='txtDiscountConsulting' class='form-control' 
                style="width:50%;" value=<?php echo  $data[11] ;?> />

                <label>Therapy Discount %</label>
                <input type='number' id='txtDiscountTherapy' name='txtDiscountTherapy' class='form-control' 
                style="width:50%;"  value=<?php echo  $data[12] ;?> />


                </div>

                <div class="modal-footer">

                <button type="button" class="btn btn-success" data-dismiss="modal" 
                onclick ='SaveDiscountPaitent()'>Update Discount</button>    
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php } ?>
    
 