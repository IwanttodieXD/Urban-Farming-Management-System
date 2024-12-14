<?php
session_start(); // Start the session at the beginning of the file

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qcu-cuai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $item = $_POST['item'];
    $stock = $_POST['stock'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO potmix (ItemName, Stock) VALUES (?, ?)");
    $stmt->bind_param("si", $item, $stock);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the main page
    header('Location: /urbfrm/zAdmin/Admin_InvPotMix.php'); // Change to your main page
    exit();
}
?>