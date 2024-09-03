<?php

$app = require "./core/app.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
	$email = trim($_POST['email']);
    $city = trim($_POST['city']);
	$phone = trim($_POST['phone']);

    // Validate Name (must be a string)
    if (empty($name) || !preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        die("Invalid name input");
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

	// Validate City (must be a string)
    if (empty($city) || !preg_match("/^[a-zA-Z-' ]*$/", $city)) {
        die("Invalid city input");
    }

	// TODO(cmin764): Validate phone number here as well.

	// Create new instance of user
	$user = new User($app->db);
	// Insert it to database with POST data
	$user->insert(array(
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'city' => $_POST['city'],
		'phone' => $_POST['phone']
	));

	// Return a JSON response with the redirect URL
    echo json_encode([
        "success" => true,
		// So the AJAX request can capture this and process the request
        "redirect" => "index.php"
    ]);

    exit();
}

// Redirect back to index
// header('Location: index.php');

?>
