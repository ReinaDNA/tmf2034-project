<?php
include 'connect.php';

// Avoid undefined variable warnings
$class_code = "";
$class_date = "";
$class_start = "";
$class_end = "";
$class_venue = "";
$class_status = "";

// If user clicked a class link
if (isset($_GET['class_code'])) {

    $class_code = $_GET['class_code'];

    $sql = "SELECT * FROM Class WHERE Class_Code='$class_code'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $class_code   = $row['Class_Code'];
        $class_date   = $row['Class_Date'];
        $class_start  = $row['Class_Start'];
        $class_end    = $row['Class_End'];
        $class_venue  = $row['Class_Venue'];
        $class_status = $row['Class_Status'];
    }
}

// If user clicked Update button
if (isset($_POST['Update'])) {

    $class_code   = $_POST['class_code'];
    $class_date   = $_POST['class_date'];
    $class_start  = $_POST['class_start'];
    $class_end    = $_POST['class_end'];
    $class_venue  = $_POST['class_venue'];
    $class_status = $_POST['class_status'];

    $sql = "UPDATE Class SET
            Class_Date='$class_date',
            Class_Start='$class_start',
            Class_End='$class_end',
            Class_Venue='$class_venue',
            Class_Status='$class_status'
            WHERE Class_Code='$class_code'";

    if (mysqli_query($conn, $sql)) {
        echo "Class updated successfully: $class_code<br><br>";
        echo "<a href='classes.html'>Back to Classes Menu</a>";
        exit();
    } else {
        echo "Error updating class.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<body>

<h2>Update Class</h2>

<form action="update_class.php" method="POST">

    Class Code:<br>
    <input type="text" name="class_code" value="<?php echo $class_code; ?>" readonly><br><br>

    Class Date:<br>
    <input type="date" name="class_date" value="<?php echo $class_date; ?>"><br><br>

    Start Time:<br>
    <input type="time" name="class_start" value="<?php echo $class_start; ?>"><br><br>

    End Time:<br>
    <input type="time" name="class_end" value="<?php echo $class_end; ?>"><br><br>

    Venue:<br>
    <input type="text" name="class_venue" value="<?php echo $class_venue; ?>"><br><br>

    Status:<br>
    <select name="class_status">
        <option value="Active" <?php if ($class_status=="Active") echo "selected"; ?>>Active</option>
        <option value="Completed" <?php if ($class_status=="Completed") echo "selected"; ?>>Completed</option>
        <option value="Cancelled" <?php if ($class_status=="Cancelled") echo "selected"; ?>>Cancelled</option>
    </select><br><br>

    <input type="submit" name="Update" value="Update Class">

</form>

</body>
</html>
