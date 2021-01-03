const form = querySelector('.login-form');
const emailInput = form.querySelector('input[name="email"');
const usernameInput = form.querySelector('input[name="username"');
const passwordInput = form.querySelector('input[name="password"');
const passwordCInput = form.querySelector('input[name="passwordC"');

function isEmail(email) {
    return ("/\S+@\S+\.\S+/").test(email);
}

function comparePasswords(password, passwordC) {
    return password === passwordC;
}