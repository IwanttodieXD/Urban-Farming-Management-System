<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU-CUAI Events</title>
    <link rel="stylesheet" href="css/navstyleview.css">
    <link rel="stylesheet" href="css/eventss.css">
    <link rel="stylesheet" href="css/headerlanding.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
<style>
    body{
        background-image: url(img/login.jpg);
        
    }
    .events{
        background-color: #f5f5dc;
    }
    #content{
        background-image: url(img/login.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;  
    }
</style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-items"> 
                <li class="logo-item">
                    <img class="logo" src="img/urban farming logo 3.png" alt="logo">
                </li>
                <li>
                    <i class="fa-regular fa-calendar-days"></i><a href="Landing_Main.php" class="item-text" id="loadEvents">Events</a>
                </li>
                <li>
                    <i class="fas fa-info"></i><span class="item-text" id="loadAbout">About Us</span>
                </li>         
                <li>
                    <i class="fas fa-arrow-right-to-bracket"></i><a href="login.php" class="item-text">Login</a>
                </li>
            </ul>
        </div>
    </div>

    <div id="content">
        <div>
            <header>
                <div class="info-container">
                    <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
                    <img src="img/urban farming logo 3.png" alt="Logo" class="info-image">
                </div>
                    
                <div class="contentss">
                    <div class="location">
                       Events / <span class="currentlocation"></span>
                    </div>
                </div>
            </header>
        <div>
            <div id="event-container" class="events"></div>
        </div>
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
            
        
            
            </script>
    <script src="javascript/loadcontentslanding.js"></script>
</body>
</html>