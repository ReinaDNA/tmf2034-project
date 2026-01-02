<?php   
include 'enrolment.html';
include '../connect.php';
?>
<html>
<head>
    <title>Add Enrolment</title>
</head>
<body>
    <form action ="add_enrolment.php" method="post">
        <h1>Add New Enrolment</h1>
        Member ID:
        <select name="Member_ID" id="Member_ID" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Member_ID FROM member";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Member_ID']}'>{$row['Member_ID']}</option>";
                }}?>
        </select><br><br>

        Program ID:
        <select name="Program_ID" id="Program_ID" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Program_ID FROM program";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Program_ID']}'>{$row['Program_ID']}</option>";
                }}?>
        </select><br><br>

        Enrolment Date: <input type="date" name = "Enrolment_Date" required><br><br>

        <input type="submit" value="Add Enrolment">    
    </form>
</body>
</html>

<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $member_id = $_POST['Member_ID'];
    $program_id = $_POST['Program_ID'];
    $enrolment_date = $_POST['Enrolment_Date'];

    $sql = "INSERT INTO Enrolment 
            (Member_ID, Program_ID, Enrolment_Date)
            VALUES 
            ('$member_id', 
            '$program_id', 
            '$enrolment_date')";

    if ($conn->query($sql) === TRUE) {
        echo "New enrolment added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>