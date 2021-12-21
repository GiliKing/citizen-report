const openBtn = document.querySelector(".js-open");
const modalBg = document.getElementsByClassName("modal_background")[0];
const modalBox = document.getElementsByClassName("modal_box")[0];


openBtn.addEventListener('click', function(event) {
    event.preventDefault()
    modalBg.classList.add("active")
    modalBox.classList.add("active")
})

const closeBtns = document.querySelectorAll(".js-close");

closeBtns.forEach(node => {
    node.addEventListener('click', function(e) {
        e.preventDefault()
        modalBg.classList.remove("active")
        modalBox.classList.remove("active")
    })
})