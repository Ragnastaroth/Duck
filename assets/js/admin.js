let ducks = document.getElementById("ducks");
let ducks_container = document.getElementById("ducks_container");
let users = document.getElementById("users");
let users_container = document.getElementById("users_container");

function toggleDucks() {
    ducks_container.classList.toggle("dNone");
}

function toggleUsers() {
    users_container.classList.toggle("dNone");
}

ducks.addEventListener("click", toggleDucks);
users.addEventListener("click", toggleUsers);