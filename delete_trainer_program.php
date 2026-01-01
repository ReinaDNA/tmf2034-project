<?php   
include 'program_trainer.html';
include 'connect.php';
?>

<html>
<head>
    <title>Delete Trainer Program</title>
</head>
<body>
    <h1>Delete Program</h1>
</body>

<body>
    <form action="delete_trainer_program.php" method="get">
        Program Trainer to be Deleted:<br><br>
        Program ID: 
        <select name="Program_ID" id="Program_ID" required>
        <option value="">Please Choose</option>
        <?php $sql = "SELECT Program_ID FROM program_trainer";
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

    <input type="submit" value="Delete Program">
    </form>
</body>
</html>

<?php
include 'connect.php';

if(isset($_GET['Program_ID'])) {
    $program_id = $_GET['Program_ID'];
    $trainer_id = $_GET['Trainer_ID'];
    $start_date = $_GET['Start_Date'];

    $sql = "DELETE FROM program_trainer 
            WHERE Program_ID = '$program_id' 
            AND Trainer_ID = '$trainer_id' 
            AND Start_Date = '$start_date'";

    $result = mysqli_query($conn, $sql);

    if($result) {   
    if ($conn->query($sql) ==TRUE ) {
        echo $program_id . " Program is deleted successfully";
    } else {
        echo "No record found for ID: " . $program_id;
    }
    } else {
        echo "No program ID provided.";
    }
}
mysqli_close($conn);
?>