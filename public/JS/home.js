const addRecipeBtn = document.querySelector('#addRecipeBtn')
const addRecipeAccordion = document.querySelector('.addRecipeAccordion')
const submitRecipeBtn = document.querySelector('.submitRecipeBtn')
const newRecipeForm = document.querySelector('#newRecipeForm')
const ingredientsBtn = document.querySelector('.ingredients-button')
const ingredientsList = document.querySelector('.ingredients-list')
const ingredientErrorMessage = document.querySelector('.ingredientErrorMessage')

let ingredientsArray = []

addRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    if (addRecipeAccordion.style.maxHeight) {
        addRecipeAccordion.style.maxHeight = null
        e.currentTarget.textContent = "+"
    } else {
        addRecipeAccordion.style.maxHeight = addRecipeAccordion.scrollHeight + "px"
        e.currentTarget.textContent = "-"
    }
})

ingredientsBtn.addEventListener('click', (e) => {
    e.preventDefault()
    ingredientErrorMessage.innerHTML = ''
    let ingredient = newRecipeForm.elements['ingredients'].value
    if (validateIngredient(ingredient, ingredientsArray)) {
        ingredientsArray.push(ingredient)
        let divTag = document.createElement('div')
        divTag.classList.add('d-flex', 'align-items-center', )
        divTag.innerHTML += '<li>' + ingredient + '</li>'
        divTag.innerHTML += '<button type="button" class="remove-ingredient-button">x</button>'
        ingredientsList.appendChild(divTag)
        newRecipeForm.elements['ingredients'].value = ''
        newRecipeForm.elements['ingredients'].focus()
    
        let removeIngredientsBtns = document.querySelectorAll('.remove-ingredient-button')
        removeIngredientsBtns.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault()
                removeIngredientOnce(ingredientsArray, button.previousElementSibling.textContent)
                button.parentElement.remove()
            })
        })
    }
})


const getFormData = () => {
    let data = {
        name: newRecipeForm.elements['recipeName'].value,
        duration: newRecipeForm.elements['duration'].value,
        instructions: newRecipeForm.elements['instructions'].value
    }
    if(newRecipeForm.elements['cookingTime'].value !== '' && 
        newRecipeForm.elements['prepTime'].value !== '') {
        data.cookTime = newRecipeForm.elements['cookingTime'].value
        data.prepTime = newRecipeForm.elements['prepTime'].value
    }
    if (ingredientsArray !== []) {
        data.ingredients = ingredientsArray
    }
    return data
}

const validateForm = (data) => {
    let success = true
    let inputs = document.querySelectorAll('.recipeInput')
    inputs.forEach(function (element) {
        let required = element.getAttribute('data-required')
        if (required && element.value.length < 1) {
            element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' is a required field! <br>'
            success = false
        } else {
            element.nextElementSibling.innerHTML = ''
        }

        if (element.className === 'recipeInput strInput') {
            if (validateString(element.value) === false) {
                element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' must be a valid name <br>'
                success = false
            }
        }
        
        if (required && element.className === 'recipeInput numInput') {
            if (validateNum(element.value) === false) {
                element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' must be a valid number <br>'
                success = false
            }
        }

        if (element.className === "recipeInput insInput") {
            let maxLength = element.getAttribute('data-max')
            if (maxLength != null && element.value.length > maxLength) {
                element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' is too long, must be less than ' + maxLength + ' characters! <br>'
                success = false
            }
        }
    })
    let durationAlerts = document.querySelector('#durationAlerts')
    if (data.prepTime && data.cookTime && data.duration !== '') {
        if (parseInt(data.duration) != parseInt(data.prepTime) + parseInt(data.cookTime)) {
            success = false
            durationAlerts.textContent = 'Duration must equal cooking time + prep time!'
        } else {
            alerts.textContent = ''
        }
    } else if (data.prepTime && data.cookTime && data.duration == '') {
        data.duration = parseInt(data.prepTime) + parseInt(data.cookTime)
    }
    return success
}

submitRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    let data = getFormData()
    setRequiredRecipeTimes(data)
    let validate = validateForm(data)
    if (validate) {
        fetch('/', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'content-type': 'application/json'
            }
        })
        .then(data => data.json())
        .then((response) => {
            if (!response.success) {
                let alerts = document.querySelector('#alerts')
                alerts.textContent = 'Something went wrong'
            } else {
                window.location.href = "/"
            }
        })
    } else {
        let alerts = document.querySelector('#alerts')
        alerts.textContent = 'Please fix the above error'
    }
})

const setRequiredRecipeTimes = (form) => {
    if(form.prepTime || form.cookTime) {
        newRecipeForm.elements['prepTime'].setAttribute('data-required', 'true')
        newRecipeForm.elements['cookingTime'].setAttribute('data-required', 'true')
        newRecipeForm.elements['duration'].removeAttribute('data-required')
    } else if (!form.prepTime && !form.cookTime) {
        newRecipeForm.elements['duration'].setAttribute('data-required', 'true')
        newRecipeForm.elements['prepTime'].removeAttribute('data-required')
        newRecipeForm.elements['cookingTime'].removeAttribute('data-required')
    }
}

const validateString = (string) => {
    let pattern = /^[a-zA-Z0-9 ,.'-]+$/i
    if(pattern.test(string) && string.length < 255) {
        return true
    } else {
        return false
    }
}

const validateNum = (num) => {
    let pattern = /^[0-9]+$/i
    if(pattern.test(num) && num.length < 10) {
        return true
    } else {
        return false
    }
}

const removeIngredientOnce = (arr, value) => {
    let index = arr.indexOf(value)
    if (index > -1) {
      arr.splice(index, 1)
    }
    return arr
  }

const validateIngredient = (ingredient, ingredientsArray) => {
    let success = true
    if (ingredientsArray.includes(ingredient)) {
        ingredientErrorMessage.innerHTML = 'Ingredient already added'
        success = false
    }

    if (validateString(ingredient) === false) {
        ingredientErrorMessage.innerHTML = 'Ingredient must be alphanumeric'
        success = false
    }
    return success
}