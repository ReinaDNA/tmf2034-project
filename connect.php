<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitlife_wellness_centre_database_system"; // Connect to database name 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
global $conn;
?>