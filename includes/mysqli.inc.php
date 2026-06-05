<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'P3RDatabase';

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
    // NOTE: i hate red squiggly lines telling me they don't recognize the variable so deal with it
    return $conn;
}
?>
