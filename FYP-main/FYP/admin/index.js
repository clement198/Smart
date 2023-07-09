let projectTable = document.querySelector(".project_table");
let userTable = document.querySelector(".user_table");
let msgTable = document.querySelector(".msg_table");

const showProject = () => {
    projectTable.classList.add("showProject");
    userTable.classList.remove("showUser");
    msgTable.classList.remove("showMsg");
}

const showUser = () => {
    userTable.classList.add("showUser");
    projectTable.classList.remove("showProject");
    msgTable.classList.remove("showMsg");
}

const showMsg = () => {
    msgTable.classList.add("showMsg");
    projectTable.classList.remove("showProject");
    userTable.classList.remove("showUser");
}