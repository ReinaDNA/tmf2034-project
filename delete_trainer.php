<html>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Trainer Details <br>
----------------- <br>
<p>ID: <input type="text" name="tr_id"></p>
<p><input type="submit" name="Delete" value="Delete"></p>
</form>
</body>
</html>

<?php
include 'connect.php';

if(isset($_POST['Delete'])){
    $id = $_POST['tr_id'];
    
    // Delete query
    $sql = "DELETE FROM trainer WHERE Trainer_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        if(mysqli_affected_rows($conn) > 0){
            echo $id . " is deleted";
        } else {
            echo "No record found for ID: $id";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
