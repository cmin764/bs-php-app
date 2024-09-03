// form-validation.js

$(document).ready(function () {
  $("form").on("submit", function (event) {
    // Remove any existing alert
    $("#validationAlert").remove();

    // Get input values
    const name = $("#name").val().trim();
    const city = $("#city").val().trim();
    const email = $("#email").val().trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let alertMessage = "";

    if (name === "") {
      alertMessage = "Name must be filled in";
    } else if (city === "") {
      alertMessage = "City must be filled in";
    } else if (!emailRegex.test(email)) {
      alertMessage = "Please enter a valid e-mail address";
    }

    if (alertMessage !== "") {
      // Create alert element using jQuery
      const alertDiv = $("<div>", {
        id: "validationAlert",
        class: "alert alert-danger",
        role: "alert",
        text: alertMessage,
      });

      // Insert the alert before the form fields
      $(this).prepend(alertDiv);

      // Prevent form submission
      event.preventDefault();
      return;
    }

    /* Form submission */
    event.preventDefault();
    const formData = $(this).serialize(); // Serialize form data

    $.ajax({
      type: "POST",
      url: "create.php", // The PHP file which handles the POST request
      data: formData,
      dataType: "json", // Expect a JSON response from the server this time
      success: function (response) {
        if (response.success) {
          $("#responseMessage").html(
            '<div class="alert alert-success">Done!</div>'
          );
          // Redirect to the URL returned by the server
          window.location.href = response.redirect;
        } else {
          // Handle other cases if needed
          $("#responseMessage").html(
            '<div class="alert alert-danger">Data not accepted!</div>'
          );
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        $("#responseMessage").html(
          '<div class="alert alert-danger">An error occurred! Please try again.</div>'
        );
      },
    });
  });
});
