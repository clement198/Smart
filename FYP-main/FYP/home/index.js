// Loading Screen
var count;
const loadScreen = () => {
    count = setTimeout(finishLoad, 3000);
}

const finishLoad = () => {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myWord").style.display = "block";
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

// profile img 

let myProfile = document.getElementById("profile_img");
let myUpload = document.getElementById("upload");

const imgChange = () => {
    myProfile.src = URL.createObjectURL(myUpload.files[0]);
}

// profile img 


// Task
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

// calender 

const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec"
];

let prevBtn = document.querySelector("left");
let nextBtn = document.querySelector("right");
let monthDisplay = document.querySelector(".month");
let yearDisplay = document.querySelector(".year");
let dayDisplay = document.querySelector(".days");


let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();


const displayCalendar = () => {
    let lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();
    let prevMonthLastDate = new Date(currentYear, currentMonth, 0).getDate();
    let nextMonthFirstDate = new Date(currentYear, currentMonth, 1).getDate();
    let firstDay = new Date(currentYear, currentMonth, 1).getDay();
    let lastDay = new Date(currentYear, currentMonth, lastDate).getDay();
    let date = "";

    let balanceFirst = prevMonthLastDate - firstDay;
    for (let i = firstDay; i > 0; i--) {
        date += '<div class="day balanceDate">' + '<p>' + (balanceFirst += 1) + '</p>' + '</div>';
    }

    for (let i = 1; i <= lastDate; i++) {
        date += '<div class="day">' + '<p>' + i + '</p>' + '</div>';
    }

    dayDisplay.innerHTML = date;
}
displayCalendar();
monthDisplay.innerHTML = months[currentMonth];
yearDisplay.innerHTML = currentYear;

//Display Add Event
let calenderEvent = document.querySelector('.calender-event');
let inputDate = document.getElementById("input-date");

const addEvent = () => {
    calenderEvent.classList.toggle('openCalender');
}

const nextMonth = () => {
    if (currentMonth > 10) {
        currentMonth = -1;
        currentYear += 1;
    }
    currentMonth++;
    monthDisplay.innerHTML = months[currentMonth];
    yearDisplay.innerHTML = currentYear;
    displayCalendar();
}

const prevMonth = () => {
    if (currentMonth <= 0) {
        currentMonth = 12;
        currentYear -= 1;
    }
    currentMonth--;
    monthDisplay.innerHTML = months[currentMonth];
    yearDisplay.innerHTML = currentYear;
    displayCalendar();
}

let colorChanger = document.querySelectorAll(".event_card h3");
let min = 0;
let max = 5;
let color = [
    "#9BB8ED",
    "#A39FE1",
    "#DEB3E0",
    "#FEC6DF",
    "#FFDDE4",
    "#FEECD6"
]

colorChanger.forEach((n) => {
    n.style.background = color[Math.floor(Math.random() * (max - min))];
});

let drop = document.querySelector(".drop-down");

const dropDown = () => {
    drop.classList.toggle("drop");
}

let event_display = document.querySelector(".event_display");

const eventDisplay = () => {
    event_display.classList.toggle("event-show");
}