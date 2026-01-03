<?php   
include 'member.html';
include '../connect.php';
?>

<html>
<head>
    <title>Delete Member</title>
</head>
<body>
    <h1>Delete Member</h1>
</body>

<body>
    <form action="delete_member.php" method="get">
        Member ID to Delete: 
        <select name="Member_id" id="Member_id" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Member_ID FROM member";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Member_ID']}'>{$row['Member_ID']}</option>";
                }}?>
        </select><br><br>

        <input type="submit" value="Delete Member">
    </form>
</body>
</html>

<?php
if (isset($_GET['Member_id']) && $_GET['Member_id'] !== "") {
    $member_id = (int)$_GET['Member_id'];

    $sql = "DELETE FROM member WHERE Member_ID = $member_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "<p>Member with ID $member_id deleted successfully.</p>";
        } else {
            echo "<p>No member found with ID: $member_id</p>";
        }
    } else {
        echo "<p>Error deleting member: " . mysqli_error($conn) . "</p>";
    }
}
mysqli_close($conn);
?>
