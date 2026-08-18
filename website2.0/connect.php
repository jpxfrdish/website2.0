<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "foundiit";

$conn = new mysqli($servername, $username, $password, $database);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get form data
$name = $_POST['name'];
$email = $_POST['email'];
$id_number = $_POST['id_number'];
$status = $_POST['status'];
$contact = $_POST['contact'];
$raw_password = $_POST['password'];

// validate gmail only
if (substr($email, -10) !== "@gmail.com") {
    echo "Email must be Gmail only!";
    exit();
}

// hash password
$hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

// prepared statement (SECURE)
$stmt = $conn->prepare("INSERT INTO login (Name, Email, Id_Number, Status, Contact, Password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $id_number, $status, $contact, $hashed_password);

// execute
if ($stmt->execute()) {
    header("Location: login1.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>