<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/tool.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/eventss.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="javascript/dropdownemployees.js"></script>
    <script src="javascript/otherPlants.js"></script>
    <script src="javascript/showforms.js"></script>
    <script src="javascript/attendannce.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-items"> 
                <li class="logo-item">
                    <img class="logo" src="img/urban farming logo 3.png" alt="logo">
                </li>
                <li>
                    <i class="fas fa-calendar"></i><a href="#" class="item-text" id="loadAttendance">Attendance</a>
                </li>
                <li>
                    <i class="fas fa-people-group"></i><span class="item-text" id="loadApply">Apply For Leave</span>
                </li>         
                <li>
                    <i class="fas fa-warehouse"></i><span class="item-text">Inventory</span>
                </li>
                <ul class="sub-inv" style="display: none;"> 
                    <li><i class="fas fa-trowel"></i><a href="#" class="item-text" id="loadTools">Tools</a></li>
                    <li><i class="fas fa-sack-xmark"></i><a href="#" class="item-text" id="loadPot">Pot Mix</a></li>
                </ul>
                <li>
                    <i class="fas fa-seedling"></i><span class="item-text">Plants</span>
                </li>
                <ul class="sub-plants" style="display: none;"> 
                    <li id="loadFruit"><i class="fas fa-apple-whole"></i><a href="#" class="item-text" id="loadFruit">Fruit Bearing</a></li>
                    <li><i class="fas fa-carrot"></i><a href="#" class="item-text" id="loadRoot">Root Crops</a></li>
                    <li><i class="fas fa-leaf"></i><a href="#" class="item-text" id="loadHerbs">Herbs</a></li>
                </ul>
                <li><i class="fa-regular fa-calendar"></i><a href="Events_View.html" class="item-text" id="loadEvents">Events</a></li>
                <li><i class="fas fa-info"></i><a href="#" class="item-text" id="loadAbout">About Us</a></li>
            </ul>
            <li class="last"><i class="fas fa-right-from-bracket"></i><span class="item-text">Log Out</span></li>
        </div>
    </div>

    <div id="content">
        <header>
            <div class="info-container">
                <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
                <img src="img/urban farming logo 3.png" alt="Logo" class="info-image">
            </div>
                
            <div class="content">
                <div class="location">
                   Events / <span class="currentlocation"></span>
                </div>
            </div>
        </header>
        <div>
            <div id="event-container" class="events">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch events from the database
                $sql = "SELECT * FROM events";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <div class='event-card'>
                                <img src='{$row['Image']}' alt='{$row['Title']}' class=' event-image'>
                                <h2 class='event-title'>{$row['Title']}</h2>
                                <p class='event-description'>{$row['Description']}</p>
                                <h3 class='event-date'>Date: {$row['Date']}</h3>
                                <h3 class='event-time'>Time: {$row['Time']}</h3>
                                <h3 class='event-links'>Links: <a href='{$row['AttendanceLink']}' target='_blank'>Attendance</a> | <a href='{$row['FeedbackLink']}' target='_blank'>Feedback</a></h3>
                                <div class='buttons'>
                                </div>
                            </div>
                        ";
                    }
                } else {
                    echo "<p>No events available</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="javascript/loademployeecontents.js"></script>
</body>
</html>