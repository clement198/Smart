// Popup project form

let myPop = document.querySelector(".blur");

const popUps = () => {
    myPop.classList.toggle("active");
}


// Popup project form

//Menu 
const confirmationElements = document.querySelectorAll('.confirmation');

const myConfirm = (button) => {
    const clickedButton = button;
    const associatedBox = clickedButton.nextElementSibling;

    confirmationElements.forEach((element) => {
        if (element !== associatedBox) {
            element.classList.remove('showConfirmation');
        }
    });

    associatedBox.classList.toggle('showConfirmation');
};

// Menu 

// Search User form

let myInput = document.querySelector(".search_bar");

const actSearch = () => {
    myInput.classList.toggle("open");
}

// const searchBar = document.querySelector(".input_bar");
// const searchResult = document.querySelector(".wrap");

// searchBar.onkeyup = () => {
//     let searchUser = searchBar.value;

//     const xhr = new XMLHttpRequest();
//     xhr.open("POST" , "../backend/search_user.php" , true);
//     xhr.onload = () => {
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 const data = xhr.response;
//                 searchResult.innerHTML = data;
//                 console.log(data);
//             }
//         }
//     }
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//     xhr.send(searchUser);

// }

let numbers = document.querySelectorAll(".number");
let count = 0;

setInterval(() => {
    if (count == 50) {
        clearInterval();
    } else {
        count += 1;
        numbers.forEach(number => {
            number.innerHTML = count + "%";
        });
    }
}, 40);

// Search User form

// Loading Screen
var loadTime;
const loadScreen = () => {
    loadTime = setTimeout(finishLoad, 3000);
}

const finishLoad = () => {
    document.getElementById("loader").style.display = "none";
}