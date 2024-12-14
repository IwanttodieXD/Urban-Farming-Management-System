<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Events</title>
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/eventss.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/addevent.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
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
                    Events / <span class="currentlocation"></span>
                </div>
            </div>
        </header>

        <div>
            <div class="buttondiv">
                <button type="button" class="button-adding" id="addEventButton">Add Events</button>
            </div>
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
                                <img src='{$row['Image']}' alt='{$row['Title']}' class='event-image'>
                                <h2 class='event-title'>{$row['Title']}</h2>
                                <p class='event-description'>{$row['Description']}</p>
                                <h3 class='event-date'>Date: {$row['Date']}</h3>
                                <h3 class='event-time'>Time: {$row['Time']}</h3>
                                <h3 class='event-links'>Links: <a href='{$row['AttendanceLink']}' target='_blank'>Attendance</a> | <a href='{$row['FeedbackLink']}' target='_blank'>Feedback</a></h3>
                                <div class='buttons'>
                                    <a href='#' class='button button-edit' onclick=\"showEventForm('{$row['EventID']}', '{$row['Title']}', '{$row['Description']}', '{$row['Date']}', '{$row['Time']}', '{$row['AttendanceLink']}', '{$row['FeedbackLink']}', '{$row['Image']}', '{$row['Location']}')\">Edit</a>
                                    <a href='deleteevent.php?EventID={$row['EventID']}' class='button button-delete' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
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

        <div class="overlay" id="overlay"></div>
        <div class="addform" id="addForm" style="display: none;">
            <form class="form-container" id="eventForm">
                <div class="upload-section">
                    <div class="input-box">
                        <label for="image-link">Image Link</label>
                        <input type="url" id="image-link" name="Image" placeholder="Enter Image URL" required>
                    </div>
                </div>
                <div class="details-section">
                    <input type="text" name="Title" placeholder="Event Title" class="input-box" required>
                    <textarea name="Description" placeholder="Description of the Event" class="input-box" rows="4" required></textarea>
                    <div class="row">
                        <input type="text" name="Location" placeholder="Where" class="input-box half" required>
                        <input type="date" name="Date" placeholder="Date" class="input-box half" required>
                    </div>
                    <div class="row">
                        <input type="time" name="Time" placeholder="Time" class="input-box half" required>
                        <input type="url" name="AttendanceLink" placeholder="Attendance Link" class="input-box half" required>
                    </div>
                    <input type="url" name="FeedbackLink" placeholder="Feedback Link" class="input-box half">
                    <div class="buttons">
                        <button type="submit" class="button button-done">Done</button>
                        <button type="button" class="button button-cancel" onclick="hideaddForm()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="editform" id="editForm" style="display: none;">
            <form class="form-container" id="eventForm">
                <div class="upload-section">
                    <div class="input-box">
                        <label for="image-link">Image Link</label>
                        <input type="url" id="image-link" name="Image" placeholder="Enter Image URL" required>
                    </div>
                </div>
                <div class="details-section">
                    <input type="text" name="Title" placeholder="Event Title" class="input-box" required>
                    <textarea name="Description" placeholder="Description of the Event" class="input-box" rows="4" required></textarea>
                    <div class="row">
                        <input type="text" name="Location" placeholder="Where" class="input-box half" required>
                        <input type="date" name="Date" placeholder="Date" class="input-box half" required>
                    </div>
                    <div class="row">
                        <input type="time" name="Time" placeholder="Time" class="input-box half" required>
                        <input type="url" name="AttendanceLink" placeholder="Attendance Link" class="input-box half" required>
                    </div>
                    <input type="url" name="FeedbackLink" placeholder="Feedback Link" class="input-box half">
                    <div class="buttons">
                        <button type="submit" class="button button-done">Done</button>
                        <button type="button" class="button button-cancel" onclick="hideEditForm()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.getElementById('addEventButton').onclick = function() {
                const addForm = document.getElementById('addForm');const overlay = document.getElementById('overlay');

if (addForm.style.display === "none") {
    addForm.style.display = "block";
    overlay.style.display = "block";
} else {
    addForm.style.display = "none";
    overlay.style.display = "none";
}
};

window.onclick = function(event) {
const addForm = document.getElementById('addForm');
const overlay = document.getElementById('overlay');
if (event.target === overlay) {
    hideaddForm();
}
};

function hideaddForm() {
const addForm = document.getElementById('addForm');
const overlay = document.getElementById('overlay');
addForm.style.display = "none";
overlay.style.display = "none";
}

document.getElementById('eventForm').onsubmit = function(event) {
event.preventDefault(); // Prevent the default form submission

const formData = new FormData(this); // Use the form data directly

// Send the data to the PHP script using fetch
fetch('addevents.php', {
    method: 'POST',
    body: formData
})
.then(response => response.text())
.then(data => {
    alert(data); // Show success message
    location.reload(); // Reload the page to show the new event
})
.catch(error => {
    console.error('Error:', error);
});
};

function showEventForm(eventID, title, description, date, time, attendanceLink, feedbackLink, image, location) {
        // Populate the form with the event data
        document.getElementById('image-link').value = image;
        document.querySelector('input[name="Title"]').value = title;
        document.querySelector('textarea[name="Description"]').value = description;
        document.querySelector('input[name="Location"]').value = location;
        document.querySelector('input[name="Date"]').value = date;
        document.querySelector('input[name="Time"]').value = time;
        document.querySelector('input[name="AttendanceLink"]').value = attendanceLink;
        document.querySelector('input[name="FeedbackLink"]').value = feedbackLink;
        
        // Show the add form as an update form
        const addForm = document.getElementById('addForm');
        const overlay = document.getElementById('overlay');
        addForm.style.display = "block";
        overlay.style.display = "block";
        
        // Change the form submission to update the event
        document.getElementById('eventForm').onsubmit = function(event) {
            event.preventDefault(); // Prevent the default form submission
        
            const formData = new FormData(this);
            formData.append('EventID', eventID); // Add the event ID to the form data
        
            // Send the data to the PHP script using fetch
            fetch('updateEvent.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Show success message
                setTimeout(function() {
                    window.location.reload();
                }, 10); // Reload the page after 1 second
            })
            .catch(error => {
                console.error('Error:', error);
            });
        };
    }
</script>
</div>
<script src="../javascript/loadcontents.js"></script>
</body>
</html>