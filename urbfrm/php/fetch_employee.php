<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Database connection
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "qcu-cuai"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee data
$sql = "SELECT CONCAT(Firstname, ' ', MiddleName, ' ', LastName) As Name, EmployeeID, Position, Contact FROM personnels";
$result = $conn->query($sql);

$employees = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Return JSON response
echo json_encode($employees);

$conn->close();
?>