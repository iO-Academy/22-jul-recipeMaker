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
