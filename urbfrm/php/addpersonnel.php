<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['fname'];
    $middlename = $_POST['mname'];
    $lastname = $_POST['lname'];
    $birthdate = $_POST['bdate'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $hiredate = $_POST['hiredate'];
    $position = $_POST['position'];
    $employeeid = $_POST['employeeid'];
    $usertype = $_POST['role'];
    $password = $_POST['password'];
    
 // Handle image upload
 if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'emp_img/' . basename($file_name);
        
    // Check if the file is an image (optional check)
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = mime_content_type($tempname);
    if (!in_array($file_type, $allowed_types)) {
        echo "Invalid image format. Only JPG, PNG, and GIF are allowed.";
        exit;
    }
 }
    // Move the image to the target folder
    if (move_uploaded_file($tempname, $folder)) {
        // Prepare the SQL query to insert the image path and other data
        $stmt = $conn->prepare("INSERT INTO employee_tb (Fname, Mname, Lname, Bdate, Sex, Contact, Email, Address, HireDate, Position, EmployeeID, UserType, Password, Image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssssss", $firstname, $middlename, $lastname, $birthdate, $sex, $contact, $email, $address, $hiredate, $position, $employeeid, $usertype, $password, $folder);
    // Execute the statement
    if ($stmt->execute()) {
        echo ("<script>alert('Success :D')</script>");
        header('Location: /urbfrm/zAdmin/Personnel_Add.html');
    } else {
        echo "Error: " . $stmt->error;
    }
    // Close statement and connection
    $stmt->close();
    }
}

$conn->close();
?>