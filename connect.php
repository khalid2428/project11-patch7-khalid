<?php
$servername = "localhost";
$username = "Bona";
$password = "Bona@#soma89";
$dbname = 'Bona';
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>