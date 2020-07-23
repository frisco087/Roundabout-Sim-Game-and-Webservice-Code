<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roundabout_sim";

//Varibles submited by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];
$loginPass2 = $_POST["loginPass2"];
$loginEmail = $_POST["loginEmail"];
$bio = "null";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Normal Statement
//$sql = "SELECT name FROM user WHERE name = '$loginUser'";
//$result = $conn->query($sql);

if($loginPass != $loginPass2){
  echo "Passwords don't match";
} 
else{
  // Prepared Statement
  $sql = "SELECT name FROM user WHERE name = ?";

  $statement = $conn->prepare($sql);

  $statement->bind_param("s", $loginUser);

  $statement->execute();

  $result = $statement->get_result();

  if ($result->num_rows > 0) {
      //name already exists
      echo "Username taken";
    
  } 
    else {
    echo "Creating user...";
    //Insert into DB
    // Prepared Statement
    $sql2 = "INSERT INTO user (name, password, email, bio) VALUES (?, ?, ?, ?)";
    $statement2 = $conn->prepare($sql2);
    $loginPassMD5 = md5($loginPass);

    $statement2->bind_param("ssss", $loginUser, $loginPassMD5, $loginEmail, $bio);

    $statement2->execute();
    $result = $statement2->get_result();

    if ($conn->query($sql2) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>