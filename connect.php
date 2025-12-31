<?php
$conn = new mysqli("localhost", "root", "", "fitlife_wellness_centre_database_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>