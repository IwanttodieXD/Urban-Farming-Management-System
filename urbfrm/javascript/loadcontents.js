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
    function setupPersonnelEventListeners() {
        document.getElementById('loadpersonnel').addEventListener('click', function(event) {
            event.preventDefault();
            loadContent('AddPersonnel.html'); // Load moreTools.html
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

    document.getElementById('loademployeelist').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('PersonnelList.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadaddpersonnel').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Personnel_Add.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadLeave').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Leave_Approval.php'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadattendancesummary').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('AttendanceSummary.php'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadTools').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Admin_InvTools.php'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadPot').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Admin_InvPotMix.php'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadFruit').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('Plants_Fruit.php'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadRoot').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Plants_Root.php'); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadHerbs').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Sample_List.php'); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadInv').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Records_PotMix.php'); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadRecord').addEventListener('click', function(event) {
        event.preventDefault(); 
        loadContent('Records_Tool.php'); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadEvents').addEventListener('click', function(event) {
        event.preventDefault(); 
        setActiveLink(this.parentElement); 
    });

    document.getElementById('loadAbout').addEventListener('click', function(event) {
 event.preventDefault(); 
        loadContent('aboutus.html', setupPersonnelEventListeners);
        setActiveLink(this.parentElement);
    });
    
});

