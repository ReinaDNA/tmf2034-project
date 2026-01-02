<?php
include 'trainer.html';
include '../connect.php';

$id = "";
$fname = "";
$lname = "";
$contact = "";
$email = "";
$gender = "";
$door = "";
$street = "";
$postcode = "";
$specialization = "";
$certification = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM trainer WHERE Trainer_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $id = $row['Trainer_ID'];
        $fname = $row['Trainer_FName'];
        $lname = $row['Trainer_LName'];
        $contact = $row['Trainer_Contact'];
        $email = $row['Trainer_Email'];
        $gender = $row['Trainer_Gender'];
        $door = $row['Door'];
        $street = $row['Street'];
        $postcode = $row['Postcode'];

    } else {
        echo "No member found with ID: " . $id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Trainer_ID'];
    $fname = $_POST['Trainer_FName'];
    $lname = $_POST['Trainer_LName'];
    $contact = $_POST['Trainer_Contact'];
    $email = $_POST['Trainer_Email'];
    $gender = $_POST['Trainer_Gender'];
    $door = $_POST['Door'];     
    $street = $_POST['Street'];
    $postcode = $_POST['Postcode'];
    $specialization = $_POST['Specialization'];
    $certification = $_POST['Certification'];

    $sql = "UPDATE trainer SET 
            Trainer_FName = '$fname',
            Trainer_LName = '$lname',
            Trainer_Contact = '$contact',
            Trainer_Email = '$email',
            Trainer_Gender = '$gender',
            Door = '$door',
            Street = '$street',
            Postcode = '$postcode'
            WHERE Trainer_ID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Trainer updated successfully.<br>";
    } else {
        echo "Error updating trainer: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update Information</title>
</head>
<body>
    <p1>Update Trainer Information Form For : <?php echo $fname . " " . $lname; echo " (ID: " . $id . ")"; ?></p1>
    <form action="update_trainer_form.php" method="post">
        <input type="hidden" name="Trainer_ID" value="<?php echo $id; ?>">
        First Name: <input type="text" name = "Trainer_FName" value="<?php echo $fname; ?>"><br><br>

        Last Name: <input type="text" name = "Trainer_LName" value="<?php echo $lname; ?>"><br><br>

        Contact Number: <input type="text" name="Trainer_Contact" value="<?php echo $contact; ?>"><br>

        Email: <input type="email" name="Trainer_Email" value="<?php echo $email; ?>"><br><br>

        Gender:
        Male <input type="radio" name="Trainer_Gender" value="Male" <?php if ($gender == 'Male') echo 'checked';?>>
        Female <input type="radio" name="Trainer_Gender" value="Female" <?php if ($gender == 'Female') echo 'checked';?>><br><br>

        Address:<br>
        Sublot: <input type="text" name = "Door" value="<?php echo $door; ?>"><br>
        Street Name: <input type="text" name = "Street" value="<?php echo $street; ?>"><br>
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

        Specialization: <input type="text" name = "Specialization" value="<?php echo $specialization; ?>"><br><br>
        Certification: <input type="text" name = "Certification" value="<?php echo $certification; ?>"><br><br>

        <input type="submit" value="Update Trainer">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>