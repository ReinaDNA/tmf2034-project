<?php
include 'postcode.html';
include 'connect.php';

$postcode = "";
$city = "";
$state = "";

if (isset($_GET['postcode'])) {
    $postcode = $_GET['postcode'];
    $sql = "SELECT * FROM postcode WHERE Postcode = '$postcode'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $postcode = $row['Postcode'];
        $city = $row['City'];
        $state = $row['State'];

    } else {
        echo "No member found with ID: " . $id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postcode = $_POST['Postcode'];
    $city = $_POST['City'];
    $state = $_POST['State'];


    $sql = "UPDATE Postcode SET 
            City = '$city',
            State = '$state'
            WHERE Postcode = '$postcode'";

    if (mysqli_query($conn, $sql)) {
        echo "Postcode updated successfully.<br>";
    } else {
        echo "Error updating postcode: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update Postcode Information</title>
</head>
<body>
    <p1>Update Postcode Information Form For : <?php echo "(Postcode: " . $postcode . ")"; ?></p1>
    <form action="update_postcode_form.php" method="post">
        <input type="hidden" name="Postcode" value="<?php echo $postcode; ?>">

        City: <input type="text" name = "City" value="<?php echo $city; ?>"><br><br>

        State: <input type="text" name = "State" value="<?php echo $state; ?>"><br><br>

        <input type="submit" value="Update Postcode">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>