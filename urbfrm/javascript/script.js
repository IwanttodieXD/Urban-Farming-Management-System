function loadContent(event, page) {
    event.preventDefault(); // Prevent the default link behavior

    const contentDiv = document.getElementById('content');

    // Simulate loading content from the specified page
    fetch(page)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            contentDiv.innerHTML = data; // Update the content area
        })
        .catch(error => {
            contentDiv.innerHTML = '<h2>Error loading page</h2>';
            console.error('There was a problem with the fetch operation:', error);
        });
}

function loadOther(event, page) {
    event.preventDefault(); // Prevent the default link behavior

    const Othercontent = document.getElementById('othercontent');

    // Simulate loading content from the specified page
    fetch(page)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            Othercontent.innerHTML = data; // Update the content area
        })
        .catch(error => {
            Othercontent.innerHTML = '<h2>Error loading page</h2>';
            console.error('There was a problem with the fetch operation:', error);
        });
}