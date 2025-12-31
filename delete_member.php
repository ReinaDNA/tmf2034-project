<html>
<head>
    <h1>Members Page</h1>
     <ul><br>
            <a href="add_member.php">Add Member</a>
            <a href="view_members.php">View Members</a>
            <a href="update_member.php">Update Member</a>
            <a href="delete_member.php">Delete Member</a>
        </ul>
    <title>Delete Member</title>
</head>
<body>
    <h1>Delete Member</h1>
    <form action="delete_member.php" method="get">
        Member ID to Delete: <input type="text" name="member_id" required><br><br>
        <input type="submit" value="Delete Member">
    </form>
</body>
</html>

<?php
include 'connect.php';

if(isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];

    $sql = "DELETE FROM member WHERE Member_ID = '$member_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {   
    if ($conn->query($sql) ==TRUE ) {
        echo $member_id . " Member is deleted successfully";
    } else {
        echo "No record found for ID: " . $member_id;
    }
    } else {
        echo "No member ID provided.";
    }
}
mysqli_close($conn);
?>