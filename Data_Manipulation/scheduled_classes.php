<?php
include 'data_manipulation.html';
include '../connect.php';
?>
<html>
<head>
    <title>Class Schedule</title>     
</head>
<body>
    <h1>Class Schedule</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Class Code</th>
            <th>Class Date</th>
            <th>Class Time</th>
            <th>Class Status</th>
            <th>Class Venue</th>
            <th>Assigned Trainer</th>
            <th>Program Category</th>
        </tr>   

<?php
include '../connect.php';

$sql = "SELECT 
    c.Class_Code,
    c.Class_Date,
    CONCAT(c.Class_Start, '-' , c.Class_End) AS Class_Time,
    c.Class_Status,
    c.Class_Venue,
    CONCAT(t.Trainer_FName, ' ', t.Trainer_LName) AS Trainer_Name,
    p.Program_Category
FROM Class c
LEFT JOIN Program p ON p.Program_ID = c.Program_ID
LEFT JOIN Program_trainer pt ON pt.Program_ID = p.Program_ID
LEFT JOIN Trainer t ON t.Trainer_ID = pt.Trainer_ID
ORDER BY c.Class_Status, c.Class_Date, Class_Time";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['Class_Code']}</td>";
        echo "<td>{$row['Class_Date']}</td>";
        echo "<td>{$row['Class_Time']}</td>";
        echo "<td>{$row['Class_Status']}</td>";
        echo "<td>{$row['Class_Venue']}</td>";
        echo "<td>{$row['Trainer_Name']}</td>";
        echo "<td>{$row['Program_Category']}</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>

