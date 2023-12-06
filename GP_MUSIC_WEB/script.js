function validateForm() {
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');

    if (password.match(/[A-Z]/) && !password.match(/[^a-zA-Z0-9]/)) {
        errorMessage.textContent = '';
        alert('Login successful!');
    } else {
        errorMessage.textContent = 'Password must contain at least 1 uppercase letter and no special characters.';
    }
}
