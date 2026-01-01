<?php   
include 'postcode.html';
?>
<html>
<head>
    <title>Add Postcode</title>
</head>
<body>
    <form action ="add_postcode.php" method="post">
        <h1>Add New Postcode</h1>

        Postcode: <input type="text" name = "Postcode" required><br><br>

        City: <input type="text" name = "City" required><br><br>

        State: <input type="text" name = "State" required><br><br>

        <input type="submit" value="Add Member">    
    </form>
</body>
</html>

<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $postcode = $_POST['Postcode'];
    $city     = $_POST['City'];
    $state    = $_POST['State'];

    $sql = "INSERT INTO postcode
            (Postcode, City, State)
            VALUES
            ('$postcode', '$city', '$state')";

    if ($conn->query($sql) === TRUE) {
        echo "New postcode added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>