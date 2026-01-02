<htmL>
<head>
    <title>Members Detail</title>     
</head>
<body>
    <h1>Members Detail</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Member ID</th>
            <th>Member Name</th>
            <th>Total Programs Enrolled</th>
            <th>Total Classes Attended</th>
            <th>Total Payments</th>
            <th>Membership Status</th>
        </tr>
<?php
include 'connect.php';

$sql = "SELECT 
    m.Member_ID,
    CONCAT(m.Member_FName, ' ', m.Member_LName) AS Member_Name,
    ms.Membership_Status,
    COUNT(DISTINCT e.Program_ID) AS Total_Programs_Enrolled,
    COUNT(DISTINCT c.Class_Code) AS Total_Classes_Attended,
    COUNT(DISTINCT p.Invoice_No) AS Total_Payments
FROM Member m
LEFT JOIN Membership ms ON m.Member_ID = ms.Member_ID
LEFT JOIN Enrolment e ON m.Member_ID = e.Member_ID
LEFT JOIN Class c ON e.Program_ID = c.Program_ID
LEFT JOIN Payment p ON m.Member_ID = p.Member_ID
GROUP BY m.Member_ID, m.Member_FName, m.Member_LName, ms.Membership_Status";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Member_ID'];
        echo "<tr>";
        echo "<td>{$row['Member_ID']}</td>";
        echo "<td>{$row['Member_Name']}</td>";
        echo "<td>{$row['Total_Programs_Enrolled']}</td>";
        echo "<td>{$row['Total_Classes_Attended']}</td>";
        echo "<td>{$row['Total_Payments']}</td>";
        echo "<td>{$row['Membership_Status']}</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
