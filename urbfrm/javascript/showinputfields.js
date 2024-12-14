function showInputField() {
    const affiliation = document.getElementById('affiliation').value;
    const studentIdContainer = document.getElementById('studentIdContainer');
    const facultyContainer = document.getElementById('facultyContainer');

    // Reset both containers to hidden
    studentIdContainer.classList.add('hidden');
    facultyContainer.classList.add('hidden');

    // Show the appropriate input field based on selection
    if (affiliation === 'student') {
        studentIdContainer.classList.remove('hidden');
    } else if (affiliation === 'staff') {
        facultyContainer.classList.remove('hidden');
    }
}