<?php

$conn = new mysqli(
    getenv('DB_HOST') ?: 'localhost',
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME') ?: 'web_project'
);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$stmt = $conn->prepare(
    "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Data saved successfully!";
} else {
    http_response_code(500);
    echo "Error saving data.";
}



$conn->close();

?>
