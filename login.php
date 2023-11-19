<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "forth";

$conn = new mysqli($servername, $username, $password, $db);

// Uncomment the following block if you want to check for database connection errors
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

if (isset($_POST['submitted'])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Pronouns
    $heHim = isset($_POST["pronouns"]) && in_array("huey", $_POST["pronouns"]) ? 1 : 0;
    $sheHer = isset($_POST["pronouns"]) && in_array("dewey", $_POST["pronouns"]) ? 1 : 0;
    $theyThem = isset($_POST["pronouns"]) && in_array("louie", $_POST["pronouns"]) ? 1 : 0;

    // Neurodivergencies
    $bipolar = isset($_POST["neurodivergencies"]) && in_array("bipolar", $_POST["neurodivergencies"]) ? 1 : 0;
    $schizophrenia = isset($_POST["neurodivergencies"]) && in_array("schizo", $_POST["neurodivergencies"]) ? 1 : 0;
    $schizoidPersonality = isset($_POST["neurodivergencies"]) && in_array("schizoid", $_POST["neurodivergencies"]) ? 1 : 0;
    $autism = isset($_POST["neurodivergencies"]) && in_array("autism", $_POST["neurodivergencies"]) ? 1 : 0;
    $add = isset($_POST["neurodivergencies"]) && in_array("add", $_POST["neurodivergencies"]) ? 1 : 0;
    $bpd = isset($_POST["neurodivergencies"]) && in_array("bpd", $_POST["neurodivergencies"]) ? 1 : 0;
    $did = isset($_POST["neurodivergencies"]) && in_array("did", $_POST["neurodivergencies"]) ? 1 : 0;
    $ocd = isset($_POST["neurodivergencies"]) && in_array("ocd", $_POST["neurodivergencies"]) ? 1 : 0;
    $ed = isset($_POST["neurodivergencies"]) && in_array("ed", $_POST["neurodivergencies"]) ? 1 : 0;
    $ptsd = isset($_POST["neurodivergencies"]) && in_array("ptsd", $_POST["neurodivergencies"]) ? 1 : 0;
    $cptsd = isset($_POST["neurodivergencies"]) && in_array("cptsd", $_POST["neurodivergencies"]) ? 1 : 0;
    $anxiety = isset($_POST["neurodivergencies"]) && in_array("anxiety", $_POST["neurodivergencies"]) ? 1 : 0;

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (email, username, password, heHim, sheHer, theyThem, bipolar, schizophrenia, schizoidPersonality, autism, add, bpd, did, ocd, ed, ptsd, cptsd, anxiety) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssss", $email, $username, $password, $heHim, $sheHer, $theyThem, $bipolar, $schizophrenia, $schizoidPersonality, $autism, $add, $bpd, $did, $ocd, $ed, $ptsd, $cptsd, $anxiety);

    if ($stmt->execute()) {
        // Write the values to data.txt
        $data = "$email, $username, $password, $heHim, $sheHer, $theyThem, $bipolar, $schizophrenia, $schizoidPersonality, $autism, $add, $bpd, $did, $ocd, $ed, $ptsd, $cptsd, $anxiety\n";
        file_put_contents('data.txt', $data, FILE_APPEND);
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>