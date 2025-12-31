<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO Trainer 
    (Trainer_ID, Trainer_FName, Trainer_LName, Trainer_Contact, Trainer_Email,
     Trainer_Gender, Trainer_Specialization, Trainer_Certification, Door, Street, Postcode)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssssss",
        $_POST['trainer_id'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['contact'],
        $_POST['email'],
        $_POST['gender'],
        $_POST['specialization'],
        $_POST['certification'],
        $_POST['door'],
        $_POST['street'],
        $_POST['postcode'],
        $_POST['city'],
        $_POST['state']
    );

    if ($stmt->execute()) {
        echo "Trainer added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
