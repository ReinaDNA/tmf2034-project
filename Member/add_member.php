<?php   
include 'member.html';
include '../connect.php';
?>
<html>
<head>
    <title>Add Member</title>
</head>
<body>
    <form action ="add_member.php" method="post">
        <h1>Add New Member</h1>

        Member ID: <input type="text" name = "Member_ID" required><br><br>

        First Name: <input type="text" name = "Member_FName" required><br><br>

        Last Name: <input type="text" name = "Member_LName" required><br><br>

        Date of Birth: <input type="date" name = "Member_DOB" required><br><br>

        Phone Number: <input type="tel" name = "Member_Contact" required><br><br>

        Email: <input type="email" name = "Member_Email" required><br><br>  

        Gender:
        <input type="radio" name="Member_Gender" value="Male" required> Male        
        <input type="radio" name="Member_Gender" value="Female" required> Female<br><br>

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
        
        <input type="submit" value="Add Member">    
    </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $member_id = $_POST['Member_ID'];
    $postcode  = $_POST['Postcode'];
    $fname     = $_POST['Member_FName'];
    $lname     = $_POST['Member_LName'];
    $contact   = $_POST['Member_Contact'];
    $email     = $_POST['Member_Email'];
    $dob       = $_POST['Member_DOB'];
    $gender    = $_POST['Member_Gender'];
    $door      = $_POST['Door'];
    $street    = $_POST['Street'];

    $sql = "INSERT INTO Member
            (Member_ID, Postcode, Member_FName, Member_LName,
             Member_Contact, Member_Email, Member_DOB,
             Member_Gender, Door, Street)
            VALUES
            ('$member_id', '$postcode', '$fname', '$lname',
             '$contact', '$email', '$dob', '$gender',
             '$door', '$street')";

    if ($conn->query($sql) === TRUE) {
        echo "New member added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
