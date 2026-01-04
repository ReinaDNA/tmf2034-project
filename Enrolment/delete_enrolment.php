<?php   
include 'enrolment.html';
?>

<html>
<head>
    <title>Delete Enrolment</title>
</head>
<body>
    <h1>Delete Enrolment</h1>
</body>

<body>
    <form action="delete_enrolment.php" method="get">
        Enrolment to Delete: <br><br>
        Member ID: 
        <select name="member_id" id="member_id" required>
            <option value="">Please Choose</option>
            <?php 
            include '../connect.php';
            $sql = "SELECT Member_ID FROM member";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Member_ID']}'>{$row['Member_ID']}</option>";
              }
            }
            ?>
    </select><br><br>
            
            Program ID: 
        <select name="program_id" id="program_id" required>
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
    <input type="submit" value="Delete Enrolment">
    </form>
</body>
</html>

<?php
include '../connect.php';

if(isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];
    $program_id = $_GET['program_id'];

    $sql = "DELETE FROM enrolment WHERE 
            Member_ID = '$member_id' 
            AND Program_ID = '$program_id'";

    $result = mysqli_query($conn, $sql);

    if($result) {   
    if ($conn->query($sql) ==TRUE ) {
        echo "Enrolment with Member ID " . $member_id . " and Program ID " . $program_id . " is deleted successfully";
    } else {
        echo "No record found for ID: " . $member_id;
    }
    } else {
        echo "No member ID provided.";
    }
}
mysqli_close($conn);
?>