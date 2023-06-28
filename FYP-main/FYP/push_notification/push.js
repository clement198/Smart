const button = document.querySelector('button');

button.addEventListener("click", () => {
    Notification.requestPermission().then(perm => {
        if (perm === "granted") {
            new Notification("You have received a notification", {
                body: "This is a message",
            });
        }
    })
})

setInterval(() => {
    var userName = '$user_data[user_name]';
    Notification.requestPermission().then(perm => {
        if (perm === 'granted') {
            new Notification('You have received a notification', {
                body: 'You got a new Message from ' + userName,
            });
        }
    })
}, 1)