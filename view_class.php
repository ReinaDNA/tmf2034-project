<?php
include 'connect.php';

$sql = "SELECT * FROM Class";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Classes</title>
</head>

<body>

<h1>Class List</h1>

<?php
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<strong>Class Code:</strong> " . $row['Class_Code'] . "<br>";
        echo "<strong>Program ID:</strong> " . $row['Program_ID'] . "<br>";
        echo "<strong>Date:</strong> " . $row['Class_Date'] . "<br>";
        echo "<strong>Start Time:</strong> " . $row['Class_Start'] . "<br>";
        echo "<strong>End Time:</strong> " . $row['Class_End'] . "<br>";
        echo "<strong>Venue:</strong> " . $row['Class_Venue'] . "<br>";
        echo "<strong>Status:</strong> " . $row['Class_Status'] . "<br>";

        echo "<hr>";
    }

} else {
    echo "No classes found.";
}
?>

<br>
<a href="classes.html">Back to Classes Menu</a>

</body>
</html>
