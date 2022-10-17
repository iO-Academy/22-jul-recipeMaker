const addRecipeBtn = document.querySelector('#addRecipeBtn');
const addRecipeAccordion = document.querySelector('.addRecipeAccordion')

addRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    if (addRecipeAccordion.style.maxHeight) {
        addRecipeAccordion.style.maxHeight = null;
        e.currentTarget.textContent = "+"
    } else {
        addRecipeAccordion.style.maxHeight = addRecipeAccordion.scrollHeight + "px";
        e.currentTarget.textContent = "-"
      }
});

const submitRecipeBtn = document.querySelector('#submitRecipeBtn')

submitRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    //validate & sanitise
    //insert fetch request
})

const validateString = (string) => {
    let pattern = /^[a-z0-9 ,.'-]+$/i;
    if(pattern.test(string) && string.length < 255) {
        return true
    } else {
        return false
    }

}
