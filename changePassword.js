var passwordText = document.getElementById("password");
var confirmPasswordText = document.getElementById("confirmPassword");
var form = document.getElementById("form");
var errorElement = getElementById("error");

form.addEventListener('submit', (e) => {
    let messages = [];
    if(passwordText.value !== confirmPasswordText.value)
        messages.push("the passwords don't match!!");

    if(messages.length > 0)
    {
        e.preventDefault();
        errorElement.innerText = messages.join(', ');
    }
});