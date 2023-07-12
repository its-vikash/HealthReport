<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_report_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

// Search for the health reports based on the email
$sql = "SELECT health_report FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<h2>Health Reports for $email:</h2>";

  while ($row = $result->fetch_assoc()) {
    $healthReportPath = $row['health_report'];
    $healthReportName = basename($healthReportPath);
    echo "<p><a href='$healthReportPath' target='_blank'>$healthReportName</a></p>";
  }
} else {
  echo "Health reports not found for the provided email.";
}

$conn->close();
?>
