<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roundabout_sim";

//Varibles submited by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Normal Statement
// $sql = "SELECT password FROM user WHERE name = '$loginUser'";
//$result = $conn->query($sql);

// Prepared Statement
$sql = "SELECT password, id FROM user WHERE name = ?";

$statement = $conn->prepare($sql);

$statement->bind_param("s", $loginUser);

$statement->execute();

$result = $statement->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["password"] == md5($loginPass)){
        echo "Login Success.";
    }

    else{
        echo "Wrong password";
    }
  }
} else {
  echo "Username does not exist";
}
$conn->close();
?>