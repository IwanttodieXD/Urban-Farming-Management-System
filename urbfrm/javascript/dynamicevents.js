 // Sample data fetched from a database
 const events = [
    {
        image: 'https://via.placeholder.com/150',
        title: 'Event Title 1',
        description: 'This is a description of event 1.',
        date: '2023-10-01',
        time: '10:00 AM',
        links: 'http://example.com/event1'
    },
    {
        image: 'https://via.placeholder.com/150',
        title: 'Event Title 2',
        description: 'This is a description of event 2.',
        date: '2023-10-02',
        time: '11:00 AM',
        links: 'http://example.com/event2'
    }
];

const container = document.getElementById('event-container');

events.forEach(event => {
    const eventCard = document.createElement('div');
    eventCard.classList.add('event-card');

    eventCard.innerHTML = `
        <img src="${event.image}" alt="${event.title}">
        <h2>${event.title}</h2>
        <p>${event.description}</p>
        <h3>Date: ${event.date}</h3>
        <h3>Time: ${event.time}</h3>
        <h3>Links: <a href="${event.links}" target="_blank">${event.links}</a></h3>
        <div class="buttons">
            <button class="delete-button" onclick="deleteEvent('${event.title}')">Delete</button>
            <button class="update-button" onclick="updateEvent('${event.title}')">Update</button>
        </div>
    `;

    container.appendChild(eventCard);
});

function deleteEvent(title) {
    alert(`Delete event: ${title}`);
    // Implement delete logic here
}

function updateEvent(title) {
    alert(`Update event: ${title}`);
    // Implement update logic here
}