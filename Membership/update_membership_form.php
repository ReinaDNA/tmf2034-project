<?php
include 'membership.html';
include '../connect.php';

$membership_id = "";
$member_id = "";
$membership_type = "";
$membership_status = "";
$membership_fee = "";
$start_date = "";
$expiry_date = "";

if (isset($_GET['membership_id'])) {
    $membership_id = $_GET['membership_id'];
    $sql = "SELECT * FROM membership WHERE Membership_ID = '$membership_id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $membership_id = $row['Membership_ID'];
        $member_id = $row['Member_ID'];
        $membership_type = $row['Membership_Type'];
        $membership_status = $row['Membership_Status'];
        $membership_fee = $row['Membership_Fee'];
        $start_date = $row['Start_Date'];
        $expiry_date = $row['Expiry_Date'];

    } else {
        echo "No member found with ID: " . $id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_id = $_POST['Membership_ID'];
    $member_id = $_POST['Member_ID'];
    $membership_type = $_POST['Membership_Type'];
    $membership_status = $_POST['Membership_Status'];
    $membership_fee = $_POST['Membership_Fee'];
    $start_date = $_POST['Start_Date'];
    $new_start_date = new DateTime($_POST['Start_Date']);
    $expiry_date = clone $new_start_date;

    switch ($membership_type) {
    case "Monthly":
        $expiry_date->modify("+1 month");
        break;
    case "Quarterly":
        $expiry_date->modify("+3 months");
        break;
    case "Annually":
        $expiry_date->modify("+1 year");
        break;
}

if ($membership_type == "Monthly") {
    $membership_fee = 100.00;
} elseif ($membership_type == "Quarterly") {
    $membership_fee = 300.00;
} elseif ($membership_type == "Annually") {
    $membership_fee = 1200.00;
}

    $sql = "UPDATE membership SET 
            Member_ID = '$member_id',
            Membership_Type = '$membership_type',
            Membership_Status = '$membership_status',
            Membership_Fee = '$membership_fee',
            Start_Date = '" . $new_start_date->format('Y-m-d') . "',
            Expiry_Date = '" . $expiry_date->format('Y-m-d') . "'
            WHERE Membership_ID = '$membership_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Membership updated successfully.<br>";
    } else {
        echo "Error updating membership: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <title>Update MembershipInformation</title>
</head>
<body>
    <p1>Update Membership Information Form For : <?php echo "(ID: " . $membership_id . ")"; ?></p1>
    <form action="update_membership_form.php" method="post">
        <input type="hidden" name="Membership_ID" value="<?php echo $membership_id; ?>">
        <input type="hidden" name="Membership_Fee" value="<?php echo $membership_fee; ?>">

        Member ID: <input type="text" name = "Member_ID" value="<?php echo $member_id; ?>"><br><br>

        Membership Type: 
        <select name="Membership_Type" id="Membership_Type" required>
        <option value ="">Please Choose</option>
        <option value="Monthly" <?php if ($membership_type == 'Monthly') echo 'selected';?>>Monthly</option>
        <option value="Quarterly" <?php if ($membership_type == 'Quarterly') echo 'selected';?>>Quarterly</option>
        <option value="Annually" <?php if ($membership_type == 'Annually') echo 'selected';?>>Annual</option><br><br> 
        </select><br><br>

        Membership Status: 
        <select name="Membership_Status" id="Membership_Status" required>
        <option value ="">Please Choose</option>
        <option value="Active" <?php if ($membership_status == 'Active') echo 'selected';?>>Active</option>
        <option value="Inactive" <?php if ($membership_status == 'Inactive') echo 'selected';?>>Inactive</option>
        <option value="Suspended" <?php if ($membership_status == 'Suspended') echo 'selected';?>>Suspended</option><br><br>
        </select><br><br>

        Start Date: <input type="date" name = "Start_Date" value="<?php echo $start_date; ?>"><br><br>

        <input type="submit" value="Update Membership">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>