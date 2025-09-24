<!DOCTYPE html>
<html>



<head>
    <title>Doctor Notifications</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body> 
 
<script>
document.addEventListener("click", () => {
    notificationSound.play().catch(() => {});  // Silent unlock
});
</script>
 
<h2>Doctor Screen - Notifications Active</h2>
<button onclick="localStorage.removeItem('lastNotificationId'); location.reload();">🔁 Reset Notification Memory</button>

<script src="notification-popup.js"></script>

</body>
</html>