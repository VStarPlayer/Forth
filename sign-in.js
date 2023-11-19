document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Perform AJAX request to login_process.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login_process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server
            document.getElementById("error").innerText = xhr.responseText;
        }
    };
    var data = "email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password);
    xhr.send(data);
});
