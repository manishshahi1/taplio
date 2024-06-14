<?php

// Include the file containing the user_login function
require_once __DIR__ . '/../../config/functions.php';

// Retrieve form data from POST request
$formData = $_POST;

// Call the user_login function with the form data
$result = user_login($formData);

// Return JSON response without slashes
header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_SLASHES);
