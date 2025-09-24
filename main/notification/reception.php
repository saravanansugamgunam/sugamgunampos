<!DOCTYPE html>
<html>
<head><title>Reception - Mark Patient Arrived</title></head>
<body>
<h2>Mark Patient as Arrived</h2>
<form method="POST" action="add_patient.php">
    <input type="text" name="patient_name" placeholder="Patient Name" required />
    <input type="datetime-local" name="appointment_time" required />
    <button type="submit">Mark as Arrived</button>
</form>
</body>
</html>