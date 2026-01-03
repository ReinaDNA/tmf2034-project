<?php
include 'program_trainer.html';
include '../connect.php';

$program_id = "";
$trainer_id = "";
$start_date = "";
$end_date = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM program_trainer WHERE Program_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $program_id = $row['Program_ID'];
        $trainer_id = $row['Trainer_ID'];
        $start_date = $row['Start_Date'];
        $end_date = $row['End_Date'];

    } else {
        echo "No member found with ID: " . $id;
     }
}

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
        
    $sql = "UPDATE program_trainer SET 
            Trainer_ID = '$trainer_id',
            Start_Date = '$start_date',
            End_Date = $end_date
            WHERE Program_ID = '$program_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Program trainer updated successfully.<br>";
    } else {
        echo "Error updating program: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update Information</title>
</head>
<body>
    <p1>Update Program Trainer Information Form For : <?php echo " (ID: " . $program_id . ")"; ?></p1>
    <form action="update_program_trainer_form.php" method="post">

        <input type="hidden" name="Program_ID" value="<?php echo $program_id; ?>">
        
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

        Start Date: <input type="date" name = "Start_Date" value="<?php echo $start_date; ?>"><br><br>

        End Date: <input type="date" name = "End_Date" value="<?php echo $end_date; ?>"><br><br>
        <input type="submit" value="Update Program Trainer">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>