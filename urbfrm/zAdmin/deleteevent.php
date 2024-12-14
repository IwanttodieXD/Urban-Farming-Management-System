<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the event ID is received
if (isset($_GET['EventID'])) {
    $eventID = $_GET['EventID'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM events WHERE EventID=?");
    $stmt->bind_param("s", $eventID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Event deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    $conn->close();
    header("Location: Events_Manage.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    header("Location: Events_Manage.php");
    exit();
}