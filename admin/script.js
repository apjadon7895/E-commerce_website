document.getElementById('loginForm').addEventListener('submit', function(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('errorMessage');
    
    errorMessage.textContent = ''; // Clear previous errors

    if (username === '' || password === '') {
        errorMessage.textContent = 'All fields are required!';
        event.preventDefault(); // Prevent form submission
    }

    if (password.length < 6) {
        errorMessage.textContent = 'Password must be at least 6 characters!';
        event.preventDefault();
    }
});
