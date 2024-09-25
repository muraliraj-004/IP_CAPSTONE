<?php
// Database configuration
$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = ""; // Database password (default is empty for XAMPP)
$dbname = "flight_reservation"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
$dob = $_POST['dob'];
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];
$gender = $_POST['gender'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, dob, phonenumber, address, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $firstname, $lastname, $email, $password, $dob, $phonenumber, $address, $gender);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
