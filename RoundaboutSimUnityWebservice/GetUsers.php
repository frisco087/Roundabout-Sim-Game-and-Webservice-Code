<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roundabout_sim";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT name, email FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<br>Name: " . $row["name"]. " - Email: " . $row["email"]. " " . "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>