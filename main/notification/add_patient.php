<?php 

include("../connect.php");

$name = $_POST['patient_name'];
$time = $_POST['appointment_time'];

mysqli_query($connection, "INSERT INTO patient_queue (patient_name, appointment_time) VALUES ('$name', '$time')");

$msg = "$name has arrived for appointment at $time";

mysqli_query($connection, "INSERT INTO notifications (type, message, target_user) VALUES ('patient_arrival', '$msg', 'doctor')");

header("Location: reception.php");
?>

