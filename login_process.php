<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "forth";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
        echo "Login successful!";
        // You can redirect to a dashboard or perform other actions here.
    } else {
        echo "Invalid email or password";
    }

    $stmt->close();
}

$conn->close();
?>
