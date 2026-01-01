<?php   
include 'program_trainer.html';
?>
<htmL>
<head>
    <title>View Trainer Programs</title>     
</head>
<body>
    <h1>Trainer Program List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Program ID</th>
            <th>Trainer_ID</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
      
<?php
include 'connect.php';

$sql = "SELECT * FROM program_trainer";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Program_ID'];
        echo "<tr>";
        echo "<td>{$row['Program_ID']}</td>";
        echo "<td>{$row['Trainer_ID']}</td>";
        echo "<td>{$row['Start_Date']}</td>";
        echo "<td>" . (($row['End_Date'] == NULL) ? "-" : $row['End_Date']) . "</td>";
        echo "<td><a href='update_program_trainer_form.php?id=".$id."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>