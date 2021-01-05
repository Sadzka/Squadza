const form = document.querySelector('.login-form');
const emailInput = form.querySelector('input[name="email"');
const usernameInput = form.querySelector('input[name="username"');
const passwordInput = form.querySelector('input[name="password"');
const passwordCInput = form.querySelector('input[name="passwordC"');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordSame(password, passwordC) {
    return password === passwordC;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') :  element.classList.remove('no-valid');
}

function validateEmail() {
    setTimeout( function() {
        markValidation(emailInput, isEmail(emailInput.value))
    }, 1000);
}

function validatePassword(){
    setTimeout( function() {
        const condition = arePasswordSame(passwordCInput.value, passwordInput.value);
        markValidation(passwordCInput, condition)
    }, 1000);
}

emailInput.addEventListener('keyup', validateEmail);
passwordInput.addEventListener('keyup', validatePassword);
passwordCInput.addEventListener('keyup', validatePassword);