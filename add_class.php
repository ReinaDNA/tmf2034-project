<?php  
include 'connect.php';

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
        echo "Error adding class";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Class</title>
</head>

<body>

<h1>Add Class</h1>

<form method="post">

    <label>Class Code:</label><br>
    <input type="text" name="Class_Code" required><br><br>

    <label>Program ID:</label><br>
    <input type="text" name="Program_ID" required><br><br>

    <label>Class Date:</label><br>
    <input type="date" name="Class_Date" required><br><br>

    <label>Start Time:</label><br>
    <input type="time" name="Class_Start" required><br><br>

    <label>End Time:</label><br>
    <input type="time" name="Class_End" required><br><br>

    <label>Venue:</label><br>
    <input type="text" name="Class_Venue" required><br><br>

    <label>Status:</label><br>
    <select name="Class_Status" required>
        <option value=""> Select Class Status </option>
        <option value="Active">Active</option>
        <option value="Completed">Completed</option>
        <option value="Cancelled">Cancelled</option>
    </select><br><br>

    <input type="submit" value="Add Class">

</form>

<br>
<a href="classes.html">Back to Classes Menu</a>

</body>
</html>