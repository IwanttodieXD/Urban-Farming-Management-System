<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "qcu-cuai";

// Check if the employee ID is set in the session
if (!isset($_SESSION['employee_id'])) {
    die("Employee ID is not set in the session.");
}

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error); // Log connection error
    die("Connection failed: " . $conn->connect_error);
}

//timein
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timein'])) {
    error_log("POST request received."); // Log to server error log
    $employeeId = $_SESSION['employee_id']; // Get Employee ID from session
    $timestamp = date('H:i:s'); // Get current time in HH:MM:SS format
    $attendanceDate = date('Y-m-d'); // Get current date in YYYY-MM-DD format
    $usertype = $_SESSION['usertype'];
    $status = 'Active';

    error_log("Employee ID: $employeeId, Timestamp: $timestamp, Attendance Date: $attendanceDate"); // Log received data

    $stmt = $conn->prepare("INSERT INTO attendance (EmployeeID, AttendanceDate, TimeIn, Status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $employeeId, $attendanceDate, $timestamp, $status);

    if ($stmt->execute()) {
        if ($usertype === 'admin') {
        echo ("<script>alert('You have timed in successfully! :D')</script>");
        header('Location: /urbfrm/zAdmin/Landing_Admin.html');
        } else {
        echo ("<script>alert('You have timed in successfully! :D')</script>");
        header('Location: /urbfrm/zEmployee/Landing_Employee.html');
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
//timeout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timeout'])) {
    error_log("POST request received."); // Log to server error log
    $employeeId = $_SESSION['employee_id']; // Get Employee ID from session
    $timestamp = date('H:i:s'); // Get current time in HH:MM:SS format
    $attendanceDate = date('Y-m-d'); // Get current date in YYYY-MM-DD format
    $usertype = $_SESSION['usertype'];
    $status = 'Out';

    error_log("Employee ID: $employeeId, Timestamp: $timestamp, Attendance Date: $attendanceDate"); // Log received data

    $stmt = $conn->prepare("UPDATE attendance SET status = ?, TimeOut = ? WHERE EmployeeID = ?");
    $stmt->bind_param("sss", $status, $timestamp, $employeeId);

    if ($stmt->execute()) {
        if ($usertype === 'admin') {
        echo ("<script>alert('You have timed in successfully! :D')</script>");
        header('Location: /urbfrm/zAdmin/Landing_Admin.html');
        } else {
            echo ("<script>alert('You have timed in successfully! :D')</script>");
        header('Location: /urbfrm/zEmployee/Landing_Employee.html');
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>