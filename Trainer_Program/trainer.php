<?php
include "connect.php";

$result = $conn->query("SELECT * FROM Trainer");
?>

<h2>Trainer List</h2>
<table border="1">
<tr>
    <th>ID</th><th>Name</th><th>Contact</th><th>Specialization</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['Trainer_ID'] ?></td>
    <td><?= $row['Trainer_FName']." ".$row['Trainer_LName'] ?></td>
    <td><?= $row['Trainer_Contact'] ?></td>
    <td><?= $row['Trainer_Specialization'] ?></td>
</tr>
<?php } ?>
</table>
