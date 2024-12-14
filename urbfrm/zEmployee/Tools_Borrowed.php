<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools Borrowed</title>
    <link rel="stylesheet" href="../css/attendance.css">
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
                    <i class="fas fa-people-group"></i><a href="Leave_Application.php" class="item-text">Apply For Leave</a>
                </li>         
                <li>
                    <i class="fas fa-warehouse"></i><span class="item-text">Inventory</span>
                </li>
                <ul class="sub-inv" style="display: none;"> 
                    <li><i class="fas fa-trowel"></i><a href="Tools.php" class="item-text">Tools</a></li>
                    <li><i class="fas fa-trowel-bricks"></i><a href="Tools_Borrowed.php" class="item-text">Borrowed Tools</a></li>
                    <li><i class="fas fa-sack-xmark"></i><a href="PotMix.php" class="item-text">Pot Mix</a></li>
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
<div id="content">
<body>
    <header>
        <div class="info-container">
            <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
            <img src="../img/urban farming logo 3.png" alt="Logo" class="info-image">
        </div>
        
        <div class="content">
            <div class="location">
                Tools Borrowed / <span class="currentlocation">Inventory</span>
            </div>
        </div>
    </header>
    <div class="dateinput">
        <h1>Tools Borrowed Record</h1>
        <input class="borrowerid" type="text" name="bID" id="bID" placeholder="Search Borrower's ID" style="width: 25%; margin: 0 auto;">
        <button id="search-btn">Search</button>
    </div>
    <div class="tablediv">
        <h1>Inventory Records</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Borrower ID</th>
                    <th>Affiliation</th>
                    <th>Item Name</th>
                    <th>Quantity Taken</th>
                    <th>Borrower's Name</th>
                    <th>Borrower's Contact</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="toolTableBody">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['bID'])) {
                $bID = $_GET['bID'];

                if ($bID !== '') {
                    $sql = 
                    "SELECT CONCAT(EmployeeID, Student_Id) AS 'Borrower ID',
                    toolsusage.* 
                    FROM toolsusage
                    WHERE CONCAT(EmployeeID, Student_Id) = '$bID' AND Bstatus = 'Borrowed'
                    ORDER BY UsageID DESC";
                } else {
                    $sql = 
                    "SELECT CONCAT(EmployeeID, Student_Id) AS 'Borrower ID',
                    toolsusage.* 
                    FROM toolsusage
                    WHERE Bstatus = 'Borrowed'
                    ORDER BY UsageID DESC";
                }
            } else {
                $sql = 
                "SELECT CONCAT(EmployeeID, Student_Id) AS 'Borrower ID',
                toolsusage.*  
                FROM toolsusage
                WHERE Bstatus = 'Borrowed'
                ORDER BY UsageID DESC";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['Borrower ID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Baffil']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ToolName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Bname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Bcontact']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['UsageDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Bstatus']) . "</td>";
                    echo "<td><a href='/urbfrm/php/update_status.php?usage_id=" . urlencode($row['UsageID']) . "&quantity=" . urlencode($row['Quantity']) . "&toolname=" . urlencode($row['ToolName']) . "' class='button-done' onclick=\"return confirm('Are you sure you want to return this item?');\">Return</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
            </table>
        </div>
        <script>
        document.getElementById('search-btn').addEventListener('click', function() {
            var bID = document.getElementById('bID').value;
            if (bID === '') {
                window.location.href = 'Tools_Borrowed.php';
            } else {
                window.location.href = '?bID=' + bID;
            }
        });
        </script>
    </body>
</div>
</html>