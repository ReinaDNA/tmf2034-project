<?php   
include 'trainer.html';
?>

<html>
<head>
    <title>Delete Trainer</title>
</head>
<body>
    <h1>Delete Trainer</h1>
</body>

<body>
    <form action="delete_trainer.php" method="get">
        Trainer ID to Delete: <input type="text" name="trainer_id" required><br><br>
        <input type="submit" value="Delete Trainer">
    </form>
</body>
</html>

<?php
include 'connect.php';

if(isset($_GET['trainer_id'])) {
    $trainer_id = $_GET['trainer_id'];

    $sql = "DELETE FROM trainer WHERE Trainer_ID = '$trainer_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {   
    if ($conn->query($sql) ==TRUE ) {
        echo $trainer_id . " Trainer is deleted successfully";
    } else {
        echo "No record found for ID: " . $trainer_id;
    }
    } else {
        echo "No trainer ID provided.";
    }
}
mysqli_close($conn);
?>