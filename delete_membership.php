<?php   
include 'membership.html';
?>

<html>
<head>
    <title>Delete Member</title>
</head>
<body>
    <h1>Delete Membership</h1>
</body>

<body>
    <form action="delete_membership.php" method="get">
        Membership ID to Delete: <input type="text" name="membership_id" required><br><br>
        <input type="submit" value="Delete Membership">
    </form>
</body>
</html>

<?php
include 'connect.php';

if(isset($_GET['membership_id'])) {
    $membership_id = $_GET['membership_id'];

    $sql = "DELETE FROM membership WHERE Membership_ID = '$membership_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {   
    if ($conn->query($sql) ==TRUE ) {
        echo $membership_id . " Membership is deleted successfully";
    } else {
        echo "No record found for ID: " . $membership_id;
    }
    } else {
        echo "No membership ID provided.";
    }
}
mysqli_close($conn);
?>