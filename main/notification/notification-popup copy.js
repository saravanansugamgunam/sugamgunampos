let lastNotificationId = 0;

 
function fetchNotifications() {
    alert(3);
    $.get("notification-check.php", function(data) {
        const res = JSON.parse(data);
        if (res.id > lastNotificationId) {
            lastNotificationId = res.id;
            showPopup(res.message);
            new Audio("ding.mp3").play();
        }
    });
}

function showPopup(message) {
    const popup = document.createElement("div");
    popup.innerHTML = message;
    popup.style = "position:fixed; bottom:20px; right:20px; background:#4caf50; color:white; padding:15px; border-radius:10px; z-index:9999; box-shadow: 0 0 10px rgba(0,0,0,0.3);";
    document.body.appendChild(popup);
    setTimeout(() => popup.remove(), 5000);
}

setInterval(fetchNotifications, 5000);