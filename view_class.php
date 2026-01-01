<?php   
include 'classes.html';
?>
<html>
<head>
    <title>View Classes</title>     
</head>
<body>
    <h1>Classes List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Class Code</th>
            <th>Program ID</th>
            <th>Class Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Venue</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

<?php
include 'connect.php';

$sql = "SELECT * FROM Class";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $class_code = $row['Class_Code'];
        echo "<tr>";
        echo "<td>{$row['Class_Code']}</td>";
        echo "<td>{$row['Program_ID']}</td>";
        echo "<td>{$row['Class_Date']}</td>";
        echo "<td>{$row['Class_Start']}</td>";
        echo "<td>{$row['Class_End']}</td>";
        echo "<td>{$row['Class_Venue']}</td>";
        echo "<td>{$row['Class_Status']}</td>";
        echo "<td><a href='update_class_form.php?class_code=".$class_code."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>0 results</td></tr>";
}

mysqli_close($conn);
?>