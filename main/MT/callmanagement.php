<?php

include("../../connect.php");
// $position=$_SESSION["SESS_LAST_NAME"]; 
session_cache_limiter(FALSE);
session_start();
$LocationCode = $_SESSION['SESS_LOCATION'];
$GroupID = $_SESSION['SESS_GROUP_ID'];
if (isset($_SESSION['SESS_LAST_NAME'])) {
    //echo 'Session Active';

} else {
    //echo 'Session In Active';
    $url = '../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; ' . $url . '">';
}


?>

<!-- call_log_form.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Call Log Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Log Incoming Call</h2>
    <form action="save_call_log.php" method="POST">
        <div class="form-group">
            <label>Caller Name</label>
            <input type="text" name="caller_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Purpose</label>
            <select name="purpose" class="form-control">
                <option>Consultation</option>
                <option>Therapy Booking</option>
                <option>Product Enquiry</option>
                <option>Follow-up</option>
                <option>Complaint</option>
                <option>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Call Status</label>
            <select name="status" class="form-control">
                <option>Answered</option>
                <option>Missed</option>
                <option>Follow-Up Scheduled</option>
                <option>Closed</option>
            </select>
        </div>
        <div class="form-group">
            <label>Assigned Staff</label>
            <select name="staff" class="form-control">
                <option>Reception</option>
                <option>Admin</option>
                <option>Doctor</option>
                <option>Marketing</option>
            </select>
        </div>
        <div class="form-group">
            <label>Follow-Up Date</label>
            <input type="date" name="follow_up" class="form-control">
        </div>
        <div class="form-group">
            <label>Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Call</button>
    </form>
</div>
</body>
</html>

<?php
// save_call_log.php
require_once "connect.php";

$name = $_POST['caller_name'];
$phone = $_POST['phone_number'];
$purpose = $_POST['purpose'];
$status = $_POST['status'];
$staff = $_POST['staff'];
$follow_up = $_POST['follow_up'];
$remarks = $_POST['remarks'];
$date = date("Y-m-d H:i:s");

$stmt = $mysqli->prepare("INSERT INTO call_logs (caller_name, phone_number, purpose, status, staff, follow_up, remarks, logged_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $name, $phone, $purpose, $status, $staff, $follow_up, $remarks, $date);
$stmt->execute();
$stmt->close();

header("Location: call_log_form.php");
exit();
?>

<?php
// calls_report.php
require_once "connect.php";

$where = "WHERE 1";
if (!empty($_GET['status'])) {
    $status = $mysqli->real_escape_string($_GET['status']);
    $where .= " AND status = '$status'";
}
if (!empty($_GET['staff'])) {
    $staff = $mysqli->real_escape_string($_GET['staff']);
    $where .= " AND staff = '$staff'";
}
if (!empty($_GET['from']) && !empty($_GET['to'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];
    $where .= " AND DATE(logged_at) BETWEEN '$from' AND '$to'";
}

$result = $mysqli->query("SELECT * FROM call_logs $where ORDER BY logged_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Call Logs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Call History</h2>
    <form method="GET" class="form-inline mb-3">
        <input type="date" name="from" class="form-control mr-2" placeholder="From Date">
        <input type="date" name="to" class="form-control mr-2" placeholder="To Date">
        <select name="status" class="form-control mr-2">
            <option value="">All Status</option>
            <option>Answered</option>
            <option>Missed</option>
            <option>Follow-Up Scheduled</option>
            <option>Closed</option>
        </select>
        <select name="staff" class="form-control mr-2">
            <option value="">All Staff</option>
            <option>Reception</option>
            <option>Admin</option>
            <option>Doctor</option>
            <option>Marketing</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Staff</th>
                <th>Follow-Up</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['logged_at'] ?></td>
                    <td><?= $row['caller_name'] ?></td>
                    <td><?= $row['phone_number'] ?></td>
                    <td><?= $row['purpose'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['staff'] ?></td>
                    <td><?= $row['follow_up'] ?></td>
                    <td><?= $row['remarks'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

-- SQL Table Structure --
CREATE TABLE `call_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `caller_name` VARCHAR(255),
  `phone_number` VARCHAR(20),
  `purpose` VARCHAR(100),
  `status` VARCHAR(50),
  `staff` VARCHAR(100),
  `follow_up` DATE,
  `remarks` TEXT,
  `logged_at` DATETIME
);
