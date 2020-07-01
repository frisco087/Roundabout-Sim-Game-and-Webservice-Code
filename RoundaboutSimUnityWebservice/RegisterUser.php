<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roundabout_sim";

//Varibles submited by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];
$loginEmail = $_POST["loginEmail"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM user WHERE name = '$loginUser'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //name already exists
    echo "Username taken";
    
} else {
  echo "Creating user...";
  //Insert user and password into DB
  $sql2 = "INSERT INTO user (name, password, email) VALUES ('" . $loginUser . "', '" . md5($loginPass) . "', '" . $loginEmail . "')";

  if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
$conn->close();
?>