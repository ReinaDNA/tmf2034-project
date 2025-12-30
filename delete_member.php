<html>
<body>
    <h1>Delete Member</h1>
    <form action="delete_member.php" method="get">
        <label for="member_id">Member ID to Delete:</label>
        <input type="text" id="member_id" name="member_id" required><br><br>
        <input type="submit" value="Delete Member">
    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitlife_wellness_centre_database_system"; // Connect to database name

include 'connect.php';

if(isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];

    $sql = "DELETE FROM member WHERE Member_ID = '$member_id'";

    if ($conn->query($sql) ==TRUE ) {
        echo $member_id . " Member deleted successfully";
    } else {
        echo "Error deleting member: " . $conn->error;
        #still shows success message even when error occurs (not fixed)
    }
} else {
    echo "No member ID provided.";
    #still shows before form is submitted (not fixed)
}

mysqli_close($conn);
?>