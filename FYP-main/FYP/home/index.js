// Loading Screen
var loadTime;
const loadScreen = () => {
    loadTime = setTimeout(finishLoad, 3000);
}

const finishLoad = () => {
    document.getElementById("loader").style.display = "none";
}

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

let showForget = document.querySelector('.forgot_pass');

const forget = () => {
    showForget.classList.toggle('openForget');
}

// profile img 

let myProfile = document.getElementById("profile_img");
let myUpload = document.getElementById("upload");

const imgChange = () => {
    myProfile.src = URL.createObjectURL(myUpload.files[0]);
}

// profile img 

//Reset show pass 

let newPass_eye = document.getElementById('newPass');
let newPass_input = document.getElementById('newPass-input');
const showNewPass = () => {
    newPass_eye.classList.toggle('bx-show');
    if (newPass_input.type == 'password') {
        newPass_input.type = 'text';
    } else {
        newPass_input.type = 'password';
    }

}

let rePass_eye = document.getElementById('rePass');
let rePass_input = document.getElementById('rePass-input');
const showRePass = () => {
    rePass_eye.classList.toggle('bx-show');
    if (rePass_input.type == 'password') {
        rePass_input.type = 'text';
    } else {
        rePass_input.type = 'password';
    }

}


// Task


let recover = document.querySelector(".recover_area");

const myRevert = () => {
    recover.classList.toggle('display_recover');
}

let task = document.querySelector('.task_creation');
let status = document.querySelector(".status");
let input = document.getElementById('input_status');

const myTask = () => {
    task.classList.toggle('showTaskForm');
}


let deleteTask = document.querySelector(".delete_alert");

const delete_task = () => {
    deleteTask.classList.toggle('display_delete');
}

let editTask = document.querySelector(".task_detail_edit");

const edit_task = () => {
    editTask.classList.toggle('display_edit');
}

let insertFile = document.querySelector(".insert_file");

const insert_file = () => {
    insertFile.classList.toggle('show_insert');
}

let removeUser = document.querySelector(".collab_user_detail");

const remove_user = () => {
    removeUser.classList.toggle('show_remove');
}

let statusBar = document.querySelector('#task-status p');
let statusColor = document.querySelector('#task-status');


if (statusBar.innerText === 'In Progress') {
    statusBar.style.background = "#FFB302";
} else if (statusBar.innerText === 'On Hold') {
    statusBar.style.background = "#2DCCFF";
} else if (statusBar.innerText === 'Cancelled') {
    statusBar.style.background = "#FF2A04";
} else if (statusBar.innerText === 'In Review') {
    statusBar.style.background = "#FAD800";
} else if (statusBar.innerText === 'Completed') {
    statusBar.style.background = "#00E200";
}



// Get upload File Task

let uploadTask = document.querySelector('#file');
let displayFile = document.querySelector('#display');

const myChange = () => {
    let file_name = uploadTask.files[0].name;
    displayFile.innerText = file_name;

}

let inviteUser = document.querySelector('.inv_user');

const inviteFunc = () => {
    inviteUser.classList.toggle('openInv');
}

// Task