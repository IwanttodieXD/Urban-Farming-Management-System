document.addEventListener('DOMContentLoaded', function() {
    function loadContent(filename) {
        fetch(filename)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.querySelector('#content').innerHTML = data; // Load the new content into the #content div
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function setActiveLink(link) {
        // Remove active class from all links
        const navItems = document.querySelectorAll('.nav-items li');
        navItems.forEach(item => item.classList.remove('active'));

        // Add active class to the clicked link
        link.classList.add('active');
    }

    // Event listeners for navbar links
    document.getElementById('loadAttendance').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Attendance.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadApply').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Leave_Application.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadTools').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Tools.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadPot').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('PotMix.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadFruit').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Plants_Fruit.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadRoot').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Plants_Root.html'); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadHerbs').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Plants_Herbs.html'); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadEvents').addEventListener('click', function(event) {
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadAbout').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('aboutus.html');
        setActiveLink(this.parentElement);
    });

    document.getElementById('loadBorrowed').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Tools_Borrowed.html');
        setActiveLink(this.parentElement);
    });
});