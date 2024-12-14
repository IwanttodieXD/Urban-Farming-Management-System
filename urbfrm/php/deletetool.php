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

if (isset($_GET['ToolID'])) {
    $toolID = $_GET['ToolID'];

    $sql = "DELETE FROM tools WHERE ToolID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $toolID);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Tool deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting tool: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: /urbfrm/zAdmin/Admin_InvTools.php');
    exit();
} else {
    $_SESSION['message'] = "No ToolID provided!";
    header('Location: /urbfrm/zAdmin/Admin_InvTools.php');
    exit();
}
?>