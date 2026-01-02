<html>
<head>
    <title>Trainer Performance Report</title>     
</head>
<body>
    <h1>Trainer Performance Report</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Trainer ID</th>
            <th>Trainer Name</th>
            <th>Total Classes Taught</th>
            <th>Total Cancelled Classes</th>
        </tr>
<?php
include 'data_manipulation.html';
include '../connect.php';

$sql = "SELECT 
    t.Trainer_ID,
    CONCAT(t.Trainer_FName, ' ', t.Trainer_LName) AS Trainer_Name,

    SUM(c.Class_Status = 'Completed') AS Total_Classes_Taught,
    SUM(c.Class_Status = 'Cancelled') AS Total_Cancelled_Classes
FROM Trainer t
JOIN program_trainer pt ON pt.Trainer_ID = t.Trainer_ID
JOIN Class c 
    ON pt.Program_ID = c.Program_ID
GROUP BY 
    t.Trainer_ID,
    t.Trainer_FName,
    t.Trainer_LName
ORDER BY t.Trainer_ID ASC
LIMIT 5";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Trainer_ID'];
        echo "<tr>";
        echo "<td>{$row['Trainer_ID']}</td>";
        echo "<td>{$row['Trainer_Name']}</td>";
        echo "<td>{$row['Total_Classes_Taught']}</td>";
        echo "<td>{$row['Total_Cancelled_Classes']}</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
