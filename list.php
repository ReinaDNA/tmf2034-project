<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitlife_wellness_centre_database_system"; // any database you want to use

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Trainer_ID, Trainer_FName, Trainer_LName, Trainer_Contact, Trainer_Email,
            Trainer_Gender, Trainer_Specialization, Trainer_Certification, Door, Street, Postcode FROM Trainer";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "" . $row["Trainer_ID"] . "\t" . $row["Trainer_FName"] . "\t" . $row["Trainer_LName"] . "\t" . $row["Trainer_Contact"] . "\t" . $row["Trainer_Email"] . "\t" . $row["Trainer_Gender"] . "\t" . $row["Trainer_Specialization"] . "\t" . $row["Trainer_Certification"] . "\t" . $row["Door"] . "\t" . $row["Street"] . "\t" . $row["Postcode"] . "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
