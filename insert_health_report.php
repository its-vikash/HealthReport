<?php
// Assuming you have a MySQL database setup with appropriate credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_report_db";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// Upload the PDF file
$targetDirectory = "uploads/"; // Directory to store uploaded files
$targetFile = $targetDirectory . basename($_FILES["healthReport"]["name"]);
move_uploaded_file($_FILES["healthReport"]["tmp_name"], $targetFile);

// Insert user details into the database
$sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', '$age', '$weight', '$email', '$targetFile')";
if ($conn->query($sql) === TRUE) {
  echo "Form submitted successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
