<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roundabout_sim";

//Varibles submited by user
$loginUsername = $_POST["name"];
$score = $_POST["score"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE user SET score = " . $score . " WHERE name = '" . $loginUsername . "';";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
  echo "Score saved ";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>