<?php   
include 'trainer.html';
?>
<htmL>
<head>
    <title>View Trainers</title>     
</head>
<body>
    <h1>Trainers List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Trainer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Specialization</th>
            <th>Certification Level</th>    
        </tr>
      
<?php
include 'connect.php';

$sql = "
SELECT 
    t.Trainer_ID,
    t.Trainer_FName,
    t.Trainer_LName,
    t.Trainer_Contact,
    t.Trainer_Email,
    t.Trainer_Gender,
    t.Door,
    t.Street,
    p.City,
    p.State
FROM Trainer t
JOIN Postcode p ON t.Postcode = p.Postcode
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Trainer_ID'];
        echo "<tr>";
        echo "<td>{$row['Trainer_ID']}</td>";
        echo "<td>{$row['Trainer_FName']}</td>";
        echo "<td>{$row['Trainer_LName']}</td>";
        echo "<td>{$row['Trainer_Contact']}</td>";
        echo "<td>{$row['Trainer_Email']}</td>";
        echo "<td>{$row['Trainer_Gender']}</td>";
        echo "<td>{$row['Door']}, {$row['Street']}, {$row['Postcode']}, {$row['City']}, {$row['State']}</td>";
        echo "<td>{$row['Specialization']}</td>";
        echo "<td>{$row['Certification']}</td>";
        echo "<td><a href='update_trainer_form.php?id=".$id."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
