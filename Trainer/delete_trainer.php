<?php   
include 'trainer.html';
include '../connect.php';
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
        Trainer ID to Delete: 
        <select name="trainer_id" id="trainer_id" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Trainer_ID FROM Trainer";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Trainer_ID']}'>{$row['Trainer_ID']}</option>";
                }}?>
        </select><br><br>
        <input type="submit" value="Delete Trainer">
    </form>
</body>
</html>

<?php
if(isset($_GET['trainer_id']) && $_GET['trainer_id'] != "") {
    $trainer_id =$_GET['trainer_id'];

    $sql = "DELETE FROM trainer WHERE Trainer_ID = '$trainer_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {   
    if (mysqli_affected_rows($conn) > 0  ) {
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