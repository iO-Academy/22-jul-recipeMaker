const button = document.querySelector('#loginBtn');
const input = document.querySelector('#emailInput');
const messageDisplay = document.querySelector('.loginMessage');
button.addEventListener('click', (e) => {
    e.preventDefault();
    let email = input.value;
    if (isEmail(email)) {
        fetch('/login', {
            method: 'POST',
            body: JSON.stringify({ email: email }),
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
                    messageDisplay.appendChild(p_text);
                }
            })
    } else {
        let p_tag = document.createElement('p');
        let p_text = document.createTextNode('Email not recognised');
        p_tag.appendChild(p_text);
        messageDisplay.appendChild(p_text);
    }
})

function isEmail(email) {
    // email regex from http://emailregex.com - "Email Address Regular Expression That 99.99% Works."
    let regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regEx.test(email);
}