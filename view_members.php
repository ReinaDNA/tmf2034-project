<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitlife_wellness_centre_database_system"; // Connect to database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM member";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Member ID: " . $row["Member_ID"]. 
        " - Name: " . $row["Member_FName"]. " " . $row["Member_LName"]. 
        " - DOB: " . $row["Member_DOB"]. 
        " - Phone: " . $row["Member_Contact"]. 
        " - Email: " . $row["Member_Email"].
        " - Gender: " . $row["Member_Gender"]. 
        "<br>"; 
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
