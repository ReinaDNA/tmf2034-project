<?php
include 'enrolment.html';
include 'connect.php';

$member_id = "";
$program_id = "";
$enrolment_date = "";

if (isset($_GET['member_id']) && isset($_GET['program_id'])) {
    $member_id = $_GET['member_id'];
    $program_id = $_GET['program_id'];

    $sql = "SELECT * FROM enrolment WHERE Member_ID = '$member_id' AND Program_ID = '$program_id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $member_id = $row['Member_ID'];
        $program_id = $row['Program_ID'];
        $enrolment_date = $row['Enrolment_Date'];

    } else {
        echo "No member found with ID: " . $member_id . " and Program ID: " . $program_id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['Member_ID'];
    $program_id = $_POST['Program_ID'];
    $enrolment_date = $_POST['Enrolment_Date'];

    $sql = "UPDATE enrolment SET 
            Enrolment_Date = '$enrolment_date'
            WHERE Member_ID = '$member_id' AND Program_ID = '$program_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Member updated successfully.<br>";
    } else {
        echo "Error updating member: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update Enrolment Information</title>
</head>
<body>
    <p1>Update Enrolment Information Form For : <?php echo $member_id . " and Program ID: " . $program_id; ?></p1><br><br>

    <form action="update_enrolment_form.php" method="post">
        <input type="hidden" name="Member_ID" value="<?php echo $member_id; ?>">
        <input type="hidden" name="Program_ID" value="<?php echo $program_id; ?>">

        Enrolment Date: <input type="date" name="Enrolment_Date" value="<?php echo $enrolment_date; ?>"><br><br>

        <input type="submit" value="Update Enrolment">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>