<?php
$conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//aproved
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnA'])) {
    $empid = isset($_POST['LId']) ? $_POST['LId'] : null;
    $statusUP = 'Approved';

    $stmt = $conn->prepare("UPDATE leaveapplication SET Status = ? WHERE LeaveID = ?");
    $stmt->bind_param("si", $statusUP, $empid);

    if ($stmt->execute()) {
        echo ("<script>alert('Approved :D')</script>");
        echo ("<script>window.location.href='/urbfrm/zAdmin/Leave_Approval.php';</script>");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
//worst she can say is no
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnR'])) {
    $empid = isset($_POST['LId']) ? $_POST['LId'] : null;
    $statusUP = 'Rejected';

    $stmt = $conn->prepare("UPDATE leaveapplication SET Status = ? WHERE LeaveID = ?");
    $stmt->bind_param("si", $statusUP, $empid);

    if ($stmt->execute()) {
        echo ("<script>alert('Rejected :D')</script>");
        echo ("<script>window.location.href='/urbfrm/zAdmin/Leave_Approval.php';</script>");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>