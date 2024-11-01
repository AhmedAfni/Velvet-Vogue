function signOut() {
    // Add your sign-out logic here, e.g., redirect to a logout script or clear session
    window.location.href = '../php/home.php'; // Example redirect to logout
}

// Handle form submission for editing profile
document.getElementById('editProfileForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Add logic to save changes (e.g., AJAX request to update user info)
    alert('Profile updated successfully!');
    // Close the modal
    var modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
    modal.hide();
});