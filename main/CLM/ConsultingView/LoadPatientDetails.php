<script>
$(document).ready(function() {
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
p.ridge {
    border-style: ridge;
}
</style>
<?php
include("../../../connect.php");
session_cache_limiter(FALSE);
session_start();
$GroupID = $_SESSION['SESS_GROUP_ID'];
$PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);
$InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);



$currentdate = date("Y-m-d H:i:s");
$result = mysqli_query($connection, " 
				SELECT paitentname,mobileno,email, DATE_FORMAT(createdin,'%d-%m-%Y') AS createdin, 
				CONCAT
        (
            FLOOR((TIMESTAMPDIFF(MONTH, dob, CURDATE()) / 12)), ' Yrs ',
            MOD(TIMESTAMPDIFF(MONTH, dob, CURDATE()), 12) , ' Mth'
        ) AS age,
				
				gender,discountstatus,
				referenceno,address,(topay-receipt), medicinediscount,consultingdiscount,therapydiscount,
				(SELECT COUNT(*) FROM therapybookingdetails  WHERE  bookinguniqueid ='$InvoiceNo' AND bookingstatus ='Booked' and paitentid='$PaitentID') as PendingBooking,
				(SELECT COUNT(*) FROM therapybookingdetails  WHERE  bookinguniqueid ='$InvoiceNo' AND bookingstatus ='Closed' and paitentid='$PaitentID') as CompletedBooking,
				(SELECT therapystatus FROM therapybookingmaster  WHERE  bookinguniqueid ='$InvoiceNo' and paitentid='$PaitentID') as Status,
					CONCAT('../CLM/',patientphoto),tag,profession
				FROM paitentmaster  
				WHERE paitentid ='$PaitentID' 
");

echo "<div>";
while ($data = mysqli_fetch_row($result)) {
    if($data[16]=='../CLM/-' || $data[16]=='../CLM/')
	{
$PatientPhoto='../CLM/uploads/dummyuser.jpeg';
	}
	else
	{
		$PatientPhoto=$data[16];
	}
	echo "<table>";

	echo "<tr>";
	
	echo "<td rowspan=3> 
 


	<img src='$PatientPhoto' class='email-user' width='100' 
	style='padding: 3px; border-radius: 20%;' /></td>";
	
	echo "<td><p>Name:&nbsp;&nbsp;<b>";
	echo  $data[0]; 
	
	
	echo "&nbsp;&nbsp;
	<a  href='#ModalReference'  data-toggle='modal' onclick='LoadPaintentDetailsforEdit()' ><i class='fa  fa-pencil-square-o text-info'>   </i></a>
	<br>  <label style='color:red'><b>Tag: $data[17]</b></label> 
	</p>
	
	</td>";
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Gender:&nbsp;&nbsp;<b>";
	echo  $data[5];
	echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Profession:&nbsp;&nbsp;<b>";
	echo  "$data[18] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo " </p>

	</td> 
	";
	echo "<input type='hidden' namd='txtPatientName' id='txtPatientName' value='$data[0]'";

	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	if ($data[9] > 0) {
		echo "<td rowspan='4'><p style='font-size: 20px;color:red;text-align:right'>Outstanding:&nbsp;&nbsp;<b>";
		echo  $data[9];
		if ($GroupID == 1) {
			echo "<br><a href='#ModalOutstandingModification' class='btn btn-sm btn-warning' data-toggle='modal'>
        Adjustment  </a>";
			echo "<br>";
			echo "<a href='#' class='btn btn-sm btn-success' disabled data-toggle='modal' onclick='Refund()'>
        Refund  </a>";
			echo "<br>";
			echo "<a href='#' class='btn btn-sm btn-danger' disabled data-toggle='modal' onclick='Transfer()'>
        Transfer  </a>";
		} else {
			echo "<a href='#' onclick='AccessDeniedMessage();' >
        <i class='fa fa-2x  fa-pencil  text-warning'></i>  </a>";
		}
		echo "</p>  </td>";
	} else if ($data[9] < 0) {
		echo "<td rowspan='4'><p style='font-size: 20px;color:green;;text-align:right'>Outstanding:&nbsp;&nbsp;<b>";
		echo  $data[9];
		if ($GroupID == 1) {
			echo "<br><a href='#ModalOutstandingModification' class='btn btn-sm btn-warning' data-toggle='modal'>
        Adjustment  </a>";
		echo "<br>";
			echo "<a href='#myModalRefund' class='btn btn-sm btn-success' data-toggle='modal' onclick='Refund()'>
        Refund  </a>";
		echo "<br>";
			echo "<a href='#myModalTransfer' class='btn btn-sm btn-danger' data-toggle='modal' onclick='Transfer()'>
        Transfer  </a>";
		} else {
			echo "<a href='#' onclick='AccessDeniedMessage();' >
        <i class='fa fa-2x  fa-pencil  text-warning'></i>  </a>";
		}

		echo "</p></td>";
	} else {
		echo "<td><p style='font-size: 20px;color:black;'>Outstanding:&nbsp;&nbsp;<b>";
		echo  $data[9];
		echo "</p></td>";
	}



	echo "</tr>";
	echo "<tr>";
	echo "<td><p>Mobile:&nbsp;&nbsp;<b>";
	echo  $data[1];
		echo "<input type='hidden' name='txtMobileNoforWhatsapp' id='txtMobileNoforWhatsapp' value ='$data[1]' >"  ;
	echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Age:&nbsp;&nbsp;<b>";
		echo  $data[4];
// 	if ($data[4] > 100) {
// 		echo "-";
// 	} else {
// 		echo  $data[4];
// 	}
	
	
	echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Address:&nbsp;&nbsp;<b>";
	echo  $data[8];
	echo "</p></td>";


	// echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	// if ($data[14] > 0 && $data[15] == 'Booked') {
	// 	echo "<td><p style='font-size: 20px;color:blue;'>Status:&nbsp;&nbsp;<b>In Progress</p></td>";
	// }
	// if ($data[14] == 0 && $data[15] == 'Booked') {
	// 	echo "<td><p style='font-size: 20px;color:blue;'>Status:&nbsp;&nbsp;<b>Booked</p></td>";
	// }
	// if ($data[15] == 'Closed') {
	// 	echo "<td><p style='font-size: 20px;color:green;'>Status:&nbsp;&nbsp;<b>Completed</p></td>";
	// }
	// if ($data[15] == 'Cancelled') {
	// 	echo "<td><p style='font-size: 20px;color:orange;'>Status:&nbsp;&nbsp;<b>Cancelled</p></td>";
	// }

	echo "</tr>";
	echo "<tr>";
	echo "<td><p>Email:&nbsp;&nbsp;<b>";
	echo  $data[2];
	echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td><p>Reg. Date:&nbsp;&nbsp;<b>";
	echo  $data[3];
	echo "</p></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	// echo "<td><p>Balance Sitting:&nbsp;&nbsp;<b>";
	// echo  $data[13];
	echo "</p>
	<input type='hidden' id='txtPendingSitting' name='txtPendingSitting' value='$data[13]'/>
	</td>";
	
	
	echo "<td><p>Reference:&nbsp;&nbsp;<b>";
	echo  $data[7];
	echo " </p>

	</td> ";
	echo "</tr>";
	echo "<tr>";



	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "</table>";
	echo "</div>";

	echo "<div  style='float:right'>";
	echo "<table>";
	if ($data[6] == 'YES') {
		echo "<tr><td style='font-size: 15px;color:red;'><b>
		Med: $data[10]%,Con: $data[11]%,Thy: $data[12]%</b>
		&nbsp;&nbsp;";
		if ($GroupID == 1) {
			echo "<a  href='#ModalConncession'  data-toggle='modal'  ><i class='fa  fa-pencil-square-o text-info'>   </i></a>";
		}
		echo "</td></tr>";
	} else {
		echo "<tr><td>
		Med: $data[10]%,Con: $data[11]%,Thy: $data[12]%</b>
		&nbsp;&nbsp;";
		if ($GroupID == 1) {
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
                    style="width:50%;" value=<?php echo  $data[10]; ?> />

                <label>Consulting Discount %</label>
                <input type='number' id='txtDiscountConsulting' name='txtDiscountConsulting' class='form-control'
                    style="width:50%;" value=<?php echo  $data[11]; ?> />

                <label>Therapy Discount %</label>
                <input type='number' id='txtDiscountTherapy' name='txtDiscountTherapy' class='form-control'
                    style="width:50%;" value=<?php echo  $data[12]; ?> />


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-success" data-dismiss="modal"
                    onclick='SaveDiscountPaitent()'>Update Discount</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="ModalOutstandingModification" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modify Outstanding</h4>
            </div>

            <div class="modal-body">

                <label>
                    Total Balance
                </label>
                <input type='number' style='font-size:20px;' id='txtCurrentOutstanding' name='txtCurrentOutstanding'
                    class="form-control" value='<?php echo $data[9]; ?>' disabled />
                <br>
                <label>
                    Revised Amount
                </label>
                <input type='number' id='txtNewOutstanding' name='txtNewOutstanding' class="form-control"
                    style='width:150px;' onblur='CalculateOutstanding()' value='<?php echo $data[9]; ?>' />
                <br>
                <label>
                    Adjusted Amount
                </label>
                <b><input type='number' id='txtAdjustedAmount' name='txtAdjustedAmount' class="form-control"
                        style='font-size:20px;' style='width:150px;color:blue;' value=0 disabled /></b>
                <br>
                <label>
                    Remarks
                </label>
                <b><textarea id='txtAdjustmentRemarks' name='txtAdjustmentRemarks' onblur='CalculateOutstanding()'
                        class='form-control'></textarea></b>
                <br>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-success" data-dismiss="modal"
                    onclick='UpdateOutstanding()'>Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php } ?>