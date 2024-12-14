function updateDateTime() {
    const now = new Date();
    const options = { 
        year: 'numeric', 
        month: 'long', // Full month name
        day: 'numeric', 
    };

    const formattedDate = now.toLocaleDateString('en-US', options);
    const formattedTime = now.toTimeString().split(' ')[0]; // Get time in HH:MM:SS format
    document.getElementById('datetime').textContent = `${formattedDate} at ${formattedTime}`;
}

setInterval(updateDateTime, 1000); // Update every second
updateDateTime();

document.getElementById('search-btn').addEventListener('click', function() {
    var startdate = document.getElementById('startdate').value;
    var enddate = document.getElementById('enddate').value;
    window.location.href = '?startdate=' + startdate + '&enddate=' + enddate;
});