<?php   
include 'classes.html';
?>

<html>
<head>
    <title>Delete Class</title>
</head>
<body>
    <h1>Delete Class</h1>
</body>

<body>
    <form action="delete_class.php" method="get">
        Class Code to Delete:<input type="text" name="class_code" required><br><br>
        <input type="submit" value="Delete Class">
    </form>
</body>
</html>

<?php
include 'connect.php';

if (isset($_GET['class_code'])) {
    $class_code = $_GET['class_code'];

    $sql = "DELETE FROM Class WHERE Class_Code = '$class_code'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($conn->query($sql) ==TRUE ) {
            echo "Class $class_code is deleted successfully";
        } else {
            echo "No class is found with the code: $class_code";
        }
    } else {
        echo "No class code provided.";
    }
}

mysqli_close($conn);
?>
