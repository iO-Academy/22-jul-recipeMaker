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

const validateForm = (data) => {
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

        if (element.className === 'recipeInput strInput') {
            if (validateString(element.value) === false) {
                element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' must be a valid name <br>';
                success = false
            }
        }
        
        if (required && element.className === 'recipeInput numInput') {
            if (validateNum(element.value) === false) {
                element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' must be a valid number <br>';
                success = false
            }
        }

        if (element.className === "recipeInput insInput") {
            let maxLength = element.getAttribute('data-max');
            if (maxLength != null && element.value.length > maxLength) {
                element.nextElementSibling.innerHTML = element.previousElementSibling.innerHTML + ' is too long, must be less than ' + maxLength + ' characters! <br>';
                success = false;
            }
        }
    })
    let alerts = document.querySelector('#alerts')
    if (data.prepTime && data.cookingTime) {
        if (parseInt(data.duration) != parseInt(data.prepTime) + parseInt(data.cookingTime)) {
            success = false
            alerts.textContent = 'Duration must equal cooking time + prep time!'
            console.log(alerts.textContent)
        } else {
            alerts.textContent = ''
        }
    return success
    }
}

submitRecipeBtn.addEventListener('click', (e) => {
    e.preventDefault()
    let data = getFormData()
    setRequiredRecipeTimes(data)
    let validate = validateForm(data)
    if (validate) {
        if (data.prepTime === '' || data.cookingTime === '') {
            data.prepTime = 'null'
            data.cookingTime = 'null'
        }
        fetch('/', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'content-type': 'application/json'
            }
        })
            .then(data => data.json())
            .then((response) => {
                console.log(response)
                if (!response.success) {
                    let p_tag = document.createElement('p');
                    let p_text = document.createTextNode('Something went wrong');
                    p_tag.appendChild(p_text);
                    alerts.appendChild(p_text);
                } else {
                    window.location.href = "/";
                }
            })
    } else {
        let p_tag = document.createElement('p');
        let p_text = document.createTextNode('Something went wrong');
        p_tag.appendChild(p_text);
        alerts.appendChild(p_text);
    }
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
    if(pattern.test(num) && num.length < 10) {
        return true
    } else {
        return false
    }
}

// const cookingTimesFormatter = (dur, prep, cook) => {
//     if (prep && cook) {
//         dur = prep + cook
//     } else {
//         prep = 0
//         cook = 0
//     }
// }
