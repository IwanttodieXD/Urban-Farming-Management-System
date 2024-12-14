<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qcu-cuai";

$conn = new mysqli($servername, $username, $password, $dbname);

// idpuae tpot mix
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edtbtn'])) {

    $item = isset($_POST['item']) ? $_POST['item'] : null;
    $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
    $date = date("Y-m-d"); 
    $employee_id = $_SESSION['employee_id'];

    // Insert into history table
    $stmt = $conn->prepare("INSERT INTO potmixusage (ItemName, Quantity, UsageDate, EmployeeID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi",$item, $stock, $date, $employee_id);
    $stmt->execute();
    $stmt->close();

    // Update potmix table
    $stmt = $conn->prepare("UPDATE potmix SET stock = stock - ? WHERE ItemName = ?");
    $stmt->bind_param("is", $stock, $item);

    if ($stmt->execute()) {
        echo ("<script>alert('Success :D')</script>");
        header('Location: /urbfrm/zEmployee/PotMix.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>