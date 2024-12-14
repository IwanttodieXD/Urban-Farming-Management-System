<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qcu-cuai";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mixID = $_POST['MixID']; // Ensure this matches the input name in the form
    $item = $_POST['item'];
    $stock = $_POST['stock'];

    $sql = "UPDATE potmix SET ItemName=?, Stock=? WHERE MixID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $item, $stock, $mixID);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Pot mix updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating pot mix: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: /urbfrm/zAdmin/Admin_InvPotMix.php');
    exit();
}
?>