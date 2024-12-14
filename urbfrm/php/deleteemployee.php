<?php
session_start(); // Start the session

// Database configuration
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (usually empty)
$dbname = "qcu-cuai"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if EmployeeID is set in the URL
if (isset($_GET['EmployeeID'])) {
    $employeeId = $_GET['EmployeeID'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM employee_tb WHERE EmployeeID = ?");
    $stmt->bind_param("s", $employeeId);

    // Execute the statement
    if ($stmt->execute()) {
       
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error; // Set error message
    }

    // Close statement
    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid request."; // Set error message
}

// Close connection
$conn->close();

// Redirect back to the personnel list
echo ("<script>alert('Delete Success :D')</script>");
header("Location: /urbfrm/zAdmin/PersonnelList.php");
exit();
?>