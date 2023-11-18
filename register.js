var emailText = document.getElementById("email");
var nameText = document.getElementById("name");
var passwordText = document.getElementById("password");
var form=document.getElementById("form");
const errorElement = document.getElementById("error");

form.addEventListener('submit' , (e) =>{
let messages = [];
if(passwordText.value.length < 6)
    messages.push("Password is to short");

if(messages.length > 0)
{
    e.preventDefault();
    errorElement.innerText = messages.join(', ');
}

});