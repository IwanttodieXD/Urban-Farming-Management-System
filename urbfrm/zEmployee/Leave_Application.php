<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'qcu-cuai');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
    <link rel="stylesheet" href="../css/LeaveApplication.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/eventss.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="../javascript/dropdownemployees.js"></script>
    <script src="../javascript/otherPlants.js"></script>
    <script src="../javascript/showforms.js"></script>
    <script src="../javascript/attendannce.js"></script>
    <script src="..//javascript/showinputfields.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-items"> 
                <li class="logo-item">
                    <img class="logo" src="../img/urban farming logo 3.png" alt="logo">
                </li>
                <li>
                    <i class="fas fa-calendar"></i><a href="Landing_Employee.html" class="item-text">Attendance</a>
                </li>
                <li>
                    <i class="fas fa-people-group"></i><a href="Leave_Application.php" class="item-text" target="_blank">Apply For Leave</a>
                </li>         
                <li>
                    <i class="fas fa-warehouse"></i><span class="item-text">Inventory</span>
                </li>
                <ul class="sub-inv" style="display: none;"> 
                    <li><i class="fas fa-trowel"></i><a href="Tools.php" class="item-text">Tools</a></li>
                    <li><i class="fas fa-trowel-bricks"></i><a href="Tools_Borrowed.php" class="item-text">Borrowed Tools</a></li>
                    <li><i class="fas fa-sack-xmark"></i><a href="PotMix.php" class="item-text" target="_blank">Pot Mix</a></li>
                </ul>
                <li>
                    <i class="fas fa-seedling"></i><span class="item-text">Plants</span>
                </li>
                <ul class="sub-plants" style="display: none;"> 
                    <li id="loadFruit"><i class="fas fa-apple-whole"></i><a a href="Plants_Fruit.php" class="item-text">Fruit Bearing</a></li>
                    <li><i class="fas fa-carrot"></i><a href="Plants_Root.php" class="item-text">Root Crops</a></li>
                    <li><i class="fas fa-leaf"></i><a href="Plants_Herbs.php" class="item-text">Herbs</a></li>
                </ul>
            </ul>
            <li class="last"><i class="fas fa-right-from-bracket"></i><a href="/urbfrm/landing_main.php" action="/urbfrm/php/sessionend.php" class="item-text">Log Out</a></li> <!-- Last item outside the wrapper -->
        </div>
    </div>
    <style>
        #overlay {
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1000; 
        }

        .form1 {
            display: none; 
            position: fixed;
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            z-index: 1001; 
        }
    </style>
</head>
<body>
<div id="content">
    <header>
        <div class="info-container">
            <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
            <img src="../img/urban farming logo 3.png" alt="Logo" class="info-image">
        </div>
        
        <div class="content">
            <div class="location">
                Leave Application / <span class="currentlocation">Home</span>
            </div>
        </div>
    </header>

    <div class="button-container">
        <button type="button" class="applybutton" onclick="showInsertForm(event)">Apply </button>
    </div>
    
    <div class="tablediv">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Type of Leave</th>
                    <th>Start Date of Leave</th>
                    <th>End Date Of Leave</th>
                    <th>Reason Of Leave</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="EmployeeList">
            <?php
            $employee_id = $_SESSION['employee_id'];
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT LeaveID, EmployeeID, Name, TypeofLeave, StartDate, EndDate, Reason, Status FROM leaveapplication WHERE EmployeeID = ? ORDER BY LeaveID DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $employee_id);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                   echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['EmployeeID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TypeofLeave']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['StartDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['EndDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Reason']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            $stmt->close();
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>

    <div id="overlay" onclick="hideInsertForm()"></div> 
    
    <div class="form1" id="insertForm">
    <form class="form2" action="Leave_Application.php" method="POST">
        <div class="personalForm">
            <h3>Leave Application</h3>
            <div class="row">
                <div class="form-group">
                    <label for="employeeid"> 
                    <label for="employeeid">Employee ID</label>
                    <input type="text" id="employeeid" name="employeeid" placeholder="Enter Employee ID" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your Name" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="startdate">Start Date</label>
                    <input type="date" id="startdate" name="startdate" required>
                </div>
                <div class="form-group">
                    <label for="enddate">End Date</label>
                    <input type="date" id="enddate" name="enddate" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Ltype">Leave Type:</label>
                <input type="text" id="Ltype" name="Ltype" placeholder="Type Of Leave" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" placeholder="Reason of Leave"></textarea>
            </div>
            <div class="button-container">
                <button id="btnleave" name="btnleave" type="submit" >Submit</button>
                <button type="button" onclick="hideInsertForm()">Cancel</button>
            </div>
        </div>
    </form>
    </div>
    <?php
$conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnleave'])) {
    $employeeId = $conn->real_escape_string($_POST['employeeid']);
    $name = $conn->real_escape_string($_POST['name']);
    $startDate = $conn->real_escape_string($_POST['startdate']);
    $endDate = $conn->real_escape_string($_POST['enddate']);
    $leaveType = $conn->real_escape_string($_POST['Ltype']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $datefiled =  date('Y-m-d');

    $sql = "INSERT INTO leaveapplication (EmployeeID , Name, StartDate, EndDate, TotalDays, DateFiled, TypeofLeave, Reason, Status) 
            VALUES ('$employeeId', '$name', '$startDate', '$endDate', DATEDIFF(EndDate, StartDate) + 1, '$datefiled', '$leaveType', '$reason', 'Waiting For Approval')";

    if ($conn->query($sql) === TRUE) {
        echo ("<script>alert('Success :D')</script>");
        echo ("<script>window.location.href='Leave_Application.php';</script>");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
    <script>
        function showInsertForm(event) {
            event.preventDefault();
            document.getElementById('insertForm').style.display = 'block'; 
            document.getElementById('overlay').style.display = 'block'; 
        }

        function hideInsertForm() {
            document.getElementById('insertForm').style.display = 'none'; 
            document.getElementById('overlay').style.display = 'none'; 
        }
    </script>
</div>
</body>
</html>