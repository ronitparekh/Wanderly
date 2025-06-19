<?php
// Connection settings
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default is empty
$dbname = "travel_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$destination = $_POST['destination'];
$package = $_POST['package'];
$dates = $_POST['dates'];
$travelers = $_POST['travelers'];
$preferences = $_POST['preferences'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, destination, package, dates, travelers, preferences) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssis", $name, $email, $phone, $destination, $package, $dates, $travelers, $preferences);

if ($stmt->execute()) {
    echo "<h2>Booking Successful!</h2>";
    echo "<p>Thank you, $name. We've received your booking details.</p>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
