 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
 </head>

 <body>
     <h1>Payments Page</h1>
     <p>
        This page is for making payments and checking payment history made at Fitlife Wellness Centre.
     </p>
        <a href="../../main.html">Home</a>
        <a href="../add_payment.php">Make Payment</a>
        <a href="../View/view_payment_record.php">Payment History</a>
        <a href="../delete_payment.php">Delete Payment</a>
    <hr>
</body>
</html>

<htmL>
<head>
    <title>View Payment Records</title>     
</head>
<body>
    <h1>Payment Records List</h1> 
    View Specific Payment Record By : 
    <input type="button" value="Cash" onclick="window.location.href='view_cash_payment.php'">
    <input type="button" value="Card" onclick="window.location.href='view_card_payment.php'">
    <input type="button" value="Online" onclick="window.location.href='view_online_payment.php'">
    <br><br>
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Invoice No</th>
            <th>Member ID</th>
            <th>Membership ID</th>
            <th>Program ID</th>
            <th>Payment Date</th>
            <th>Amount</th>
            <th>Payment Type</th>
            <th>Action</th>
        </tr>
      
<?php
include '../../connect.php';

$sql = "SELECT * FROM payment";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $Invoice_No = $row['Invoice_No'];
        echo "<tr>";
        echo "<td>{$row['Invoice_No']}</td>";
        echo "<td>{$row['Member_ID']}</td>";
        echo "<td>". (($row['Membership_ID'] == NULL) ? "-" : $row['Membership_ID']) . "</td>";
        echo "<td>". (($row['Program_ID'] == NULL) ? "-" : $row['Program_ID']) . "</td>";
        echo "<td>{$row['Payment_Date']}</td>";
        echo "<td>RM{$row['Amount']}</td>";
        echo "<td>{$row['Payment_Type']}</td>";
        echo "<td><a href='../Update/update_payment_form.php?Invoice_No=".$Invoice_No."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>