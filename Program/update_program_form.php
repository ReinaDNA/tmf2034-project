<?php
include 'program.html';
include '../connect.php';

$program_id = "";
$program_name = "";
$program_duration = "";
$program_category = "";
$program_fee = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM program WHERE Program_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $program_id = $row['Program_ID'];
        $program_name = $row['Program_Name'];
        $program_duration = $row['Program_Duration'];
        $program_category = $row['Program_Category'];
        $program_fee = $row['Program_Fee'];

    } else {
        echo "No member found with ID: " . $id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_id = $_POST['Program_ID'];
    $program_name = $_POST['Program_Name'];
    $program_duration = $_POST['Program_Duration'];
    $program_category = $_POST['Program_Category'];
    $program_fee = $_POST['Program_Fee'];

    $sql = "UPDATE program SET 
            Program_Name = '$program_name',
            Program_Duration = '$program_duration',
            Program_Category = '$program_category',
            Program_Fee = '$program_fee'
            WHERE Program_ID = '$program_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Program updated successfully.<br>";
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
    <p1>Update Program Information Form For : <?php echo $program_name; echo " (ID: " . $program_id . ")"; ?></p1>
    <form action="update_program_form.php" method="post">
        <input type="hidden" name="Program_ID" value="<?php echo $program_id; ?>">
        Program Name: <input type="text" name = "Program_Name" value="<?php echo $program_name; ?>"><br><br>

        Program Duration:
        <select name="Program_Duration" required>
        <option value="">Please Choose</option>
        <option value="1 Week" <?php if ($program_duration == '1 Week') echo 'selected';?>>1 Week</option>
        <option value="2 Weeks" <?php if ($program_duration == '2 Weeks') echo 'selected';?>>2 Weeks</option>
        <option value="3 Weeks" <?php if ($program_duration == '3 Weeks') echo 'selected';?>>3 Weeks</option>
        <option value="4 Weeks"<?php if ($program_duration == '4 Weeks') echo 'selected';?>>4 Weeks</option>
        <option value="5 Weeks"<?php if ($program_duration == '5 Weeks') echo 'selected';?>>5 Weeks</option>
        <option value="6 Weeks"<?php if ($program_duration == '6 Weeks') echo 'selected';?>>6 Weeks</option>
        <option value="7 Weeks"<?php if ($program_duration == '7 Weeks') echo 'selected';?>>7 Weeks</option>
        <option value="8 Weeks"<?php if ($program_duration == '8 Weeks') echo 'selected';?>>8 Weeks</option>
        <option value="9 Weeks"<?php if ($program_duration == '9 Weeks') echo 'selected';?>>9 Weeks</option>
        <option value="10 Weeks"<?php if ($program_duration == '10 Weeks') echo 'selected';?>>10 Weeks</option> <br><br>
        </select><br><br>

        Program Category: 
        <select name="Program_Category" required>
        <option value="">Please Choose</option>
        <option value="Yoga" <?php if ($program_category == 'Yoga') echo 'selected';?>>Yoga</option>
        <option value="Fitness" <?php if ($program_category == 'Fitness') echo 'selected';?>>Fitness</option>
        <option value="Nutrition" <?php if ($program_category == 'Nutrition') echo 'selected';?>>Nutrition</option>
        <option value="Physiotherapy" <?php if ($program_category == 'Physiotherapy') echo 'selected';?>>Physiotherapy</option><br><br>
        </select><br><br>

        Program Fee: <input type="text" name = "Program_Fee" value="<?php echo $program_fee; ?>"><br><br>
        <input type="submit" value="Update Program">

    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>