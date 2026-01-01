<?php   
include 'trainer.html';
?>
<html>
<head>
    <title>Add Trainer</title>
</head>
<body>
    <form action ="add_trainer.php" method="get">
        <h1>Add New Trainer</h1>

        Trainer ID: <input type="text" name = "Trainer_ID" required><br><br>

        First Name: <input type="text" name = "Trainer_FName" required><br><br>

        Last Name: <input type="text" name = "Trainer_LName" required><br><br>

        Date of Birth: <input type="date" name = "Trainer_DOB" required><br><br>

        Phone Number: <input type="tel" name = "Trainer_Contact" required><br><br>

        Email: <input type="email" name = "Trainer_Email" required><br><br>  

        Gender:
        <input type="radio" name="Trainer_Gender" value="Male" required> Male        
        <input type="radio" name="Trainer_Gender" value="Female" required> Female<br><br>

        Address:<br>
        Sublot: <input type="text" name = "Door" required><br>
        Street Name: <input type="text" name = "Street" required><br>
        Postal Code: <input type="text" name = "Postcode" required><br>
        City: <input type="text" name = "City" required><br>
        State: <input type="text" name = "State" required><br><br>

        Specialization: <input type="text" name = "Specialization" required><br><br>
        Certification: <input type="text" name = "Certification" required><br><br>
        
        <input type="submit" value="Add Trainer">    
    </form>
</body>
</html>

<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $trainer_id = $_POST['Trainer_ID'];
    $postcode  = $_POST['Postcode'];
    $fname     = $_POST['Trainer_FName'];
    $lname     = $_POST['Trainer_LName'];
    $contact   = $_POST['Trainer_Contact'];
    $email     = $_POST['Trainer_Email'];
    $dob       = $_POST['Trainer_DOB'];
    $gender    = $_POST['Trainer_Gender'];
    $door      = $_POST['Door'];
    $street    = $_POST['Street'];
    $specialization = $_POST['Specialization'];
    $certification = $_POST['Certification'];
    $city      = $_POST['City'];
    $state     = $_POST['State'];

    $sql1 = "INSERT INTO Trainer
            (Trainer_ID, Postcode, Trainer_FName, Trainer_LName,
             Trainer_Contact, Trainer_Email, Trainer_DOB,
             Trainer_Gender, Door, Street, Specialization, Certification)
            VALUES
            ('$trainer_id', '$postcode', '$fname', '$lname',
             '$contact', '$email', '$dob', '$gender',
             '$door', '$street', '$specialization', '$certification')";
    
    $sql2 = "INSERT INTO postcode
            (Postcode, city, state)
            VALUES
            ('$postcode', '$city', '$state')";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "New trainer added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
