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
        <a href="view_payment_record.php">Payment History</a>
        <a href="../delete_payment.php">Delete Payment</a>
    <hr>
</body>
</html>

<html>
<head>
    <title>View Card Payment Records</title>     
</head>
<body>
    <h1>Card Payment Records List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Invoice No</th>
            <th>Card Type</th>
            <th>Card Number</th>
            <th>Card Bank</th>
            <th>Amount Paid</th>
            <th>Action</th>
        </tr>
      
<?php
include '../../connect.php';

$sql = "SELECT * FROM card;";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $Invoice_No = $row['Invoice_No'];
        $sql2 = "SELECT Amount FROM payment WHERE Invoice_No = '$Invoice_No';";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
        echo "<tr>";
        echo "<td>{$row['Invoice_No']}</td>";
        echo "<td>{$row['Card_Type']}</td>";
        echo "<td>{$row['Card_Last4Digit']}</td>";
        echo "<td>{$row['Card_Bank']}</td>";
        echo "<td>RM{$row2['Amount']}</td>";
        echo "<td><a href='../Update/update_card_payment_form.php?Invoice_No=".$Invoice_No."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
<input type="button" value="Back" onclick="window.location.href='view_payment_record.php'"><br><br>