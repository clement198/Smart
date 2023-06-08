let projectTable = document.querySelector(".project_table");
let userTable = document.querySelector(".user_table");

const showProject = () => {
    projectTable.classList.toggle("showProject");
    userTable.classList.remove("showUser");
}

const showUser = () => {
    userTable.classList.toggle("showUser");
    projectTable.classList.remove("showProject");
}