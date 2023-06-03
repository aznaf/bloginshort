<?php
// Create connection
$conn = new mysqli('localhost','root', '', 'ai_blog');
// Check connection
if ($conn->connect_error) {
  echo"database connection error<br>";
  die("Connection failed: " . $conn->connect_error);
}

?>