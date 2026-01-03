<?php   
include 'membership.html';
?>
<htmL>
<head>
    <title>View Memberships</title>     
</head>
<body>
    <h1>Memberships List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Membership ID</th>
            <th>Member ID</th>
            <th>Membership Type</th>
            <th>Membership Status</th>
            <th>Membership Fee</th>
            <th>Start Date</th>
            <th>Expiry Date</th> 
            <th>Action</th>
        </tr>
      
<?php
include '../connect.php';

$sql = "SELECT * FROM membership";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $membership_id = $row['Membership_ID'];
        echo "<tr>";
        echo "<td>{$row['Membership_ID']}</td>";
        echo "<td>{$row['Member_ID']}</td>";
        echo "<td>{$row['Membership_Type']}</td>";
        echo "<td>{$row['Membership_Status']}</td>";
        echo "<td>RM{$row['Membership_Fee']}</td>";
        echo "<td>{$row['Start_Date']}</td>";
        echo "<td>{$row['Expiry_Date']}</td>";
        echo "<td><a href='update_membership_form.php?membership_id=".$membership_id."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
