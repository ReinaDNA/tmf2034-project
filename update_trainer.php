<?php
include 'connect.php';

// Avoid undefined variable warnings
$id = "";
$name = "";
$contact = "";
$email = "";
$gender = "";
$specialization = "";
$cert = "";
$address = "";

// If user clicked a link in update_data_form.php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT t.Trainer_ID, t.Trainer_FName, t.Trainer_LName, t.Trainer_Contact, t.Trainer_Email, t.Trainer_Gender, t.Trainer_Specialization, t.Trainer_Certification, t.Door, t.Street, p.Postcode, p.City, p.State FROM Trainer t JOIN Postcode p ON t.Postcode = p.Postcode WHERE t.Trainer_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $id = $row['Trainer_ID'];
        $fname = $row['Trainer_FName'];
        $lname = $row['Trainer_LName'];
        $contact = $row['Trainer_Contact'];
        $email = $row['Trainer_Email'];
        $gender = $row['Trainer_Gender'];
        $specialization = $row['Trainer_Specialization'];
        $cert = $row['Trainer_Certification'];
        $door = $row['Door'];
        $street = $row['Street'];
        $city = $row['City'];
        $state = $row['State'];
        $postcode = $row['Postcode'];
    }
}

// If user clicked Update button
// This is changed to use $_POST method instead of $_GET
if (isset($_POST['Update'])) {
    $id = $_POST['Trainer_ID'];
    $fname = $_POST['Trainer_FName'];
    $lname = $_POST['Trainer_LName'];
    $contact = $_POST['Trainer_Contact'];
    $email = $_POST['Trainer_Email'];
    $gender = $_POST['Trainer_Gender'];
    $specialization = $_POST['Trainer_Specialization'];
    $cert = $_POST['Trainer_Certification'];
    $door = $_POST['Door'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $postcode = $_POST['Postcode'];

    $sql2 = "UPDATE Postcode SET
            City='$city', State='$state'
            WHERE Postcode='$postcode'";
    $sql = "UPDATE Trainer SET
            Trainer_FName='$fname', Trainer_LName='$lname', Trainer_Contact='$contact', Trainer_Email='$email', Trainer_Gender='$gender', Trainer_Specialization='$specialization', Trainer_Certification='$cert', Door='$door', Street='$street', Postcode='$postcode'
            WHERE Trainer_ID='$id'";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        echo "Record updated for user ID: $id<br><br>";
		include 'update_trainer_form.php';
		exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<html>
<body>
	Record found<br>
    Update Student Details: <br>
    ------------------------- <br>
    <form action="update_trainer.php" method="POST">
        ID: <input type="text" name="Trainer_ID" value="<?php echo $id; ?>" readonly><br><br>
        First Name: <input type="text" name="Trainer_FName" value="<?php echo $fname; ?>"><br><br>
        Last Name: <input type="text" name="Trainer_LName" value="<?php echo $lname; ?>"><br><br>
        Email: <input type="text" name="Trainer_Email" value="<?php echo $email; ?>"><br><br>
        Contact: <input type="text" name="Trainer_Contact" value="<?php echo $contact; ?>"><br><br>
        Gender: <input type="text" name="Trainer_Gender" value="<?php echo $gender; ?>"><br><br>
        Specialization: <input type="text" name="Trainer_Specialization" value="<?php echo $specialization; ?>"><br><br>
        Cert: <input type="text" name="Trainer_Certification" value="<?php echo $cert; ?>"><br><br>
        Door: <input type="text" name="Door" value="<?php echo $door; ?>"><br><br>
        Street: <input type="text" name="Street" value="<?php echo $street; ?>"><br><br>
        City: <input type="text" name="City" value="<?php echo $city; ?>"><br><br>
        State: <input type="text" name="State" value="<?php echo $state; ?>"><br><br>
        Postcode: <input type="text" name="Postcode" value="<?php echo $postcode; ?>"><br><br>
        <input type="submit" name="Update" value="Update">
    </form>

</body>
</html>

