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

if (isset($_GET['MixID'])) {
    $mixID = $_GET['MixID'];

    $sql = "DELETE FROM potmix WHERE MixID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mixID);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Pot mix deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting pot mix: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: /urbfrm/zAdmin/Admin_InvPotMix.php');
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    header('Location: /urbfrm/zAdmin/Admin_InvPotMix.php');
    exit();
}