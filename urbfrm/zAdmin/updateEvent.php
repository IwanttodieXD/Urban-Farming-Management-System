<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the event data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eventID = $_POST['EventID'];
    $image = $_POST['Image'];
    $title = $_POST['Title'];
    $description = $_POST['Description'];
    $location = $_POST['Location'];
    $date = $_POST['Date'];
    $time = $_POST['Time'];
    $attendanceLink = $_POST['AttendanceLink'];
    $feedbackLink = $_POST['FeedbackLink'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE events SET Image=?, Title=?, Description=?, Location=?, Date=?, Time=?, AttendanceLink=?, FeedbackLink=? WHERE EventID=?");
    $stmt->bind_param("sssssssss", $image, $title, $description, $location, $date, $time, $attendanceLink, $feedbackLink, $eventID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Event updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>