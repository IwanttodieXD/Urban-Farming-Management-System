let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.querySelectorAll(".slide");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
}

function plusSlides(n) {
    slideIndex += n - 1;
    showSlides();
}

document.getElementById('addEventButton').onclick = function() {
    const addForm = document.getElementById('addForm');
    const overlay = document.getElementById('overlay');

    // Toggle the display of the form and overlay
    if (addForm.style.display === "none") {
        addForm.style.display = "block";
        overlay.style.display = "block"; // Show the overlay
    } else {
        addForm.style.display = "none";
        overlay.style.display = "none"; // Hide the overlay
    }
};

// Close the form when clicking outside of it
window.onclick = function(event) {
    const addForm = document.getElementById('addForm');
    const overlay = document.getElementById('overlay');
    if (event.target === overlay) {
        addForm.style.display = "none";
        overlay.style.display = "none"; // Hide the overlay
    }
};