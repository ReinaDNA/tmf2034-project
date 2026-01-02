<?php  
include 'classes.html';
include '../connect.php';
?>
<html>
<head>
    <title>Add Class</title>
</head>
<body>
    <form action="add_class.php" method="post">
        <h1>Add New Class</h1>

        Class Code: <input type="text" name="Class_Code" required><br><br>

        Program ID: <input type="text" name="Program_ID" required><br><br>

        Class Date:<input type="date" name="Class_Date" required><br><br>

        Start Time:<input type="time" name="Class_Start" required><br><br>

        End Time:<input type="time" name="Class_End" required><br><br>

        Venue:<input type="text" name="Class_Venue" required><br><br>

        Status:
        <input type="radio" name="Class_Status" value="Active" required> Active
        <input type="radio" name="Class_Status" value="Completed"> Completed
        <input type="radio" name="Class_Status" value="Cancelled"> Cancelled
        <br><br>

        <input type="submit" value="Add Class">
    </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $class_code   = $_POST['Class_Code'];
    $program_id   = $_POST['Program_ID'];
    $class_date   = $_POST['Class_Date'];
    $class_start  = $_POST['Class_Start'];
    $class_end    = $_POST['Class_End'];
    $class_venue  = $_POST['Class_Venue'];
    $class_status = $_POST['Class_Status'];

    $sql = "INSERT INTO Class
            (Class_Code, Program_ID, Class_Date, Class_Start, Class_End, Class_Venue, Class_Status)
            VALUES
            ('$class_code', '$program_id', '$class_date', '$class_start', '$class_end', '$class_venue', '$class_status')";

    if ($conn->query($sql) === TRUE) {
        echo "New class added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>