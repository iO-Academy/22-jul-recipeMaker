const buttons = document.querySelectorAll('.recipe-button');
buttons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        let panel = button.parentElement.parentElement.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    })
})
