<?php   
include 'trainer.html';
include '../connect.php'
?>
<html>
<head>
    <title>Add Trainer</title>
</head>
<body>
    <form action ="add_trainer.php" method="post">
        <h1>Add New Trainer</h1>

        Trainer ID: <input type="text" name = "Trainer_ID" required><br><br>

        First Name: <input type="text" name = "Trainer_FName" required><br><br>

        Last Name: <input type="text" name = "Trainer_LName" required><br><br>

        Phone Number: <input type="tel" name = "Trainer_Contact" required><br><br>

        Email: <input type="email" name = "Trainer_Email" required><br><br>  

        Gender:
        <input type="radio" name="Trainer_Gender" value="Male" required> Male        
        <input type="radio" name="Trainer_Gender" value="Female" required> Female<br><br>

        Address:<br>
        Sublot: <input type="text" name = "Door" required><br>
        Street Name: <input type="text" name = "Street" required><br>
        Postal Code: 
        <select name="Postcode" id="Postcode" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Postcode FROM Postcode";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Postcode']}'>{$row['Postcode']}</option>";
                }}?>
        </select><br><br>        

        Specialization: <input type="text" name = "Trainer_Specialization" required><br><br>
        Certification: <input type="text" name = "Trainer_Certification" required><br><br>
        
        <input type="submit" value="Add Trainer">    
    </form>
</body>
</html>

<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $trainer_id = $_POST['Trainer_ID'];
    $postcode  = $_POST['Postcode'];
    $fname     = $_POST['Trainer_FName'];
    $lname     = $_POST['Trainer_LName'];
    $contact   = $_POST['Trainer_Contact'];
    $email     = $_POST['Trainer_Email'];
    $gender    = $_POST['Trainer_Gender'];
    $door      = $_POST['Door'];
    $street    = $_POST['Street'];
    $specialization = $_POST['Trainer_Specialization'];
    $certification = $_POST['Trainer_Certification'];
    $sql1 = "INSERT INTO Trainer
            (Trainer_ID, Postcode, Trainer_FName, Trainer_LName,
             Trainer_Contact, Trainer_Email,
             Trainer_Gender, Trainer_Specialization, Trainer_Certification, Door, Street)
            VALUES
            ('$trainer_id', '$postcode', '$fname', '$lname',
             '$contact', '$email', '$gender',
             '$specialization', '$certification', '$door', '$street')";
    
    if ($conn->query($sql1) === TRUE) {
        echo "New trainer added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
