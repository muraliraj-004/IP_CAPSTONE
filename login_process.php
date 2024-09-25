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
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();
$stmt->store_result();

// Check if the user exists
if ($stmt->num_rows > 0) {
    // Bind the result to a variable
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    
    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, proceed with login
        echo "Login successful!"; // Redirect to another page or dashboard here
        // header("Location: dashboard.php"); // Uncomment this line to redirect
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No account found with that email address.";
}

// Close the connection
$stmt->close();
$conn->close();
?>
