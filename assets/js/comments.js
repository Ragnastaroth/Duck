let comments = document.getElementById("comments");
let com_container = document.getElementById("com_container");

function toggleComments() {
    com_container.classList.toggle("dNone");
}

comments.addEventListener("click", toggleComments);