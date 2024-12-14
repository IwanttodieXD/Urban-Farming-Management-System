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

    document.getElementById('loadAbout').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('aboutus.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

    document.getElementById('loadLogin').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        loadContent('login.html'); // Change to the correct file name
        setActiveLink(this.parentElement); // Set active class
    });

});