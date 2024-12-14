function loadNavbar() {
    fetch('Navigation.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('navbar').innerHTML = data;
        });
    }
            window.onload = loadNavbar;