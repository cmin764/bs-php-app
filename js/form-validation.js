// form-validation.js

$(document).ready(function() {
    $('form').on('submit', function(event) {
        // Remove any existing alert
        $('#validation-alert').remove();

        // Get input values
        const name = $('#name').val().trim();
        const city = $('#city').val().trim();
        const email = $('#email').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        let alertMessage = '';

        if (name === "") {
            alertMessage = "Name must be filled in";
        } else if (city === "") {
            alertMessage = "City must be filled in";
        } else if (!emailRegex.test(email)) {
            alertMessage = "Please enter a valid e-mail address";
        }

        if (alertMessage !== '') {
            // Create alert element using jQuery
            const alertDiv = $('<div>', {
                id: 'validation-alert',
                class: 'alert alert-danger',
                role: 'alert',
                text: alertMessage
            });

            // Insert the alert before the form fields
            $(this).prepend(alertDiv);

            // Prevent form submission
            event.preventDefault();
        }
    });
});
