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

// Check if the ID is set
if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Fetch the employee data
    $stmt = $conn->prepare("SELECT * FROM employee_tb WHERE EmployeeID = ?");
    $stmt->bind_param("s", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();

    // Check if employee exists
    if (!$employee) {
        die("Employee not found.");
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
        $usertype = $_POST['role'];
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE employee_tb SET Fname=?, Mname=?, Lname=?, Bdate=?, Sex=?, Contact=?, Email=?, Address=?, HireDate=?, Position=?, UserType=?, Password=? WHERE EmployeeID=?");
        $stmt->bind_param("sssssssssssss", $firstname, $middlename, $lastname, $birthdate, $sex, $contact, $email, $address, $hiredate, $position, $usertype, $password, $employeeId);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['message'] = "Record updated successfully"; // Set success message
            header("Location: /urbfrm/zAdmin/PersonnelList.php"); // Redirect to the personnel list
            exit();
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error; // Set error message
        }

        // Close statement
        $stmt->close();
    }
} else {
    die("Invalid request.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../css/addpersonnel.css">
</head>
<body>
    <h2>Edit Employee</h2>

    <?php
    // Display success or error message
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . htmlspecialchars($_SESSION['message']) . '</div>';
        unset($_SESSION['message']); // Clear the message after displaying
    }
    ?>

    <form action="editemployee.php?id=<?php echo htmlspecialchars($employeeId); ?>" method="POST">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($employee['Fname']); ?>" required>

        <label for="mname">Middle Name</label>
        <input type="text" id="mname" name="mname" value="<?php echo htmlspecialchars($employee['Mname']); ?>" required>

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($employee['Lname']); ?>" required>

        <label for="bdate">Birth Date</label>
        <input type="date" id="bdate" name="bdate" value="<?php echo htmlspecialchars($employee['Bdate']); ?>" required>

        <label for="sex">Sex</label>
        <select id="sex" name="sex" required>
            <option value="male" <?php echo ($employee['Sex'] == 'male') ? ' selected' : ''; ?>>Male</option>
 <option value="female" <?php echo ($employee['Sex'] == 'female') ? ' selected' : ''; ?>>Female</option>
        </select>

        <label for="contact">Contact</label>
        <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($employee['Contact']); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employee['Email']); ?>" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($employee['Address']); ?>" required>

        <label for="hiredate">Hire Date</label>
        <input type="date" id="hiredate" name="hiredate" value="<?php echo htmlspecialchars($employee['HireDate']); ?>" required>

        <label for="position">Position</label>
        <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($employee['Position']); ?>" required>

        <label for="role">User  Type</label>
        <select id="role" name="role" required>
            <option value="Employee" <?php echo ($employee['UserType'] == 'Employee') ? 'selected' : ''; ?>>Employee</option>
            <option value="Admin" <?php echo ($employee['UserType'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
        </select>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Update</button>
    </form>
</body>
</html>