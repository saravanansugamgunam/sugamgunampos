<script>
$(document).ready(function () {
  $("#myInputDocument").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTableDocument tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
</script>

<style>
p.ridge { border-style: ridge; }
</style>

<?php
include("../../../connect.php");
session_cache_limiter(FALSE);
session_start();

$GroupID   = $_SESSION['SESS_GROUP_ID'] ?? 0;
$PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"] ?? '');
$InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"] ?? '');

$currentdate = date("Y-m-d H:i:s");

$sql = "
SELECT 
  paitentname,
  mobileno,
  email,
  DATE_FORMAT(createdin,'%d-%m-%Y') AS createdin,
  CONCAT(FLOOR((TIMESTAMPDIFF(MONTH, dob, CURDATE()) / 12)), ' Yrs ', MOD(TIMESTAMPDIFF(MONTH, dob, CURDATE()), 12) , ' Mth') AS age,
  gender,
  discountstatus,
  referenceno,
  address,
  (topay - receipt) AS outstanding,
  medicinediscount,
  consultingdiscount,
  therapydiscount,
  (SELECT COUNT(*) FROM therapybookingdetails  WHERE bookinguniqueid = '$InvoiceNo' AND bookingstatus = 'Booked' AND paitentid = '$PaitentID') AS PendingBooking,
  (SELECT COUNT(*) FROM therapybookingdetails  WHERE bookinguniqueid = '$InvoiceNo' AND bookingstatus = 'Closed' AND paitentid = '$PaitentID') AS CompletedBooking,
  (SELECT therapystatus FROM therapybookingmaster WHERE bookinguniqueid = '$InvoiceNo' AND paitentid = '$PaitentID') AS Status,
  CONCAT('../CLM/', patientphoto) AS photo,
  tag,
  profession
FROM paitentmaster
WHERE paitentid = '$PaitentID'
";

$res = mysqli_query($connection, $sql);

echo "<div>";
while ($data = mysqli_fetch_assoc($res)) {

    // Resolve photo
    $rawPhoto = trim($data['photo'] ?? '');
    if ($rawPhoto === '../CLM/-' || $rawPhoto === '../CLM/' || $rawPhoto === '' ) {
        $PatientPhoto = '../CLM/uploads/dummyuser.jpeg';
    } else {
        $PatientPhoto = $rawPhoto;
    }

    // Safe helpers
    $h = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

    $outstanding = (float)($data['outstanding'] ?? 0);
    $rowspan = 4; // make the Outstanding cell consistent across rows

    echo "<table>";

    // Row 1
    echo "<tr>";

    echo "<td rowspan='{$rowspan}'>
            <img src='{$h($PatientPhoto)}' class='email-user' width='100' style='padding:3px;border-radius:20%;' />
          </td>";

    echo "<td>
            <p>Name:&nbsp;&nbsp;<b>".$h($data['paitentname'])."</b>
            &nbsp;&nbsp;
            <a href='#ModalReference' data-toggle='modal' onclick='LoadPaintentDetailsforEdit()'>
              <i class=\"fa fa-pencil-square-o text-info\"></i>
            </a>
            <br><label style='color:red'><b>Tag: ".$h($data['tag'])."</b></label></p>
          </td>";

    echo "<td style='width:40px'></td>";

    echo "<td><p>Gender:&nbsp;&nbsp;<b>".$h($data['gender'])."</b></p></td>";

    echo "<td style='width:30px'></td>";

    echo "<td><p>Profession:&nbsp;&nbsp;<b>".$h($data['profession'])."</b></p></td>";

    // hidden patient name (fixed name attr + closed tag)
    echo "<input type='hidden' name='txtPatientName' id='txtPatientName' value='".$h($data['paitentname'])."' />";

    echo "<td style='width:30px'></td>";

    // Outstanding (rowspanned)
    echo "<td rowspan='{$rowspan}' style='vertical-align:top'>
            <p style='font-size:20px;".($outstanding<0?'color:green':($outstanding>0?'color:red':'color:black')).";text-align:right'>
              Outstanding:&nbsp;&nbsp;<b>".$h($outstanding)."</b>";

    if ($GroupID == 1) {
        echo "<br><a href='#ModalOutstandingModification' class='btn btn-sm btn-warning' data-toggle='modal'>Adjustment</a>";
        echo "<br><a href='#' class='btn btn-sm btn-success ".($outstanding<0?'':'disabled')."' data-toggle='modal' onclick='Refund()'>Refund</a>";
        echo "<br><a href='#' class='btn btn-sm btn-danger ".($outstanding<0?'':'disabled')."' data-toggle='modal' onclick='Transfer()'>Transfer</a>";
    } else {
        echo "<br><a href='#' onclick='AccessDeniedMessage();'><i class='fa fa-2x fa-pencil text-warning'></i></a>";
    }
    echo "  </p>
          </td>";

    echo "</tr>";

    // Row 2
    echo "<tr>";
    echo "<td><p>Mobile:&nbsp;&nbsp;<b>".$h($data['mobileno'])."</b></p>
          <input type='hidden' name='txtMobileNoforWhatsapp' id='txtMobileNoforWhatsapp' value='".$h($data['mobileno'])."' />
          </td>";
    echo "<td></td>";
    echo "<td><p>Age:&nbsp;&nbsp;<b>".$h($data['age'])."</b></p></td>";
    echo "<td></td>";
    echo "<td><p>Address:&nbsp;&nbsp;<b>".$h($data['address'])."</b></p></td>";
    echo "</tr>";

    // Row 3
    echo "<tr>";
    echo "<td><p>Email:&nbsp;&nbsp;<b>".$h($data['email'])."</b></p></td>";
    echo "<td></td>";
    echo "<td><p>Reg. Date:&nbsp;&nbsp;<b>".$h($data['createdin'])."</b></p></td>";
    echo "<td></td>";
    echo "<td><p>Reference:&nbsp;&nbsp;<b>".$h($data['referenceno'])."</b></p></td>";
    echo "</tr>";

    // Row 4 (spacer to align with rowspan)
    echo "<tr><td></td><td></td><td></td><td></td><td></td></tr>";

    echo "</table>";

    echo "</div>";

    // Right-top block (discount summary + edit)
    echo "<div style='float:right'>";
    echo "<table><tr><td".
         ($data['discountstatus']==='YES' ? " style='font-size:15px;color:red;'" : "").
         ">";
    echo "<b>Med: ".$h($data['medicinediscount'])."%, Con: ".$h($data['consultingdiscount'])."%, Thy: ".$h($data['therapydiscount'])."%</b>&nbsp;&nbsp;";
    if ($GroupID == 1) {
      echo "<a href='#ModalConncession' data-toggle='modal'><i class='fa fa-pencil-square-o text-info'></i></a>";
    }
    echo "</td></tr></table>";
    echo "</div>";
?>
<!-- Discount Modal -->
<div id="ModalConncession" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Discount Detail</h4>
      </div>
      <div class="modal-body">
        <label>Medicine Discount %</label>
        <input type="number" id="txtDiscountMedicine" name="txtDiscountMedicine" class="form-control" style="width:50%;" value="<?php echo $h($data['medicinediscount']); ?>" />

        <label>Consulting Discount %</label>
        <input type="number" id="txtDiscountConsulting" name="txtDiscountConsulting" class="form-control" style="width:50%;" value="<?php echo $h($data['consultingdiscount']); ?>" />

        <label>Therapy Discount %</label>
        <input type="number" id="txtDiscountTherapy" name="txtDiscountTherapy" class="form-control" style="width:50%;" value="<?php echo $h($data['therapydiscount']); ?>" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="SaveDiscountPaitent()">Update Discount</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Outstanding Modal -->
<div id="ModalOutstandingModification" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Outstanding</h4>
      </div>
      <div class="modal-body">
        <label>Total Balance</label>
        <input type="number" style="font-size:20px;" id="txtCurrentOutstanding" name="txtCurrentOutstanding" class="form-control" value="<?php echo $h($outstanding); ?>" disabled />
        <br>
        <label>Revised Amount</label>
        <input type="number" id="txtNewOutstanding" name="txtNewOutstanding" class="form-control" style="width:150px;" onblur="CalculateOutstanding()" value="<?php echo $h($outstanding); ?>" />
        <br>
        <label>Adjusted Amount</label>
        <b><input type="number" id="txtAdjustedAmount" name="txtAdjustedAmount" class="form-control" style="font-size:20px;" value="0" disabled /></b>
        <br>
        <label>Remarks</label>
        <b><textarea id="txtAdjustmentRemarks" name="txtAdjustmentRemarks" onblur="CalculateOutstanding()" class="form-control"></textarea></b>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="UpdateOutstanding()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
} // while
echo "</div>";
?>
