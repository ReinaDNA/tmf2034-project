<?php   
include 'membership.html';
include '../connect.php';
?>

<html>
<head>
    <title>Add Membership</title>
</head>
<body>
    <form action ="add_membership.php" method="post">
        <h1>Add New Membership</h1>

        Membership_ID: <input type="text" name = "Membership_ID" required><br><br>

        Member_ID:
        <select name="Member_ID" id="Member_ID" required>
        <option value ="">Please Choose</option>
        <?php
        $sql = "SELECT Member_ID FROM member";
        $result = mysqli_query($conn, $sql);
            if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Member_ID']}'>{$row['Member_ID']}</option>";
                }}?>
        </select><br><br>

        Membership_Type: 
        <select name="Membership_Type" id="Membership_Type" required>
        <option value ="">Please Choose</option>
        <option value="Monthly">Monthly</option>
        <option value="Quarterly">Quarterly</option>
        <option value="Annual">Annual</option><br><br> 
        </select><br><br> 
        
        Start_Date: <input type="date" name = "Start_Date" required><br><br>

        <input type="submit" value="Add Membership">    
    </form>
</body>
</html>

<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $membership_id = $_POST['Membership_ID'];
    $member_id = $_POST['Member_ID'];
    $membership_type = $_POST['Membership_Type'];
    $membership_status = "Active";
    $start_date = $_POST['Start_Date'];
    $new_start_date = new DateTime($_POST['Start_Date']);
    $expiry_date = clone $new_start_date;

switch ($membership_type) {
    case "Monthly":
        $expiry_date->modify("+1 month");
        $membership_fee = 100.00;
        break;
    case "Quarterly":
        $expiry_date->modify("+3 months");
        $membership_fee = 300.00;
        break;
    case "Annually":
        $expiry_date->modify("+1 year");
        $membership_fee = 1200.00;  
        break;
}

    $sql = "INSERT INTO Membership
            (Membership_ID, Member_ID, Membership_Type, Membership_Status, Membership_Fee, Start_Date, Expiry_Date)
            VALUES
            ('$membership_id', '$member_id', '$membership_type', '$membership_status', '$membership_fee', '".$new_start_date->format('Y-m-d')."', '".$expiry_date->format('Y-m-d')."')";

    if ($conn->query($sql) === TRUE) {
        echo "Membership added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
