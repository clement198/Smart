// Refresh 

const form = document.querySelector(".message"),
    btn = form.querySelector(".sndBtn");

btn.onclick = () => {
    const xml = new XMLHttpRequest();
    xml.open("POST", "../backend/msg_back.php", true);
    const formData = new FormData(form);
    xml.send(formData);
}

//Real time chat
const chat = document.querySelector(".msg_box");
setInterval(() => {
    const xml = new XMLHttpRequest();
    xml.open("POST", "../backend/chat_back.php", true);
    xml.onload = () => {
        if (xml.readyState === XMLHttpRequest.DONE) {
            if (xml.status === 200) {
                const data = xml.response;
                chat.innerHTML = data;
            }

        }
    }
    const formData = new FormData(form);
    xml.send(formData);
}, 500);