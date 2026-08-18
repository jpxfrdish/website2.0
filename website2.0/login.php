<?php
include "connect.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM login 
        WHERE username='$username' AND password='$password'" AND email='$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid login!";
}
?>