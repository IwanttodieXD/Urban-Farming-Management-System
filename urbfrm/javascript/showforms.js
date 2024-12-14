function showEditForm(event) {
    event.preventDefault(); 
    document.getElementById('editForm').style.display = 'block'; 
    document.getElementById('overlay').style.display = 'block'; 
}

function hideEditForm() {
    document.getElementById('editForm').style.display = 'none'; 
    document.getElementById('overlay').style.display = 'none'; 
}

function showInsertForm(event) {
    event.preventDefault();
    document.getElementById('insertForm').style.display = 'block'; 
    document.getElementById('overlay').style.display = 'block'; 
}

function hideInsertForm() {
    document.getElementById('insertForm').style.display = 'none'; 
    document.getElementById('overlay').style.display = 'none'; 
}