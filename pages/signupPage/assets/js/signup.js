document.addEventListener('DOMContentLoaded', function() {

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const messageSpan = document.getElementById('password-match-message');

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                messageSpan.textContent = 'Passwords match!';
                messageSpan.className = 'password-message match';
            } else {
                messageSpan.textContent = 'Passwords do not match!';
                messageSpan.className = 'password-message mismatch';
            }
        } else {
            messageSpan.textContent = '';
            messageSpan.className = 'password-message';
        }
    }

    passwordInput.addEventListener('keyup', checkPasswordMatch);
    confirmPasswordInput.addEventListener('keyup', checkPasswordMatch);

});