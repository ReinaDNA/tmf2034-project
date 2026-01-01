<?php   
include 'membership.html';
?>

<html>
<head>
    <title>Add Membership</title>
</head>
<body>
    <form action ="add_membership.php" method="post">
        <h1>Add New Member</h1>

        Membership_ID: <input type="text" name = "Membership_ID" required><br><br>

        Member_ID: <input type="text" name = "Member_ID" required><br><br>

        Membership_Type: 
        <select name="Membership_Type" id="Membership_Type" required>
        <option value ="">Please Choose</option>
        <option value="Monthly">Monthly</option>
        <option value="Quarterly">Quarterly</option>
        <option value="Annually">Annually</option><br><br> 
        </select><br><br> 
        
        Start_Date: <input type="date" name = "Start_Date" required><br><br>

        <input type="submit" value="Add Membership">    
    </form>
</body>
</html>

<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $membership_id = $_POST['Membership_ID'];
    $member_id = $_POST['Member_ID'];
    $membership_type = $_POST['Membership_Type'];
    $membership_status = "Active";
    $start_date = new DateTime($_POST['Start_Date']);
    $expiry_date = clone $start_date;

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
    $sql = "INSERT INTO Membership
            (Membership_ID, Member_ID, Membership_Type, Membership_Status, Start_Date, Expiry_Date)
            VALUES
            ('$membership_id', '$member_id', '$membership_type', '$membership_status', '".$start_date->format('Y-m-d')."', '".$expiry_date->format('Y-m-d')."')";

    if ($conn->query($sql) === TRUE) {
        echo "Membership added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
