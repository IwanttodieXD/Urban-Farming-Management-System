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

// Check if form is submitted for adding a new employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['edit'])) {
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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO employee_tb (Fname, Mname, Lname, Bdate, Sex, Contact, Email, Address, HireDate, Position, EmployeeID, UserType, Password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssss", $firstname, $middlename, $lastname, $birthdate, $sex, $contact, $email, $address, $hiredate, $position, $employeeid, $usertype, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Check if form is submitted for editing an employee
if (isset($_POST['edit'])) {
    $employeeid = $_POST['employeeid'];
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
    $stmt->bind_param("sssssssssssss", $firstname, $middlename, $lastname, $birthdate, $sex, $contact, $email, $address, $hiredate, $position, $usertype, $password, $employeeid);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch employee list
$employeeList = [];
$result = $conn->query("SELECT * FROM employee_tb");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employeeList[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnel List</title>
    <link rel="stylesheet" href="../css/attendance.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="../javascript/dropdown.js"></script>
    <script src="../javascript/otherPlants.js"></script>
    <script src="../javascript/showforms.js"></script>
    <script src="../javascript/attendannce.js"></script>
    
    
</head>
<body>
<div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-items"> 
                <li class="logo-item">
                    <img class="logo" src="../img/urban farming logo 3.png" alt="logo">
                </li>
                <li>
                    <i class="fa-regular fa-calendar-check"></i><a href="Landing_Admin.html" class="item-text">Attendance</a>
                </li>
                <li>
                    <i class="fas fa-people-group"></i><span class="item-text">Human Resources</span>
                </li>
                <ul class="sub-hr" style="display: none;">
                    <li><i class="fa-regular fa-address-book"></i><a href="PersonnelList.php" class="item-text">Employee List</a><i></i></li>
                    <li><i class="fas fa-user-plus"></i><a href="Personnel_Add.html" class="item-text">Add Personnel</a></li>
                    <li><i class="fas fa-file-pen"></i><a href="Leave_Approval.php" class="item-text">Leave Application</a></li>
                    <li><i class="fa-regular fa-calendar-check"></i><a href="AttendanceSummary.php" class="item-text">Attendance Summary</a></li>
                    
                </ul>
                <li>
                    <i class="fas fa-warehouse"></i><span class="item-text">Inventory</span>
                </li>
                <ul class="sub-inv" style="display: none;"> 
                    <li><i class="fas fa-trowel"></i><a href="Admin_InvTools.php" class="item-text" >Tools</a></li>
                    <li><i class="fas fa-sack-xmark"></i><a href="Admin_InvPotMix.php" class="item-text">Pot Mix</a></li>
                    <li><i class="fa-regular fa-clipboard"></i><a href="Records_Tool.php" class="item-text">Tools Records</a></li>
                    <li><i class="fa-regular fa-clipboard"></i><a href="Records_PotMix.php" class="item-text">Inventory Records</a></li>
                </ul>
                <li>
                    <i class="fas fa-seedling"></i><span class="item-text">Plants</span>
                </li>
                <ul class="sub-plants" style="display: none;"> 
                    <li><i class="fas fa-apple-whole"></i><a href="Plants_Records.php" class="item-text">Plant Records</a></li>
                </ul>
                <li><i class="fa-regular fa-calendar"></i><a href="Events_Manage.php" class="item-text">Events</a></li>
            </ul>
            <li class="last"><i class="fas fa-right-from-bracket"></i><a href="/urbfrm/landing_main.php" action="/urbfrm/php/sessionend.php" class="item-text">Log Out</a></li> <!-- Last item outside the wrapper -->
        </div>
    </div>

<div id="content">
    <header>
        <div class="info-container">
            <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
            <img src="../img/urban farming logo 3.png" alt="Logo" class="info-image">
        </div>
        
        <div class="content">
            <div class="location">
                Personnel List / <span class="currentlocation">Plants</span>
            </div>
        </div>
    </header>
    
    <div class="tablediv">
        <h1>Employee List</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Employee Id</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="EmployeeList">
                <?php foreach ($employeeList as $employee): ?>
                <tr>
                    <td><img src="/urbfrm/php/<?php echo $employee['Image']; ?>" style="width: 100px; height: 100px;"></td>
                    <td><?php echo htmlspecialchars($employee['EmployeeID']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Fname'] . ' ' . $employee['Mname'] . ' ' . $employee['Lname']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Position']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Contact']); ?></td>
                    <td>
                        <a href="/urbfrm/php/editemployee.php?id=<?php echo htmlspecialchars($employee['EmployeeID']); ?>" class="button button-edit">Edit</a>
                        <a href="/urbfrm/php/deleteemployee.php?EmployeeID=<?php echo htmlspecialchars($employee['EmployeeID']); ?>" 
                       class="button button-delete" 
                       id="btndel"
                       onclick="return confirmDelete();">
                       Delete
                    </a>

                    <script>
                    function confirmDelete() {
                        if (confirm('Are you sure you want to delete this item?')) {
                            alert('Delete Success! :D');
                            return true;
                        } else {
                            return false;
                        }
                    }
                    </script>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>