<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the user and password from the request body
    $user = $_POST["email"];
    $password = $_POST["password"];

    // Simulate a login process (replace with your actual authentication logic)
    if ($user === "11" && $password === "123") {
        // Login successful
        http_response_code(200); // Set response code to 200 (OK)
        //echo json_encode(array("message" => "Login successful"));
    } else {
        // Login failed
        http_response_code(401); // Set response code to 401 (Unauthorized)
        //echo json_encode(array("message" => "Invalid user or password"));
    }
} else {
    // Invalid request method
    http_response_code(405); // Set response code to 405 (Method Not Allowed)
    echo json_encode(array("message" => "Only POST requests are allowed"));
}

?>
