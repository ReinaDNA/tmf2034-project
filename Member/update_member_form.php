<?php
include 'member.html';
include '../connect.php';

$id = "";
$fname = "";
$lname = "";
$contact = "";
$email = "";
$dob = "";
$gender = "";
$door = "";
$street = "";
$postcode = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM member WHERE Member_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $id = $row['Member_ID'];
        $fname = $row['Member_FName'];
        $lname = $row['Member_LName'];
        $contact = $row['Member_Contact'];
        $email = $row['Member_Email'];
        $dob = $row['Member_DOB'];
        $gender = $row['Member_Gender'];
        $door = $row['Door'];
        $street = $row['Street'];
        $postcode = $row['Postcode'];

    } else {
        echo "No member found with ID: " . $id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Member_ID'];
    $fname = $_POST['Member_FName'];
    $lname = $_POST['Member_LName'];
    $contact = $_POST['Member_Contact'];
    $email = $_POST['Member_Email'];
    $dob = $_POST['Member_DOB'];
    $gender = $_POST['Member_Gender'];
    $door = $_POST['Door'];     
    $street = $_POST['Street'];
    $postcode = $_POST['Postcode'];

    $sql = "UPDATE member SET 
            Member_FName = '$fname',
            Member_LName = '$lname',
            Member_Contact = '$contact',
            Member_Email = '$email',
            Member_DOB = '$dob',
            Member_Gender = '$gender',
            Door = '$door',
            Street = '$street',
            Postcode = '$postcode'
            WHERE Member_ID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Member updated successfully.<br>";
    } else {
        echo "Error updating member: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update Information</title>
</head>
<body>
    <p1>Update Member Information Form For : <?php echo $fname . " " . $lname; echo " (ID: " . $id . ")"; ?></p1>
    <form action="update_member_form.php" method="post">
        <input type="hidden" name="Member_ID" value="<?php echo $id; ?>">
        First Name: <input type="text" name = "Member_FName" value="<?php echo $fname; ?>"><br><br>

        Last Name: <input type="text" name = "Member_LName" value="<?php echo $lname; ?>"><br><br>

        Date of Birth: <input type="date" name = "Member_DOB" value="<?php echo $dob; ?>"><br><br>
        Contact Number: <input type="text" name="Member_Contact" value="<?php echo $contact; ?>"><br>

        Email: <input type="email" name="Member_Email" value="<?php echo $email; ?>"><br><br>

        Gender:
        Male <input type="radio" name="Member_Gender" value="Male" <?php if ($gender == 'Male') echo 'checked';?>>
        Female <input type="radio" name="Member_Gender" value="Female" <?php if ($gender == 'Female') echo 'checked';?>><br><br>

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

        <input type="submit" value="Update Member">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>