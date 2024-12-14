<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Approval</title>
    <link rel="stylesheet" href="../css/LeaveApplication.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="../javascript/dropdown.js"></script>
    <script src="../javascript/otherPlants.js"></script>
    <script src="../javascript/showforms.js"></script>
    <script src="../javascript/attendannce.js"></script>
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
                Leave Applications / <span class="currentlocation">Human Resources</span>
            </div>
        </div>
    </header>

    <div class="tablediv">
        <h1 style="width: 50%; margin: 0 auto; text-align: center;">Leave Application</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Type Of Leave</th>
                    <th>Start Date Of Leave</th>
                    <th>End Date Of Leave</th>
                    <th>Date Filed</th>
                    <th>Action</th><!--kaya nyo na sarili nyo malaki na kayo-->
                </tr>
            </thead>
            <tbody id="EmployeeList">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

     if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM leaveapplication WHERE Status = 'Waiting For Approval' ORDER BY LeaveID DESC";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['EmployeeID']) . "</td>";
        	        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TypeofLeave']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['StartDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['EndDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DateFiled']) . "</td>";
                    echo "<td><a href='#' class='button button-edit' onclick=\"showaprovform('{$row['EmployeeID']}', '{$row['Name']}', '{$row['StartDate']}', '{$row['EndDate']}', '{$row['TypeofLeave']}', '{$row['TotalDays']}', '{$row['Reason']}', '{$row['LeaveID']}')\">Aprov</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
        </table>
        <div id="overlay" onclick="hideaprovform()"></div> 
    
    <div class="form1" id="aprovform">
    <form class="form2" action="/urbfrm/php/LA_Up.php" method="POST">
        <div class="personalForm">
            <h3>Leave Application</h3>
            <input type="number" id="LId" name="LId" style="Display: none" required readonly>
            <div class="row">
                <div class="form-group">
                    <label for="employeeid">Employee ID</label>
                    <input type="text" id="employeeid" name="employeeid" placeholder="Enter Employee ID" required readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your Name" required readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="startdate">Start Date</label>
                    <input type="date" id="startdate" name="startdate" required readonly>
                </div>
                <div class="form-group">
                    <label for="enddate">End Date</label>
                    <input type="date" id="enddate" name="enddate" required readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="Total Days">Total Days:</label>
                    <input type="text" id="tdays" name="tdays" style="text-align: Center" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="Ltype">Leave Type:</label>
                <input type="text" id="Ltype" name="Ltype" placeholder="Type Of Leave" required readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" placeholder="Reason of Leave" readonly></textarea>
            </div>
            <div class="button-container">
                <button id="btnA" class="button button-edit" name="btnA" type="submit" >Accept</button>
                <button id="btnR" class="button button-delete" name="btnR" type="submit" >Reject</button>
                <button type="button" onclick="hideaprovform()">Close</button>
            </div>
        </div>
    </form>
    </div>
    <script>
         function showaprovform(empid, name, sdate, edate, ltype, tdays, reason, LId) {
            document.getElementById('employeeid').value = empid;
            document.getElementById('name').value = name;
            document.getElementById('startdate').value = sdate;
            document.getElementById('enddate').value = edate;
            document.getElementById('Ltype').value = ltype;
            document.getElementById('tdays').value = tdays;
            document.getElementById('reason').value = reason;
            document.getElementById('LId').value = LId;
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('aprovform').style.display = 'block';
        }

        function hideaprovform() {
            document.getElementById('aprovform').style.display = 'none'; 
            document.getElementById('overlay').style.display = 'none'; 
        }
    </script>
    </div>
</div>
</body>
</html>