<?php
include("autoload.php");


// Create connection
$conn = new mysqli($_ENV['HOST'], $_ENV['USER'], $_ENV['PASSWORD'], $_ENV['DB']);
// Check connection
if ($conn->connect_error) {
  echo"database connection error<br>";
  die("Connection failed: " . $conn->connect_error);
}

?>