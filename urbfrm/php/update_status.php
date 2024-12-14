<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qcu-cuai";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//update statusssad
if (isset($_GET['usage_id'])) {
    $usage_id = $_GET['usage_id'];
    $sql = "UPDATE toolsusage SET Bstatus = 'Returned' WHERE UsageID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$usage_id);

    if ($stmt->execute()) {
        
        echo "<script>alert('Status updated to Returned'); window.location.href = '/urbfrm/zEmployee/Tools_Borrowed.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Borrower ID is missing.";
}
//updatetools count
if (isset($_GET['usage_id'])) {
    $quantity = $_GET['quantity'];
    $toolname = $_GET['toolname'];
    $sql = "UPDATE tools SET Count = (Count + ?) WHERE ItemName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is",$quantity ,$toolname);

    if ($stmt->execute()) {
        
        echo "<script>alert('Status updated to Returned'); window.location.href = '/urbfrm/zEmployee/Tools_Borrowed.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Borrower ID is missing.";
}

$conn->close();
?>
