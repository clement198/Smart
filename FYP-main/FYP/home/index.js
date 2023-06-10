//Menu 
let myBtn = document.querySelector('#menu');
let myList = document.querySelector('.list');

const myMenu = () => {
        myBtn.classList.toggle('bx-chevrons-right');
        myList.classList.toggle('show');
    }
    // Menu 

// Show/hide password
let showpass = document.querySelector('#show');
let password = document.querySelector('.pass');
const showPass = () => {
        showpass.classList.toggle('bx-show');
        if (password.type == 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }

    }
    // Show/hide password

// profile img 

let myProfile = document.getElementById("profile_img");
let myUpload = document.getElementById("upload");

const imgChange = () => {
    myProfile.src = URL.createObjectURL(myUpload.files[0]);
}

// profile img 


// Task
let task = document.querySelector('.task_creation');
let status = document.querySelectorAll("#status");
let input = document.getElementById('input_status');

const myTask = (event) => {

    task.classList.toggle('showTaskForm');
    input.value = event.target.innerHTML;

}

// Task

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