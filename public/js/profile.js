function updateEmail() {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/;

    const emailInput = document.getElementById('email');
    const email = emailInput.value;
    const errorEmail = document.getElementById('error-email');

    // Reset styles
    errorEmail.classList.add('d-none');
    emailInput.classList.remove('is-invalid');

    let isValid = true;

    if (email.trim() === '') {
        errorEmail.textContent = "Please enter an email address.";
        errorEmail.classList.remove('d-none');
        emailInput.classList.add('is-invalid');
        isValid = false;
    }
    else if (!emailPattern.test(email)) {
        errorEmail.textContent = "Enter email address in valid format.";
        errorEmail.classList.remove('d-none');
        emailInput.classList.add('is-invalid');
        isValid = false;
    }

    return isValid;
}
