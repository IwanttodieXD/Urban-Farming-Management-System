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
    $toolID = $_POST['ToolID'];
    $item = $_POST['item'];
    $stock = $_POST['stock'];
    $purchase_amount = $_POST['purchase_amount'];
    $remarks = $_POST['remarks'];

    $sql = "UPDATE tools SET ItemName=?, Count=?, PurchaseAmount=?, Remarks=? WHERE ToolID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidsi", $item, $stock, $purchase_amount, $remarks, $toolID);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Tool updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating tool: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: /urbfrm/zAdmin/Admin_InvTools.php');
    exit();
}
?>