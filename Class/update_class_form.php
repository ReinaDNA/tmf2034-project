<?php
include 'classes.html';
include '../connect.php'; 

$class_code = "";
$program_id = "";
$class_date = "";
$class_start = "";
$class_end = "";
$class_venue = "";
$class_status = "";

if (isset($_GET['class_code'])) {
    $class_code = $_GET['class_code'];
    $sql = "SELECT * FROM Class WHERE Class_Code = '$class_code'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $class_code   = $row['Class_Code'];
        $program_id   = $row['Program_ID'];
        $class_date   = $row['Class_Date'];
        $class_start  = $row['Class_Start'];
        $class_end    = $row['Class_End'];
        $class_venue  = $row['Class_Venue'];
        $class_status = $row['Class_Status'];
    } else {
        echo "No class found with the class code: " . $class_code;
    }
}

/* If user clicks Update button */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_code   = $_POST['Class_Code'];
    $program_id   = $_POST['Program_ID'];
    $class_date   = $_POST['Class_Date'];
    $class_start  = $_POST['Class_Start'];
    $class_end    = $_POST['Class_End'];
    $class_venue  = $_POST['Class_Venue'];
    $class_status = $_POST['Class_Status'];

    $sql = "UPDATE Class SET
            Program_ID = '$program_id',
            Class_Date = '$class_date',
            Class_Start = '$class_start',
            Class_End = '$class_end',
            Class_Venue = '$class_venue',
            Class_Status = '$class_status'
            WHERE Class_Code = '$class_code'";

    if (mysqli_query($conn, $sql)) {
        echo "Class updated successfully.<br>";
    } else {
        echo "Error updating class: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update Class</title>
</head>
<body>

        <p>Update Class Information For :<?php echo $class_code; ?></p>
        <form action="update_class_form.php" method="post">

            <input type="hidden" name="Class_Code" value="<?php echo $class_code; ?>">

            Program ID:
            <input type="text" name="Program_ID" value="<?php echo $program_id; ?>"><br><br>

            Class Date:
            <input type="date" name="Class_Date" value="<?php echo $class_date; ?>"><br><br>

            Start Time:
            <input type="time" name="Class_Start" value="<?php echo $class_start; ?>"><br><br>

            End Time:
            <input type="time" name="Class_End" value="<?php echo $class_end; ?>"><br><br>

            Venue:
            <input type="text" name="Class_Venue" value="<?php echo $class_venue; ?>"><br><br>

            Status:
            <input type="radio" name="Class_Status" value="Active" <?php if ($class_status == 'Active') echo 'checked'; ?>> Active
            <input type="radio" name="Class_Status" value="Completed" <?php if ($class_status == 'Completed') echo 'checked'; ?>> Completed
            <input type="radio" name="Class_Status" value="Cancelled" <?php if ($class_status == 'Cancelled') echo 'checked'; ?>> Cancelled
            <br><br>

            <input type="submit" value="Update Class">
        </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
