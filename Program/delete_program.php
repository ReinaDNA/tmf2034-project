<?php   
include 'program.html';
include '../connect.php';
?>

<html>
<head>
    <title>Delete Program</title>
</head>
<body>
    <h1>Delete Program</h1>
    <form action="delete_program.php" method="get">
        Program ID to Delete: 
        <select name="Program_ID" id="Program_ID" required>
            <option value="">Please Choose</option>
            <?php 
            $sql = "SELECT Program_ID FROM program";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Program_ID']}'>{$row['Program_ID']}</option>";
              }
            }
            ?>
    </select><br><br>
    <input type="submit" value="Delete Program">
    </form> 
</body>
</html>

<?php
include '../connect.php';

if(isset($_GET['Program_ID'])) {
    $program_id = $_GET['Program_ID'];

    $sql = "DELETE FROM program WHERE Program_ID = '$program_id'";
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