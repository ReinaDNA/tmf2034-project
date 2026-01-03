<?php
include 'data_manipulation.html';
include '../connect.php';
?>
<html>
<head>
    <title>Membership Fee Report</title>     
</head>
<body>
    <h1>Membership Fee Report</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0" >
        <tr>
            <th>Membership Type</th>
            <th>Current Active Member Amount</th>
            <th>Membership Fee</th>
            <th>Total Fee Paid</th>
        </tr>
<?php
include '../connect.php';

$sql = "SELECT 
        m.Membership_Type,
        COUNT(CASE WHEN m.Membership_Status = 'Active' THEN 1 END) AS Total_Active_Members,
        MAX(m.Membership_Fee) AS Membership_Fee,
        SUM(p.Amount) AS Total_Fee_Paid
    FROM Membership m
    LEFT JOIN Payment p 
        ON m.Membership_ID = p.Membership_ID
    GROUP BY 
        m.Membership_Type";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Membership_Type'];
        echo "<tr>";
        echo "<td>{$row['Membership_Type']}</td>";
        echo "<td>{$row['Total_Active_Members']}</td>";
        echo "<td>{$row['Membership_Fee']}</td>";
        echo "<td>{$row['Total_Fee_Paid']}</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>

