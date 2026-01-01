<?php   
include 'program.html';
?>

<html>
<head>
    <title>Delete Program</title>
</head>
<body>
    <h1>Delete Program</h1>
</body>

<body>
    <form action="delete_program.php" method="get">
        Program ID to Delete: <input type="text" name="program_id" required><br><br>
        <input type="submit" value="Delete Program">
    </form>
</body>
</html>

<?php
include 'connect.php';

if(isset($_GET['program_id'])) {
    $program_id = $_GET['program_id'];

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