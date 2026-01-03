<?php   
include 'classes.html';
include '../connect.php';
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
        Class Code to Delete:
        <select name="Class_Code" required>
        <option value="">Please Choose</option>
        <?php
        $sql = "SELECT Class_Code FROM Class";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Class_Code']}'>{$row['Class_Code']}</option>";
            }
        }
        ?>
        </select><br><br>

        <input type="submit" value="Delete Class">
    </form>
</body>
</html>

<?php
if (isset($_GET['Class_Code']) && $_GET['Class_Code'] !== "") {
    $class_code = $_GET['Class_Code'];

    $sql = "DELETE FROM Class WHERE Class_Code = '$class_code'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "<p>Class $class_code deleted successfully.</p>";
        } else {
            echo "<p>No class found with code $class_code.</p>";
        }
    } else {
        echo "<p>Error deleting class: " . mysqli_error($conn) . "</p>";
    }
}

mysqli_close($conn);
?>
