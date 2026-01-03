<?php
include 'data_manipulation.html';
include '../connect.php';
?>
<html>
<head>
    <title>Top 5 Most Popular Program</title>     
</head>
<body>
    <h1>Top 5 Most Popular Program</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Program ID</th>
            <th>Program Name</th>
            <th>Total Enrolments</th>
            <th>Assigned Trainer</th>
            <th>Program Category</th>
        </tr>

<?php
include '../connect.php';

$sql = "SELECT 
        p.Program_ID,
        p.Program_Name,
        COUNT(DISTINCT e.Member_ID) AS Total_Enrolments,
        CONCAT(t.Trainer_FName, ' ', t.Trainer_LName) AS Trainer_Name,
        p.Program_Category
    FROM Program p

    LEFT JOIN Enrolment e 
        ON p.Program_ID = e.Program_ID

    LEFT JOIN (
        SELECT pt1.Program_ID, pt1.Trainer_ID
        FROM Program_Trainer pt1
        WHERE pt1.Start_Date = (
            SELECT MAX(pt2.Start_Date)
            FROM Program_Trainer pt2
            WHERE pt2.Program_ID = pt1.Program_ID
        )
    ) latest_trainer ON p.Program_ID = latest_trainer.Program_ID

    LEFT JOIN Trainer t 
        ON latest_trainer.Trainer_ID = t.Trainer_ID

    GROUP BY 
        p.Program_ID,
        p.Program_Name,
        p.Program_Category,
        t.Trainer_FName,
        t.Trainer_LName

    ORDER BY Total_Enrolments DESC
    LIMIT 5";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Program_ID'];
        echo "<tr>";
        echo "<td>{$row['Program_ID']}</td>";
        echo "<td>{$row['Program_Name']}</td>";
        echo "<td>{$row['Total_Enrolments']}</td>";
        echo "<td>{$row['Trainer_Name']}</td>";
        echo "<td>{$row['Program_Category']}</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>

