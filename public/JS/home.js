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
    let success = true
    let inputs = document.querySelectorAll('.recipeInput');
    inputs.forEach(function (element) {
        let required = element.getAttribute('data-required')
        if (required && element.value.length < 1) {
            element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' is a required field! <br>';
            success = false;
        } else {
            element.nextElementSibling.innerHTML = ''
        }
        let maxLength = element.getAttribute('data-max');
        if (maxLength != null && element.value.length > maxLength) {
            element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' is too long, must be less than ' + maxLength + ' characters! <br>';
            success = false;
        }
        
        console.log(success)
    })
}

submitRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    let data = getFormData()
    setRequiredRecipeTimes(data)
    validateForm(data)

    //validate & sanitise

    //insert fetch request
})

const setRequiredRecipeTimes = (form) => {
    if(form.prepTime || form.cookingTime) {
        newRecipeForm.elements['prepTime'].setAttribute('data-required', 'true')
        newRecipeForm.elements['cookingTime'].setAttribute('data-required', 'true')
        newRecipeForm.elements['duration'].removeAttribute('data-required')
    } else if (!form.prepTime && !form.cookingTime) {
        newRecipeForm.elements['duration'].setAttribute('data-required', 'true')
        newRecipeForm.elements['prepTime'].removeAttribute('data-required')
        newRecipeForm.elements['cookingTime'].removeAttribute('data-required')
    }
}

const validateString = (string) => {
    let pattern = /^[a-zA-Z0-9 ,.'-]+$/i;
    if(pattern.test(string) && string.length < 255) {
        return true
    } else {
        return false
    }
}

const validateNum = (num) => {
    let pattern = /^[0-9]+$/i;
    if(pattern.test(num) && num < 1000000) {
        return true
    } else {
        return false
    }
}

// const validateInstructions = (ins) => {
//     let pattern = /^[a-zA-Z0-9 ,.'-]+$/i;
//     if(pattern.test(ins) && string.length < 5000) {
//         return true
//     } else {
//         return false
//     }
// }
