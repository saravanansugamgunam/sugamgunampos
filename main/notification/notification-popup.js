const notificationSound = new Audio("notification_sound.wav");
notificationSound.loop = false;   // ✅ Ensure sound plays once
notificationSound.load();

let lastNotificationId = localStorage.getItem("lastNotificationId") || 0;

function fetchNotifications() {
    $.get("notification-check.php", function (data) {
        try {
            const res = JSON.parse(data);
            const resId = parseInt(res.id);
            const lastId = parseInt(lastNotificationId);

            if (!isNaN(resId) && resId > lastId) {
                localStorage.setItem("lastNotificationId", resId);
                showPopup(res.message);

                notificationSound.pause();             // ⏸ in case it's still playing
                notificationSound.currentTime = 0;     // 🔁 rewind
                notificationSound.play().catch(e => console.log("🔇 Audio error:", e));
                
            }
        } catch (e) {
            console.error("❌ JSON parse error:", e);
        }
    });
}

// function showPopup(message) {
//     const popup = document.createElement("div");
//     popup.innerHTML = `<strong>🔔 New Notification</strong><br>${message}`;
//     popup.style.position = "fixed";
//     popup.style.bottom = "20px";
//     popup.style.right = "20px";
//     popup.style.background = "#4caf50";
//     popup.style.color = "white";
//     popup.style.padding = "15px";
//     popup.style.borderRadius = "10px";
//     popup.style.zIndex = "9999";
//     popup.style.boxShadow = "0 0 10px rgba(0,0,0,0.3)";
//     popup.style.fontSize = "16px";
//     popup.style.maxWidth = "300px";
//     popup.style.animation = "slideIn 0.3s ease-in-out";

//     document.body.appendChild(popup);
//     setTimeout(() => popup.remove(), 5000);
// }

// setInterval(fetchNotifications, 5000);


function showPopup(message) {
    const popup = document.createElement("div");
    popup.innerHTML = `<strong>🔔 New Notification</strong><br>${message}`;
    popup.style.position = "fixed";
    popup.style.bottom = "20px";
    popup.style.right = "20px";
    popup.style.background = "#4caf50";
    popup.style.color = "white";
    popup.style.padding = "15px";
    popup.style.borderRadius = "10px";
    popup.style.zIndex = "9999";
    popup.style.boxShadow = "0 0 10px rgba(0,0,0,0.3)";
    popup.style.fontSize = "16px";
    popup.style.maxWidth = "300px";

    document.body.appendChild(popup);

    // 🔊 Play sound 
    notificationSound.play().catch(e => console.log("🔇 Audio error:", e)); 
    setTimeout(() => popup.remove(), 5000);
}


setInterval(fetchNotifications, 5000);