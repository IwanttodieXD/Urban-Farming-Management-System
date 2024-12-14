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
    $item = $_POST['item'];
    $stock = $_POST['stock'];
    $purchase_amount = $_POST['purchase_amount'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO tools (ItemName, Count, PurchaseAmount, Remarks) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sids", $item, $stock, $purchase_amount, $remarks);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Tool added successfully!";
    } else {
        $_SESSION['message'] = "Error adding tool: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: /urbfrm/zAdmin/Admin_InvTools.php');
    exit();
}
?>