const addRecipeBtn = document.querySelector('#addRecipeBtn');
const addRecipeAccordion = document.querySelector('.addRecipeAccordion')
const submitRecipeBtn = document.querySelector('.submitRecipeBtn')
const newRecipeForm = document.querySelector('#newRecipeForm')

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

const getFormData = () => {
    let data = {
        recipeName: newRecipeForm.elements['recipeName'].value,
        duration: newRecipeForm.elements['duration'].value,
        prepTime: newRecipeForm.elements['prepTime'].value,
        cookingTime: newRecipeForm.elements['cookingTime'].value,
        prepTime: newRecipeForm.elements['prepTime'].value,
        instructions: newRecipeForm.elements['instructions'].value
    }
    return data
}

const validateForm = (form) => {
    let success = false;
    
}

submitRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    let data = getFormData()

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

const validateNum = (num) => {
    let pattern = /^[0-9]+$/i;
    if(pattern.test(num) && num < 10000) {
        return true
    } else {
        return false
    }
}

const validateInstructions = (ins) => {
    let pattern = /^[a-z0-9 ,.'-]+$/i;
    if(pattern.test(ins) && string.length < 1000) {
        return true
    } else {
        return false
    }
}
