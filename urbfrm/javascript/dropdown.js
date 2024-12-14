document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle the display of a submenu
    function toggleSubMenu(itemSelector, subMenuSelector) {
        const item = document.querySelector(itemSelector);
        const subMenu = document.querySelector(subMenuSelector);
        
        item.addEventListener('click', function() {
            // Toggle the display of the sub-menu
            if (subMenu.style.display === "none" || subMenu.style.display === "") {
                subMenu.style.display = "block"; // Show sub-menu
            } else {
                subMenu.style.display = "none"; // Hide sub-menu
            }
        });
    }

    // Set up toggle for each section
    toggleSubMenu('li:nth-child(3)', '.sub-hr'); // Attendance -> Human Resources
    toggleSubMenu('li:nth-child(5)', '.sub-inv'); // Inventory
    toggleSubMenu('li:nth-child(7)', '.sub-plants'); // Plants
});