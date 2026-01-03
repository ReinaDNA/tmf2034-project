<?php   
include 'postcode.html';
include '../connect.php';
?>

<html>
<head>
    <title>Delete Postcode</title>
</head>
<body>
    <h1>Delete Postcode</h1>
    <form action="delete_postcode.php" method="get">
        Postcode to Delete: 
        <select name="Postcode" id="Postcode" required>
            <option value="">Please Choose</option>
            <?php 
            $sql = "SELECT Postcode FROM postcode";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Postcode']}'>{$row['Postcode']}</option>";
              }
            }
            ?>
    </select><br><br>
    <input type="submit" value="Delete Postcode">
    </form> 
</body>
</html>

<?php
include '../connect.php';

if(isset($_GET['Postcode'])) {
    $postcode = $_GET['Postcode'];

    $sql = "DELETE FROM postcode WHERE Postcode = '$postcode'";
    $result = mysqli_query($conn, $sql);

    if($result) {   
    if ($conn->query($sql) ==TRUE ) {
        echo $postcode . " Postcode is deleted successfully";
    } else {
        echo "No record found for Postcode: " . $postcode;
    }
    } else {
        echo "No postcode provided.";
    }
}
mysqli_close($conn);
?>