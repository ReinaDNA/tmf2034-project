<?php
include '../connect.php';

$sql = "SELECT t.Trainer_ID,
    t.Trainer_FName,
    t.Trainer_LName,
    t.Trainer_Contact,
    t.Trainer_Email,
    t.Trainer_Gender,
    t.Trainer_Specialization,
    t.Trainer_Certification,
    t.Door,
    t.Street,
    p.Postcode,
    p.City,
    p.State FROM Trainer t JOIN Postcode p ON t.Postcode = p.Postcode";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$id = $row["Trainer_ID"];
        echo "<a href='update_trainer.php?id="."$id" . "'>" . "\t\t" . $row["Trainer_ID"]."\t\t".$row["Trainer_FName"]."\t\t".$row["Trainer_LName"]."\t\t".$row["Trainer_Contact"]."\t\t".$row["Trainer_Email"]."\t\t".$row["Trainer_Gender"]."\t\t".$row["Trainer_Specialization"]."\t\t".$row["Trainer_Certification"]."\t\t".$row["Door"]."\t\t".$row["Street"]."\t\t".$row["Postcode"]."\t\t".$row["City"]."\t\t".$row["State"]."<br>";
    }
} else {
    echo "0 results";
}
?>