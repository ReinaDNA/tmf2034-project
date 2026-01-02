<?php   
include 'program_trainer.html';
include '../connect.php';
?>
<html>
<head>
    <title>Add Trainer Program</title>
</head>
<body>
    <form action ="add_trainer_program.php" method="post">
        <h1>Add New Trainer Program</h1>

        Program ID: 
        <select name="Program_ID" id="Program_ID" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Program_ID FROM program";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Program_ID']}'>{$row['Program_ID']}</option>";
                }}?>
        </select><br><br>

        Trainer ID:
        <select name="Trainer_ID" id="Trainer_ID" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Trainer_ID FROM Trainer";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Trainer_ID']}'>{$row['Trainer_ID']}</option>";
                }}?>
        </select><br><br>

        Start_Date: <input type="date" name = "Start_Date" required><br><br>

        End_Date: <input type="date" name = "End_Date"><br><br>
        
        <input type="submit" value="Add Trainer Program">    
    </form>
</body>
</html>

<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $program_id = $_POST['Program_ID'];
    $trainer_id = $_POST['Trainer_ID'];
    $start_date = $_POST['Start_Date'];
    $end_date = $_POST['End_Date'];

    if (empty($end_date) || $end_date == "0000-00-00") {
        $end_date = "NULL";
    } else {
        $end_date = "'$end_date'";
    }

    $sql = "INSERT INTO Program_Trainer
            (Program_ID, Trainer_ID, Start_Date, End_Date)
            VALUES
            ('$program_id', 
            '$trainer_id', 
            '$start_date', 
            $end_date)";

    if ($conn->query($sql) === TRUE) {
        echo "New trainer program added successfully.";
    } else {
        echo "Error adding program: " . $conn->error;
    }
}