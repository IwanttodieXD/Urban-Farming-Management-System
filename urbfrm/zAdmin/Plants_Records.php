<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Records</title>
    <link rel="stylesheet" href="../css/attendance.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../javascript/attendannce.js"></script>
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
                Plant Records / <span class="currentlocation">Plants</span>
            </div>
        </div>
    </header>

    <div class="dateinput">
        <h1>PLANTING RECORDS</h1>
        <input class="startdate" type="date" name="startdate" id="startdate">
        <h3>To</h3>
        <input type="date" name="enddate" id="enddate">
        <button id="search-btn">Search</button>
    </div>

    
    <div class="tablediv">
        <h1>Planting Data</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Plant Name</th>
                    <th>Batch</th>
                    <th>No. Seeds Planted</th>
                    <th>Planting Note</th>
                    <th>Date Planted</th>
                    <th>No. Seeds Transplanted</th>
                    <th>Date Transplanted</th>
                    <th>Transplanting Notes</th>
                    <th>Potting Mix Used</th>
                </tr>
            </thead>
            <tbody id="plantTableBody">
                <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['startdate']) && isset($_GET['enddate'])) {
                $startdate = $_GET['startdate'];
                $enddate = $_GET['enddate'];

                if ($startdate !== '' && $enddate !== '') {
                    $sql = "SELECT PlantName, BatchNum, NoSeedsPlanted, PlantingNote, PlantingDate, NoSeedsTransplanted, DateTransplanted, TransplantingNote, PotMixUsed FROM plantingrecords WHERE PlantingDate BETWEEN '$startdate' AND '$enddate' ORDER BY BatchNum DESC";
                } else {
                    $sql = "SELECT PlantName, BatchNum, NoSeedsPlanted, PlantingNote, PlantingDate, NoSeedsTransplanted, DateTransplanted, TransplantingNote, PotMixUsed FROM plantingrecords ORDER BY BatchNum DESC";
                }
            } else {
                $sql = "SELECT PlantName, BatchNum, NoSeedsPlanted, PlantingNote, PlantingDate, NoSeedsTransplanted, DateTransplanted, TransplantingNote, PotMixUsed FROM plantingrecords ORDER BY BatchNum DESC";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['PlantName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['BatchNum']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NoSeedsPlanted']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PlantingNote']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PlantingDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NoSeedsTransplanted']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DateTransplanted']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TransplantingNote']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PotMixUsed']) . "</td>";
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
    
        <div class="tablediv">
            <h1>Harvesting Data</h1>
            <table border="1">
                <thead>
                    
                    <tr>
 
                        <th>Plant Name</th>
                        <th>Batch</th>
                        <th>Harvest Batch</th>
                        <th>Date Harvested</th>
                        <th>Plants Ready to Harvest</th>
                        <th>Quantity of Harvest (kg)</th>
                        <th>Harvesting Notes</th>
                    </tr>
                </thead>
                <tbody id="plantTableBody">
                <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['startdate']) && isset($_GET['enddate'])) {
                $startdate = $_GET['startdate'];
                $enddate = $_GET['enddate'];

                if ($startdate !== '' && $enddate !== '') {
                    $sql = "SELECT PlantName, PBatchNum, HBatchNum, DateOfHarvest, NoPlantsHarvested, Quantity, Remarks FROM harvestingrecords WHERE DateOfHarvest BETWEEN '$startdate' AND '$enddate' ORDER BY HBatchNum DESC";
                } else {
                    $sql = "SELECT PlantName, PBatchNum, HBatchNum, DateOfHarvest, NoPlantsHarvested, Quantity, Remarks FROM harvestingrecords ORDER BY HBatchNum DESC";
                }
            } else {
                $sql = "SELECT PlantName, PBatchNum, HBatchNum, DateOfHarvest, NoPlantsHarvested, Quantity, Remarks FROM harvestingrecords ORDER BY HBatchNum DESC";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['PlantName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PBatchNum']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['HBatchNum']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DateOfHarvest']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NoPlantsHarvested']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Remarks']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }

            $conn->close();
            ?>
                </tbody>
            </table>
            </div>
    <script>
        document.getElementById('search-btn').addEventListener('click', function() {
            var startdate = document.getElementById('startdate').value;
            var enddate = document.getElementById('enddate').value;
            if (startdate === '' && enddate === '') {
                window.location.href = 'Plants_Records.php';
            } else {
                window.location.href = '?startdate=' + startdate + '&enddate=' + enddate;
            }
        });
    </script>
    </div>
</body>
</html>