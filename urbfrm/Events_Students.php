<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Slideshow</title>
    <link rel="stylesheet" href="css/studentevents.css">
</head>
<body>
    <div class="slideshow-container">
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
            // Loop through each event and create a slide
            while($row = $result->fetch_assoc()) {
                echo "
                    <div class='slide fade'>
                        <div class='event-card'>
                            <img src='{$row['Image']}' alt='{$row['Title']}' class='event-image'>
                            <h2 class='event-title'>{$row['Title']}</h2>
                            <p class='event-description'>{$row['Description']}</p>
                            <h3 class='event-date'>Date: {$row['Date']}</h3>
                            <h3 class='event-time'>Time: {$row['Time']}</h3>
                            <h3 class='event-links'>Links: <a href='{$row['AttendanceLink']}' target='_blank'>Attendance</a> | <a href='{$row['FeedbackLink']}' target='_blank'>Feedback</a></h3>
                        </div>
                    </div>
                ";
            }
        } else {
            echo "<p>No events available</p>";
        }

        $conn->close();
        ?>
        
        <!-- Navigation Buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.querySelectorAll(".slide");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none"; // Hide all slides
            }
            if (slideIndex >= slides.length) { slideIndex = 0; } // Reset to first slide if at the end
            if (slideIndex < 0) { slideIndex = slides.length - 1; } // Loop back to last slide if at the beginning
            slides[slideIndex].style.display = "block"; // Show the current slide
        }

        function plusSlides(n) {
            slideIndex += n; // Adjust slide index
            showSlides(); // Show the updated slide
        }
    </script>
</body>
</html>