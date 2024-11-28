<?php
$hostname = "localhost";
$username = "personal";
$password = "aezakmi1";
$database = "db"; 


$conn = new mysqli($hostname, $username, $password, $database);


if ($conn->connect_error) {
    die("Eroare de conexiune: " . $conn->connect_error);
}
?>
