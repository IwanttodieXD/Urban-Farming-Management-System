<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_POST['Image'];
    $title = $_POST['Title'];
    $description = $_POST['Description'];
    $location = $_POST['Location'];
    $date = $_POST['Date'];
    $time = $_POST['Time'];
    $attendanceLink = $_POST['AttendanceLink'];
    $feedbackLink = $_POST['FeedbackLink'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO events (Image, Title, Description, Location, Date, Time, AttendanceLink, FeedbackLink) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $image, $title, $description, $location, $date, $time, $attendanceLink, $feedbackLink);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New event added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>