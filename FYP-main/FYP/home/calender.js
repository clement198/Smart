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

let countDay = document.getElementsByClassName("day");
for (let i = 0; i < countDay.length; i++) {
    if (countDay[i].innerText === new Date().getDate().toString()) {
        countDay[i].style.color = "red";

    }



}





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

let colorChanger = document.querySelectorAll(".name");
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

let drop = document.querySelectorAll(".drop-down");

const dropDown = (button) => {
    let clickBtn = button;
    let showBtn = clickBtn.nextElementSibling;
    showBtn.classList.toggle("drop");
}

let event_display = document.querySelector(".event_display");

const eventDisplay = () => {
    event_display.classList.toggle("event-show");
}